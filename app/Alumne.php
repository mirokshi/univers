<?php

namespace App;

use App\Traits\FormattedDates;
use Illuminate\Database\Eloquent\Model;

class Alumne extends Model
{
    use FormattedDates;

    protected $guarded = [];

    protected $hidden = [
        'created_at'
    ];


    public function addActivitats($activitat)
    {
        try{
            $this->activitats()->saveMany($activitat);
        }catch (\Exception $e){

        }
    }

    public function addActivitat($actvitat)
    {

        !is_int($actvitat) ?: $actvitat = Activitat::find($actvitat);
        try {
            $this->activitats()->save($actvitat);
        }catch (\Exception $e){

        }
        return $this;
    }

    public function activitats()
    {
        return $this->belongsToMany(Activitat::class);
    }

    public function removeActivitat($activitat)
    {
        $this->activitats()->detach($activitat);
    }

    public function assignUser(User $user)
    {
        $this->user()->associate($user);
        $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toggleChange()
    {
        $this->change = !$this->change;
        $this->save();
    }
    public function map()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'birthdate' => $this->birthdate,
            'age' => $this->age,
            'school' => $this->school,
            'course' => $this->course= date('Y').'-'.(date('Y')+1),
            'school_course' => $this->school_course,
            'sex' => $this->sex,
            'phone' => $this->phone,
            'change' => (boolean)$this->change,
            'user_id' => (int)$this->user_id,
            'user_name' => optional($this->user)->name,
            'user_email' => optional($this->user)->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_at_formatted' => $this->created_at_formatted,
            'updated_at_formatted' => $this->updated_at_formatted,
            'created_at_human' => $this->created_at_human,
            'updated_at_human' => $this->updated_at_human,
            'created_at_timestamp' => $this->created_at_timestamp,
            'updated_at_timestamp' => $this->updated_at_timestamp,
            'user' => $this->user,
            'full_search' =>$this->full_search,
            'activitats' =>$this->activitats

        ];
    }

    public function mapSimple()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'birthdate' => $this->birthdate,
            'school' => $this->school,
            'activitats' =>$this->activitats,
            'user_id' => optional($this->user)->id
        ];
    }
        public function getFullSearchAttribute()
    {
        $state = $this->change ? 'Alta' : 'Baja';
        $username = optional($this->user)->name;
        $useremail = optional($this->user)->email;
        return "$this->id $this->name $this->surname $this->birtthdate $this->age $this->school $this->course $this->school_course $this->sex $this->phone $state $username $useremail";
    }

}
