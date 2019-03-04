<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class destination extends Model
{
    protected $table = 'ajv_destinations';

     public function gef()
    {
        return $this->hasMany('App\enquiry', 'gef_destination','AJV_destination_id');
    }
}
