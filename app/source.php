<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class source extends Model
{
    protected $table = 'source';

       public function gef()
    {
        return $this->hasMany('App\enquiry', 'gef_source','source_id');
    }

}