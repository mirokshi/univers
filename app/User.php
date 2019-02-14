<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return mixed
     *
     */
    public function isSuperAdmin()
    {
        return $this->admin;
    }

    /**
     * @return mixed
     */
    public function canImpersonate()
    {
        return $this->isSuperAdmin();
    }

    public function canBeImpersonated()
    {
        return !$this->isSuperAdmin();
    }


    public function scopeAdmin($query)
    {
        return $query ->where('admin', true);
    }

    public function map()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'gravatar' => $this->gravatar,
            'admin' => (boolean)$this->admin,
            'roles' => $this->roles()->pluck('name')->unique()->toArray(),
            'permissions' => $this->getAllPermissions()->pluck('name')->unique()->toArray(),
            'hash_id' => $this->hash_id,
            'online' => $this->online,
        ];
    }

    public function mapSimple()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'gravatar' => $this->gravatar,
            'admin' => (boolean) $this->admin,
            'hash_id' => $this->hash_id,
            'online' => $this->online,
        ];
    }

}
