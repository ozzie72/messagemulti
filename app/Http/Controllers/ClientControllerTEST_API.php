<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Divition;

use App\Models\Country;
use App\Models\State;
use App\Models\City;

use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Controllers\UserController; 

// Importar el facade Http y Config
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

//use App\Libraries\Pdf\Fpdf;
use App\Libraries\Pdf\WriteTag;

use Illuminate\Support\Facades\DB; // Importar la clase DB para transacciones
use Throwable; // Importar la clase Throwable para capturar excepciones
use Illuminate\Support\Facades\Log; // Importar Log para errores

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



            // Encuentra los IDs para los valores por defecto
    $defaultCountry = Country::where('name', 'Venezuela')->first();
    $defaultState = null;
    $defaultCity = null;

    if ($defaultCountry) {
        $defaultState = State::where('country_id', $defaultCountry->id)
                            ->where('name', 'Aragua')
                            ->first();
        if ($defaultState) {
            $defaultCity = City::where('state_id', $defaultState->id)
                            ->where('name', 'Maracay')
                            ->first();
        }
    }

    // Pasa los IDs (o null si no se encontraron) a la vista
    $defaultCountryId = $defaultCountry ? $defaultCountry->id : null;
    $defaultStateId = $defaultState ? $defaultState->id : null;
    $defaultCityId = $defaultCity ? $defaultCity->id : null;

    dd($defaultCountryId);



        
       // return view('modules.client.create', compact('client', 'divitions','countries', 'linkPrev', 'linkCurrent','defaultCountryId', 'defaultStateId', 'defaultCityId'));
    }



    public function store(ClientRequest $request): RedirectResponse
    {
        $remoteApiUrl = Config::get('services.remote_api.url');
        $remoteApiLoginUrl = Config::get('services.remote_api.login_url');
        $remoteApiEmail = Config::get('services.remote_api.email');
        $remoteApiPassword = Config::get('services.remote_api.password');
        $remoteApiDeviceName = Config::get('services.remote_api.device_name');

        //dd()

        // 1. Intentar autenticar en la API remota
        $loginResponse = Http::post($remoteApiLoginUrl, [
            'email' => $remoteApiEmail,
            'password' => $remoteApiPassword,
            'device_name' => $remoteApiDeviceName, // Requerido por Sanctum para SPA/API tokens
        ]);

        //dd($loginResponse);

        if (!$loginResponse->successful()) {
            // Si falla el login, logear el error y notificar al usuario
            Log::error('Error al autenticar con la API remota: ' . $loginResponse->body());
            return Redirect::back()
                ->with('error', 'Error al autenticar con el servidor remoto. No se pudo verificar la existencia del cliente.')
                ->withInput();
        }

        // Extraer el token de la respuesta de login
        $apiToken = $loginResponse->json('token'); 
        
        if (!$apiToken) {
            Log::error('No se recibió token de la API remota.');
            return Redirect::back()
            ->with('error', 'Error al obtener el token de autenticación del servidor remoto.')
            ->withInput();
        }
        
        //dd($request->validated());
        //dd($request->input('company'));
        $clientData = $request->only(['company']);

        //dd($clientData);


        // 2. Usar el token para verificar la existencia del cliente
        $checkResponse = Http::withToken($apiToken)->get($remoteApiUrl . '/clients/search/company', [
            'company' => $clientData['company'],
        ]);


        dd($checkResponse->json('data'));

        // Verificar si la llamada a la API (con token) fue exitosa
        if ($checkResponse->successful()) {
            $remoteClients = $checkResponse->json('data'); // La colección retorna los datos en la clave 'data'

            if (count($remoteClients) > 0) {
                // Se encontraron clientes con la misma compañía en el servidor remoto
                return Redirect::back()
                    ->with('error', 'El cliente con esta compañía ya existe en el servidor remoto.')
                    ->withInput();
            }
        } else {
            // La llamada a la API de verificación falló (ej: error de red, error 500, o token inválido/expirado si el login tuvo éxito pero el token falló)
            Log::error('Error al verificar cliente con API remota (después de autenticar): ' . $checkResponse->body());
                return Redirect::back()
                    ->with('error', 'Error al verificar la existencia del cliente en el servidor remoto. Intente de nuevo.')
                    ->withInput();
        }

        dd($checkResponse);
        // --- Fin: Autenticación y Verificación en la API remota ---


        //dd($apiToken);
    }


















    /**
     * Store a newly created resource in storage.
     */
    public function storeFULL(ClientRequest $request): RedirectResponse
    {
        try {

            $remoteApiUrl = Config::get('services.remote_api.url');
            $remoteApiLoginUrl = Config::get('services.remote_api.login_url');
            $remoteApiEmail = Config::get('services.remote_api.email');
            $remoteApiPassword = Config::get('services.remote_api.password');
            $remoteApiDeviceName = Config::get('services.remote_api.device_name');

            // Validar email único
            $request->validate([
                'email' => 'unique:users,email'
            ]);

            DB::beginTransaction();

            // Crear el registro de cliente
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
                        $posExtension = $request->file('image')->getClientOriginalExtension();
                        $imgName = $request->file('image');

                        $path = public_path() . '/storage/img/clients/';
                        $imagePath = $path. 'client-'.$client->id.'.'.$posExtension;


                        $pathSave = '/img/clients/';
                        $imagePathSave = $pathSave. 'client-'.$client->id.'.'.$posExtension;
                        
                        // Crear imagen temporal
                        list($width, $height) = getimagesize($imgName->getRealPath());
                        $source = imagecreatefromstring(file_get_contents($imgName->getRealPath()));
                        
                        // Calcular nuevas dimensiones manteniendo aspect ratio
                        $newWidth = 800;
                        $newHeight = 600;
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
                        
                        $client->image = $imagePathSave;
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

        return Redirect::route('clients.index')
            ->with('success', 'Client creado Satisfactoriamente.');

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

        $defaultCountryId = null;
        $defaultStateId = null;
        $defaultCityId = null;

        return view('modules.client.edit', compact('client','divitions','countries', 'linkPrev', 'linkCurrent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client): RedirectResponse
    {
        
        $client->update($request->validated());
/*
        AuditHelper::log('Cliente actualizado', [
            'action' => 'update',
            'client_id' => $client->id,
            'old_data' => $oldData,
            'new_data' => $client->fresh()->toArray(),
            'section' => 'clients'
        ]);        
*/
        return Redirect::route('clients.index')
            ->with('success', 'Client updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $client = Client::find($id);
        $clientData =  $client->toArray();
        $client->delete();
/*
        AuditHelper::log('Cliente eliminado', [
            'action' => 'delete',
            'deleted_data' => $clientData,
            'section' => 'countries'
        ]);        
*/
        return Redirect::route('clients.index')
            ->with('success', 'Client deleted successfully');
    }

}
