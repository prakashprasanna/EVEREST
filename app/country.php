<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $table = 'country';

       public function gef()
    {
        return $this->hasMany('App\enquiry', 'gef_location','country_id');
    }

}
