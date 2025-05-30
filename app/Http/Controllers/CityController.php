<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Helpers\AuditHelper;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $cities = City::paginate();

        return view('modules.city.index', compact('cities'))
            ->with('i', ($request->input('page', 1) - 1) * $cities->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $city = new City();
        $states = State::all(); 

        return view('modules.city.create', compact('city', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request): RedirectResponse
    {
        City::create($request->validated());

        return Redirect::route('cities.index')
            ->with('success', 'City created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $city = City::find($id);

        return view('modules.city.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $city = City::find($id);
        $states = State::all(); 

        return view('modules.city.edit', compact('city', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city): RedirectResponse
    {
        $city->update($request->validated());

        return Redirect::route('cities.index')
            ->with('success', 'City updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        City::find($id)->delete();

        return Redirect::route('cities.index')
            ->with('success', 'City deleted successfully');
    }

    public function ByState($stateId)
    {
        return response()->json(
            City::where('state_id', $stateId)->get()
        );
    }


}
