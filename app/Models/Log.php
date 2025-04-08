<?php

namespace App\Models; // Si usas Laravel 8+

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    
    protected $fillable = [
        'operation', 
        'ip', 
        'user_id',
        'type',
        'details',
        'url',
        'method'
    ];

    protected $casts = [
        'details' => 'array' // Para manejar automáticamente los detalles como array
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}