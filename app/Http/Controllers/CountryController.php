<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Helpers\AuditHelper;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Country::all();
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('countries.edit', $row->id).'" class="btn btn-primary btn-sm">Editar</a>';
                    $btn .= ' <button class="btn btn-danger btn-sm delete-btn" data-id="'.$row->id.'">Eliminar</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('country.index');
    }

    public function create(): View
    {
        $country = new Country();
        return view('country.create', compact('country'));
    }

    public function store(CountryRequest $request): RedirectResponse
    {
        $country = Country::create($request->validated());

        AuditHelper::log('País creado', [
            'action' => 'create',
            'country_id' => $country->id,
            'data' => $country->toArray(),
            'section' => 'countries'
        ]);

        return Redirect::route('countries.index')
            ->with('success', 'Country created successfully.');
    }

    public function show($id): View
    {
        $country = Country::findOrFail($id);
        return view('country.show', compact('country'));
    }

    public function edit($id): View
    {
        $country = Country::findOrFail($id);
        return view('country.edit', compact('country'));
    }

    public function update(CountryRequest $request, Country $country): RedirectResponse
    {
        $oldData = $country->toArray();
        $country->update($request->validated());

        AuditHelper::log('País actualizado', [
            'action' => 'update',
            'country_id' => $country->id,
            'old_data' => $oldData,
            'new_data' => $country->fresh()->toArray(),
            'section' => 'countries'
        ]);

        return Redirect::route('countries.index')
            ->with('success', 'Country updated successfully');
    }

    public function destroy($id)
    {
        $country = Country::find($id);
        
        if(!$country) {
            AuditHelper::log('Intento de eliminar país inexistente', [
                'action' => 'delete_error',
                'country_id' => $id,
                'error' => 'Country not found',
                'section' => 'countries'
            ], 'warning');

            if(request()->ajax()) {
                return response()->json(['error' => 'Country not found'], 404);
            }
            return Redirect::route('countries.index')
                ->with('error', 'Country not found');
        }

        $countryData = $country->toArray();
        $country->delete();

        AuditHelper::log('País eliminado', [
            'action' => 'delete',
            'deleted_data' => $countryData,
            'section' => 'countries'
        ]);

        if(request()->ajax()) {
            return response()->json(['success' => 'Country deleted successfully']);
        }

        return Redirect::route('countries.index')
            ->with('success', 'Country deleted successfully');
    }
}