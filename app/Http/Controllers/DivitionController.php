<?php

namespace App\Http\Controllers;

use App\Models\Divition;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DivitionRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Helpers\AuditHelper;

class DivitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $divitions = Divition::paginate();

        return view('divition.index', compact('divitions'))
            ->with('i', ($request->input('page', 1) - 1) * $divitions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $divition = new Divition();

        return view('divition.create', compact('divition'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DivitionRequest $request): RedirectResponse
    {
        Divition::create($request->validated());

        return Redirect::route('divitions.index')
            ->with('success', 'Divition created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $divition = Divition::find($id);

        return view('divition.show', compact('divition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $divition = Divition::find($id);

        return view('divition.edit', compact('divition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DivitionRequest $request, Divition $divition): RedirectResponse
    {
        $divition->update($request->validated());

        return Redirect::route('divitions.index')
            ->with('success', 'Divition updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Divition::find($id)->delete();

        return Redirect::route('divitions.index')
            ->with('success', 'Divition deleted successfully');
    }
}
