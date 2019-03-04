<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ajv_department extends Model
{
    protected $table = 'ajv_department';

       public function outcome()
    {
        return $this->hasMany('App\outcome', 'outcome_forApproval','AJV_DEP_ID');
    }

}