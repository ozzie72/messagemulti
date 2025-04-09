<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Divition;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Helpers\AuditHelper;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Department::with('divition')->select('*');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('departments.edit', $row->id).'" class="btn btn-primary btn-sm">Editar</a>';
                    $btn .= ' <button class="btn btn-danger btn-sm delete-btn" data-id="'.$row->id.'">Eliminar</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('modules.department.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $department = new Department();
        $divitions = Divition::all(); 

        return view('modules.department.create', compact('department','divitions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request): RedirectResponse
    {
        Department::create($request->validated());

        return Redirect::route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $department = Department::find($id);

        return view('modules.department.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $department = Department::find($id);
        $divitions = Divition::all(); 

        return view('modules.department.edit', compact('department','divitions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department): RedirectResponse
    {
        $department->update($request->validated());

        return Redirect::route('departments.index')
            ->with('success', 'Department updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Department::find($id)->delete();

        return Redirect::route('departments.index')
            ->with('success', 'Department deleted successfully');
    }
}
