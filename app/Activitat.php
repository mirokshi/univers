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

    public function map()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'name_activity' => $this->name_activity,
            'date_start' => $this->date_start,
            'date_final' => $this->date_final,
            'school_course' => $this->school_course,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_at_formatted' => $this->created_at_formatted,
            'updated_at_formatted' => $this->updated_at_formatted,
            'created_at_human' => $this->created_at_human,
            'updated_at_human' => $this->updated_at_human,
            'created_at_timestamp' => $this->created_at_timestamp,
            'updated_at_timestamp' => $this->updated_at_timestamp,
            'full_search' =>$this->full_search,
            ];
    }
        public function getFullSearchAttribute()
    {

        //$username = optional($this->user)->name;
        //$useremail = optional($this->user)->email;
        return "$this->id $this->name $this->name_activity $this->date_start $this->date_final $this->school_course";
    }

}
