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
use App\Http\Controllers\UserController; 

//use App\Libraries\Pdf\Fpdf;
use App\Libraries\Pdf\WriteTag;

use App\Helpers\AuditHelper;

use Illuminate\Support\Facades\DB; // Importar la clase DB para transacciones
use Throwable; // Importar la clase Throwable para capturar excepciones

class ClientController extends Controller
{
    protected $userController;
    
    public function __construct(UserController $userController)
    {
        $this->userController = $userController;
    }

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

        $this->linkPrev = 'Inicio';
        $this->linkCurrent = 'Clientes';

        return view('modules.client.index', ['linkPrev' => $this->linkPrev, 'linkCurrent' => $this->linkCurrent]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $client = new Client();
        $divitions = Divition::all();
        $countries = Country::all();
        
        $linkPrev = $this->linkPrev = 'Inicio';
        $linkCurrent = $this->linkCurrent = 'Crear clientes';

        
        return view('modules.client.create', compact('client', 'divitions','countries', 'linkPrev', 'linkCurrent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request): RedirectResponse
    {
        try {

            // Validar email único
            $request->validate([
                'email' => 'unique:users,email'
            ]);

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
            $userData = $request->only(['name', 'username', 'last_name','email', 'phone', 'password','country_id','state_id', 'country_id','state_id', 'city_id']);
            $userData['password'] = bcrypt($userData['password']);
            $userData = array_merge($userData, [
                'type' => 2,
                'client_status' => 'A',
                'user_status' => 'P',
                'client_id' => $client->id,
                'password_change' => now()->format('Y-m-d')
            ]);

            $user = User::create($userData);


            // Enviar correo de confirmación con manejo de errores
            try {
                $this->userController->sendConfirmationEmail($user);
            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error('Error sending confirmation email: ' . $e->getMessage());
                return Redirect::back()
                    ->with('error', 'User created but confirmation email could not be sent')
                    ->withInput();
            }



        // Procesar la imagen si existe
        if ($request->hasFile('image')) {
            try {
                

                if ($request->hasFile('image')) {
                    try {
                        $posExtension = strrpos($image, '.');
                        $imgName = $request->file('image');
                        $path = public_path() . '/storage/img/';
                       
                        $imagePath = $path. 'client-'.$client->id.$posExtension;
                        
                        // Crear imagen temporal
                        list($width, $height) = getimagesize($imgName->getRealPath());
                        $source = imagecreatefromstring(file_get_contents($imgName->getRealPath()));
                        
                        // Calcular nuevas dimensiones manteniendo aspect ratio
                        $newWidth = 240;
                        $newHeight = 80;
                        $ratio = $width / $height;
                        
                        if ($newWidth / $newHeight > $ratio) {
                            $newWidth = $newHeight * $ratio;
                        } else {
                            $newHeight = $newWidth / $ratio;
                        }
                        
                        // Crear imagen redimensionada
                        $thumb = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        
                        // Guardar imagen
                        imagejpeg($thumb, $imagePath, 90);
                        
                        // Liberar memoria
                        imagedestroy($source);
                        imagedestroy($thumb);
                        
                        $client->image = $imagePath;
                        $client->save();
                    } catch (\Exception $e) {
                        throw new \Exception("Error processing image: " . $e->getMessage());
                    }
                }



            } catch (\Exception $e) {
                throw new \Exception("Error processing image: " . $e->getMessage());
            }
        }

        DB::commit();

        AuditHelper::log('Cliente creado', [
            'action' => 'create',
            'client_id' => $client->id,
            'data' => $client->toArray(),
            'section' => 'clients'
        ]);        


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
        $linkPrev = $this->linkPrev = 'Inicio';
        $linkCurrent = $this->linkCurrent = 'Crear clientes'; 

        return view('modules.client.edit', compact('client','divitions','countries', 'linkPrev', 'linkCurrent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client): RedirectResponse
    {
        
        $client->update($request->validated());

        AuditHelper::log('Cliente actualizado', [
            'action' => 'update',
            'client_id' => $client->id,
            'old_data' => $oldData,
            'new_data' => $client->fresh()->toArray(),
            'section' => 'clients'
        ]);        

        return Redirect::route('clients.index')
            ->with('success', 'Client updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $client = Client::find($id);
        $clientData =  $client->toArray();
        $client->delete();

        AuditHelper::log('Cliente eliminado', [
            'action' => 'delete',
            'deleted_data' => $clientData,
            'section' => 'countries'
        ]);        

        return Redirect::route('clients.index')
            ->with('success', 'Client deleted successfully');
    }

}
