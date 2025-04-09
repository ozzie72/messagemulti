<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Divition;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\Facades\Image; 

use App\Helpers\AuditHelper;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Client::all();
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('clients.edit', $row->id).'" class="btn btn-primary btn-sm">Editar</a>';
                    $btn .= ' <button class="btn btn-danger btn-sm delete-btn" data-id="'.$row->id.'">Eliminar</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('modules.client.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $client = new Client();
        $divitions = Divition::all();

        return view('modules.client.create', compact('client', 'divitions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request): RedirectResponse
    {
        try {
            // Iniciar una transacción de base de datos para asegurar la atomicidad
            DB::beginTransaction();
                
            $validated['divition_id'] = $request->divition_id;
            $validated['department_id'] = $request->department_id;

            // Crear el cliente y capturar el objeto creado
            $client = Client::create($request->validated());
    
            // Utilizar el ID del cliente creado
            User::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => bcrypt($request->input('password')),
                'type' => 2,
                'client_status' => 'A',
                'user_status' => 'P',
                'client_id' => $client->id, // Utilizar el ID del cliente

                'password_change' => Date::now()->format('Y-m-d') // Utilizar Date::now() es mas claro
            ]);
    
            // Confirmar la transacción si todo fue exitoso
            DB::commit();

            

            $imgName = $request->file('image');

            $image = Image::make($imgName)->resize(240, 80, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->save('assets/img/client-'.$client->id.'.jpg');
    
            $client->image = 'assets/img/client-'.$client->id.'.jpg';
            $client->save();




            return Redirect::route('clients.index')
                ->with('success', 'Client created successfully.');
        } catch (Throwable $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
    
            // Registrar el error (puedes utilizar logs para esto)
            \Log::error('Error creating client or user: ' . $e->getMessage());
    
            // Redirigir con un mensaje de error
            return Redirect::route('clients.index')
                ->with('error', 'An error occurred while creating the client.');
        }
    }


     




    public function storeOLD(ClientRequest $request): RedirectResponse
    {
        Client::create($request->validated());

        return Redirect::route('clients.index')
            ->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $client = Client::find($id);

        return view('modules.client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $client = Client::find($id);
        $divitions = Divition::all();

        return view('modules.client.edit', compact('client','divitions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());

        return Redirect::route('clients.index')
            ->with('success', 'Client updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Client::find($id)->delete();

        return Redirect::route('clients.index')
            ->with('success', 'Client deleted successfully');
    }
}
