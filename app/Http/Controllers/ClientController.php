<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Divition;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB; // Importar la clase DB para transacciones
use Throwable; // Importar la clase Throwable para capturar excepciones

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */







     
    public function index(Request $request): View
    {
        $clients = Client::paginate();
        return view('client.index', compact('clients'))
            ->with('i', ($request->input('page', 1) - 1) * $clients->perPage());


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $client = new Client();
        $divitions = Divition::all(); // Cargar todas las divisiones para el select

        return view('client.create', compact('client','divitions'));
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



    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $client = Client::find($id);

        return view('client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $client = Client::find($id);
        $divitions = Divition::all(); // Cargar todas las divisiones para el select

        return view('client.edit', compact('client', 'divitions'));
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
