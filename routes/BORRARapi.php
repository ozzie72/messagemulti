<?php
use App\Models\Divition;
use App\Models\Department;

Route::get('/divitions/{divition}/departments', function ($divitionId) {
    if (!Divition::find($divitionId)) {
        return response()->json([
            'error' => 'Divition not found'
        ], 404);
    }

    return response()->json(
        Department::where('divition_id', $divitionId)
                  ->select('id', 'name') // Solo los campos necesarios
                  ->get()
    );
});