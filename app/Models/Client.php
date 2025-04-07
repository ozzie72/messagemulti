<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 *
 * @property $id
 * @property $name
 * @property $ip
 * @property $port
 * @property $server_user
 * @property $server_pass
 * @property $image
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Campaign[] $campaigns
 * @property PhoneList[] $phoneLists
 * @property User[] $users
 * @property Divition[] $divition
 * @property Department[] $department
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Client extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'ip', 'port', 'server_user', 'server_pass', 'image', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function campaigns()
    {
        return $this->hasMany(\App\Models\Campaign::class, 'id', 'client_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phoneLists()
    {
        return $this->hasMany(\App\Models\PhoneList::class, 'id', 'client_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'id', 'client_id');
    }

    // Relación con Divition (un cliente pertenece a una división)
    public function divition()
    {
        return $this->belongsTo(Divition::class);
    }

    // Relación con DivDepartment (un cliente pertenece a un departamento)
    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    
}
