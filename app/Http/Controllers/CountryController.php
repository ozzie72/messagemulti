<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $country = new Country();

        return view('country.create', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request): RedirectResponse
    {
        Country::create($request->validated());

        \App\Helpers\AuditHelper::log('Creación de nuevo registro: ' . $request->name);

        return Redirect::route('countries.index')
            ->with('success', 'Country created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $country = Country::find($id);

        return view('country.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $country = Country::find($id);

        return view('country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, Country $country): RedirectResponse
    {
        $country->update($request->validated());

        return Redirect::route('countries.index')
            ->with('success', 'Country updated successfully');
    }

    public function destroy($id)
    {
        $country = Country::find($id);
        
        if(!$country) {
            if(request()->ajax()) {
                return response()->json(['error' => 'Country not found'], 404);
            }
            return Redirect::route('countries.index')
                ->with('error', 'Country not found');
        }

        $country->delete();

        if(request()->ajax()) {
            return response()->json(['success' => 'Country deleted successfully']);
        }

        return Redirect::route('countries.index')
            ->with('success', 'Country deleted successfully');
    }
}
