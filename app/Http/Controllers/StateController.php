<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StateRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $states = State::paginate();

        return view('state.index', compact('states'))
            ->with('i', ($request->input('page', 1) - 1) * $states->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $state = new State();
        $countries = Country::all(); 
        return view('state.create', compact('state','countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    //public function store(StateRequest $request): RedirectResponse
    public function store(StateRequest $request): RedirectResponse
    {
        State::create($request->validated());

        return Redirect::route('states.index')
            ->with('success', 'State created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $state = State::find($id);

        return view('state.show', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $state = State::find($id);
        $countries = Country::all(); 

        return view('state.edit', compact('state','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StateRequest $request, State $state): RedirectResponse
    {
        $state->update($request->validated());

        return Redirect::route('states.index')
            ->with('success', 'State updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        State::find($id)->delete();

        return Redirect::route('states.index')
            ->with('success', 'State deleted successfully');
    }
}
