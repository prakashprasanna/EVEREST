<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service_leads extends Model
{
    protected $table = 'service_leads';

    protected $primaryKey = 'sales_lead_id';

    public $timestamps = true;
  
}