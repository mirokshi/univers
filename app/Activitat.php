<?php

namespace App;

use App\Traits\FormattedDates;
use Illuminate\Database\Eloquent\Model;

class Activitat extends Model
{
    use FormattedDates;

    protected $guarded = [];

    protected $hidden = [
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function assignUser(User $user)
    {
        $this->user()->associate($user);
        $this->save();
    }

    public function map()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date_start' => $this->date_start,
            'date_final' => $this->date_final,
            'course' => $this->course,
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

    public function addAlumne($alumne)
    {
        !is_int($alumne) ?: $alumne = Alumne::find($alumne);
        $this->alumnes()->save($alumne);
        return $this;
    }

    public function alumnes()
    {
        return $this->belongsToMany(Alumne::class);

    }

}
