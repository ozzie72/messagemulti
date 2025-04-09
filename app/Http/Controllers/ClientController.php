<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Divition;
use App\Models\Country;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\Facades\Image; 

use App\Helpers\AuditHelper;

use Illuminate\Support\Facades\DB; // Importar la clase DB para transacciones
use Throwable; // Importar la clase Throwable para capturar excepciones

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
        $countries = Country::all();

        return view('modules.client.create', compact('client', 'divitions','countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
/**
 * Store a newly created resource in storage.
 */
public function store(ClientRequest $request): RedirectResponse
{
    try {
        // Validar la imagen primero
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        }

        DB::beginTransaction();

        // Crear el cliente
        $client = Client::create($request->validated());

        // Validar y crear el usuario asociado
        $userData = $request->only(['name', 'username', 'email', 'phone', 'password']);
        $userData['password'] = bcrypt($userData['password']);
        $userData = array_merge($userData, [
            'type' => 2,
            'client_status' => 'A',
            'user_status' => 'P',
            'client_id' => $client->id,
            'password_change' => now()->format('Y-m-d')
        ]);

        dd($userData);



        $user = User::create($userData);


        // Procesar la imagen si existe
        if ($request->hasFile('image')) {
            try {
                $imgName = $request->file('image');
                $imagePath = 'assets/img/client-'.$client->id.'.jpg';

                $image = Image::make($imgName)->resize(240, 80, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                $image->save($imagePath);
                $client->image = $imagePath;
                $client->save();
            } catch (\Exception $e) {
                throw new \Exception("Error processing image: " . $e->getMessage());
            }
        }

        DB::commit();

        return Redirect::route('clients.index')
            ->with('success', 'Client created successfully.');

    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollBack();
        return Redirect::back()
            ->withErrors($e->validator)
            ->withInput();

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Error creating client: ' . $e->getMessage());
        
        return Redirect::route('clients.create')
            ->with('error', 'Error creating client: ' . $e->getMessage())
            ->withInput();
    }
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
        $countries = Country::all();

        return view('modules.client.edit', compact('client','divitions','countries'));
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
