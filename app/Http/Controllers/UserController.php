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
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
        $this->linkPrev = 'Inicio';
        $this->linkCurrent = 'Usuarios';
        return view('modules.users.index', ['linkPrev' => $this->linkPrev, 'linkCurrent' => $this->linkCurrent]);
    }

    public function create(): View
    {
        $roles = Role::all();
        $linkPrev =  $this->linkPrev = 'Inicio';
        $linkCurrent = $this->linkCurrent = 'Crear usuario';
        return view('modules.users.create', compact('roles', 'linkPrev','linkCurrent'));
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
        $linkPrev =  $this->linkPrev = 'Inicio';
        $linkCurrent = $this->linkCurrent = 'Crear usuario';
        return view('modules.users.edit', compact('user', 'roles', 'linkPrev','linkCurrent'));
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

    public function sendConfirmationEmail(User $user)
    {
        try {
            $url = URL::temporarySignedRoute(
                'user.confirm',
                now()->addHours(48),
                ['user' => $user->id]
            );

            Mail::to($user->email)->send(new UserConfirmationMail($user, $url));

            return response()->json(['message' => 'Email de confirmación enviado exitosamente']);
        } catch (TransportExceptionInterface $e) {
            Log::error('Error al enviar email de confirmación: ' . $e->getMessage());
            return response()->json(['error' => 'Error al enviar el email de confirmación'], 500);
        }
    }
    
    /**
    * Log the user out of the application.
    */
    public function logout(Request $request): RedirectResponse
    {
        
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/')->with('message', 'La salida del sistema se completo.');
    }
    
       

    public function OLDconfirm(Request $request, User $user)
    {
        if (!$request->hasValidSignature()) {
            return redirect()->route('home')->with('error', 'El enlace de confirmación no es válido o ha expirado.');
        }

        $user->email_verified_at = now();
        $user->save();

        AuditHelper::log('user_confirmed', 'El usuario confirmó su cuenta', $user);

        return redirect()->route('home')->with('success', 'Tu cuenta ha sido verificada exitosamente.');
    }

    public function confirm(Request $request, User $user)
    {
        if (!$request->hasValidSignature()) {
            return redirect()->route('home')->with('error', 'El enlace de confirmación no es válido o ha expirado.');
        }
    
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home')->with('info', 'Este correo ya ha sido verificado anteriormente.');
        }
    
        $user->markEmailAsVerified();
    
        AuditHelper::log('user_confirmed', 'El usuario confirmó su cuenta', $user);
    
        return redirect()->route('dashboard')->with('success', 'Tu cuenta ha sido verificada exitosamente.');
    }






    public function confirmed(Request $request, User $user)
    {
        return redirect()->route('logout');
    }


}