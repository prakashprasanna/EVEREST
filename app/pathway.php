<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pathway extends Model
{
    protected $table = 'ajv_destination_pathways';

    public function gef()
    {
        return $this->hasMany('App\enquiry', 'gef_pathway','AJV_destination_pathway_id');
    }
}
