<?php

// app/Http/Controllers/Api/DepartmentController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function byDivition($divitionId)
    {
        $departments = Department::where('divition_id', $divitionId)->get();
        return response()->json($departments);
    }
}