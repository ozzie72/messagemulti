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
 * @property $divition_id
 * @property $department_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Department $department
 * @property Divition $divition
 * @property Campaign[] $campaigns
 * @property PhoneList[] $phoneLists
 * @property User[] $users

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
    protected $fillable = ['name', 'ip', 'port', 'server_user', 'server_pass', 'image', 'status', 'divition_id', 'department_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class, 'department_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function divition()
    {
        return $this->belongsTo(\App\Models\Divition::class, 'divition_id', 'id');
    }
    
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
    
    
}
