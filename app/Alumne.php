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

    public function map()
    {
        return [
            'id' => $this->id,
            'name' =>$this->name,
            'surname' => $this->surname,
            'birthdate' => $this->birthdate,
            'age' => $this->age,
            'school' => $this->school,
            'course' => $this->course,
            'school_course' => $this->school_course,
            'sex' => $this->sex,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_at_formatted' => $this->created_at_formatted,
            'updated_at_formatted' => $this->updated_at_formatted,
            'created_at_human' => $this->created_at_human,
            'updated_at_human'=>$this->updated_at_human,
            'created_at_timestamp'=>$this->created_at_timestamp,
            'updated_at_timestamp'=>$this->updated_at_timestamp,

        ];

    }
}
