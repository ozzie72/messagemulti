<?php

namespace App\Http\Controllers;

use App\ListNumber;
use App\Log;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->search){
            $logs = \DB::table('logs')->select('logs.id','users.username','clients.name','logs.created_at','logs.operation','logs.ip')
                ->join('users', 'users.id', '=', 'logs.user_id')
                ->join('clients', 'clients.id', '=', 'users.client_id')
                ->where('logs.operation','LIKE','%'.$request->search.'%')
                ->orWhere('logs.ip','LIKE','%'.$request->search.'%')
                ->orWhere('users.username','LIKE','%'.$request->search.'%')
                ->orWhere('clients.name','LIKE','%'.$request->search.'%')
                ->orderBy('logs.id','DESC')
                ->paginate(10);
        }else{
            $logs = \DB::table('logs')->select('logs.id','users.username','clients.name','logs.created_at','logs.operation','logs.ip')
                ->join('users', 'users.id', '=', 'logs.user_id')
                ->join('clients', 'clients.id', '=', 'users.client_id')
                ->orderBy('logs.id','DESC')
                ->paginate(10);
        }

        return view('modules.logs.index')->with([
            'logs' => $logs,
            'search' => $request->search
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //
        if($request->search){
            $logs = \DB::table('logs')->select('logs.id','users.username','clients.name','logs.created_at','logs.operation','logs.ip')
                ->join('users', 'users.id', '=', 'logs.user_id')
                ->join('clients', 'clients.id', '=', 'users.client_id')
                ->where('logs.operation','LIKE','%'.$request->search.'%')
                ->orWhere('logs.ip','LIKE','%'.$request->search.'%')
                ->orWhere('users.username','LIKE','%'.$request->search.'%')
                ->orWhere('clients.name','LIKE','%'.$request->search.'%')
                ->orderBy('logs.id','DESC')
                ->paginate(10);
        }else{
            $logs = \DB::table('logs')->select('logs.id','users.username','clients.name','logs.created_at','logs.operation','logs.ip')
                ->join('users', 'users.id', '=', 'logs.user_id')
                ->join('clients', 'clients.id', '=', 'users.client_id')
                ->orderBy('logs.id','DESC')
                ->paginate(10);
        }

        return view('modules.logs.index')->with([
            'logs' => $logs,
            'search' => $request->search
        ]);
    }


}
