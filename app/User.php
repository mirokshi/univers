<?php

namespace App;

use App\Traits\FormattedDates;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,HasRoles, FormattedDates, Impersonate;

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

    public function impersonatedBy()
    {
        if ($this->isImpersonated()) return User::findOrFail(Session::get('impersonated_by'));
        return null;
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
            'admin' => (boolean)$this->admin,
            'roles' => $this->roles()->pluck('name')->unique()->toArray(),
            'permissions' => $this->getAllPermissions()->pluck('name')->unique()->toArray(),
            'hash_id' => $this->hash_id,
            'online' => $this->online,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_at_formatted' => $this->created_at_formatted,
            'updated_at_formatted' => $this->updated_at_formatted,
            'created_at_human' => $this->created_at_human,
            'updated_at_human' => $this->updated_at_human,
            'created_at_timestamp' => $this->created_at_timestamp,
            'updated_at_timestamp' => $this->updated_at_timestamp,
        ];
    }

    public function mapSimple()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
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
