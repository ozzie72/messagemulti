<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ClientCollection;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = Client::with(['country', 'state', 'city', 'divition', 'department'])
            ->filter($request->all())
            ->paginate();
            
        return new ClientCollection($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'ip' => ['nullable', 'string', 'max:45'],
            'port' => ['nullable', 'string', 'max:10'],
            'server_user' => ['nullable', 'string', 'max:255'],
            'server_pass' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
            'divition_id' => ['nullable', 'integer', 'exists:divitions,id'],
            'department_id' => ['nullable', 'integer', 'exists:departments,id'],
            'country_id' => ['nullable', 'integer', 'exists:countries,id'],
            'state_id' => ['nullable', 'integer', 'exists:states,id'],
            'city_id' => ['nullable', 'integer', 'exists:cities,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $client = Client::create($validator->validated());
        return new ClientResource($client->load(['country', 'state', 'city', 'divition', 'department']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return new ClientResource($client->load(['country', 'state', 'city', 'divition', 'department', 'users', 'campaigns']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'company' => ['sometimes', 'string', 'max:255'],
            'name' => ['sometimes', 'string', 'max:255'],
            'last_name' => ['sometimes', 'string', 'max:255'],
            'ip' => ['nullable', 'string', 'max:45'],
            'port' => ['nullable', 'string', 'max:10'],
            'server_user' => ['nullable', 'string', 'max:255'],
            'server_pass' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'boolean'],
            'divition_id' => ['nullable', 'integer', 'exists:divitions,id'],
            'department_id' => ['nullable', 'integer', 'exists:departments,id'],
            'country_id' => ['nullable', 'integer', 'exists:countries,id'],
            'state_id' => ['nullable', 'integer', 'exists:states,id'],
            'city_id' => ['nullable', 'integer', 'exists:cities,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $client->update($validator->validated());
        return new ClientResource($client->load(['country', 'state', 'city', 'divition', 'department']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(null, 204);
    }

/**
     * Search clients by company name.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\ClientCollection
     */
    public function searchByCompany(Request $request)
    {
        $searchTerm = $request->input('company');

        if (empty($searchTerm)) {
             // Return an empty collection if no search term is provided
            return new ClientCollection(Client::paginate());
        }

        $clients = Client::with(['country', 'state', 'city', 'divition', 'department'])
            ->where('company', 'LIKE', '%' . $searchTerm . '%')
            ->paginate();

        return new ClientCollection($clients);
    }


}