<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LogRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Log::all();
            return DataTables::of($data)
                ->make(true);
        }
        return view('modules.log.index');
    }
    
}
