<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nationality extends Model
{
    protected $table = 'nationality';

    public function gef()
    {
        return $this->hasMany('App\enquiry', 'gef_nationality','nationality_id');
    }


}
