<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

use App\Mail\UserConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

use App\Helpers\AuditHelper;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->select('*');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('roles', function($user) {
                    return $user->roles->pluck('name')->implode(', ');
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('users.edit', $row->id).'" class="btn btn-primary btn-sm">Editar</a>';
                    $btn .= ' <button class="btn btn-danger btn-sm delete-btn" data-id="'.$row->id.'">Eliminar</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('modules.users.index');
    }

    public function create(): View
    {
        $roles = Role::all();
        return view('modules.users.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('modules.users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit($id): View
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        return view('modules.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array',
        ]);

        $user = User::findOrFail($id);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect()->route('modules.users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => 'Usuario eliminado exitosamente.']);
    }


/**
 * Envía el correo de confirmación al usuario
 *
 * @param \App\Models\User $user
 * @return \Illuminate\Http\RedirectResponse
 */
public function sendConfirmationEmail(User $user)
{
    try {
        // Generar URL firmada temporal (24 horas de validez)
        $confirmationUrl = URL::temporarySignedRoute(
            'user.confirm',
            now()->addHours(24),
            ['user' => $user->id]
        );
        
        // Enviar el correo
        Mail::to($user->email)->send(new UserConfirmationMail($user, $confirmationUrl));
        
        return back()->with('success', 'Correo de confirmación enviado.');
        
    } catch (TransportExceptionInterface $e) {
        // Error específico de envío de correo
        Log::error('Error al enviar correo de confirmación: ' . $e->getMessage(), [
            'user_id' => $user->id,
            'exception' => $e
        ]);
        
        return back()->with('error', 'No se pudo enviar el correo de confirmación. Error: ' . $e->getMessage());
        
    } catch (\Exception $e) {
        // Cualquier otro tipo de error
        Log::error('Error inesperado al enviar correo de confirmación: ' . $e->getMessage(), [
            'user_id' => $user->id,
            'exception' => $e
        ]);
        
        return back()->with('error', 'Ocurrió un error inesperado al enviar el correo. Detalles: ' . $e->getMessage());
    }
}    
    /**
     * Confirma la cuenta del usuario
     */
    public function confirm(Request $request, User $user)
    {
        // Verificar que la URL sea válida y no haya expirado
        if (!$request->hasValidSignature()) {
            abort(403, 'El enlace de confirmación es inválido o ha expirado.');
        }
        
        // Actualizar el campo confirmed
        $user->update(['confirmed' => true]);
        
        return redirect()->route('/')->with('success', 'Cuenta confirmada exitosamente.');
    }

}