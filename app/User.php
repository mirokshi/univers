<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,HasRoles;

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

    public function scopeRegular($query)
    {
        return $query ->where('admin', false);
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

    public function alumnes()
    {
        return $this->hasMany(Alumne::class);
    }

    public function addAlumne($alumnes)
    {
        $this->alumnes()->save($alumnes);
    }

    public function addAlumnes($alumnes)
    {
        $this->alumnes()->saveMany($alumnes);
    }

    public function haveAlumne(Alumne $alumnes)
    {
        return $this->alumnes()->where('id',$alumnes->id)->first();
    }

    public function removeAlumne(Alumne $alumnes)
    {
        $alumnes = $this->haveAlumne($alumnes);
        if(!is_null($alumnes)) {
            return $alumnes->delete();
        }
        return false;
    }

    public function actvitat()
    {
        return $this->hasMany(Activitat::class);
    }

    public function addActvitat(Activitat $activitat){
        $this->actvitat()->save($activitat);
    }

    public function addActvitats($tags){
        $this->actvitat()->saveMany($tags);
    }

    public function haveActvitat(Activitat $activitat)
    {
        return $this->actvitat()->where('id',$activitat->id)->first();
    }

    public function removeActivitat(Activitat $activitat)
    {
        $activitat = $this->haveActvitat($activitat);
        if(!is_null($activitat)) {
            return $activitat->delete();
        }
        return false;
    }


}
