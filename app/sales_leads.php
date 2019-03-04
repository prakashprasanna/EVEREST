<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales_leads extends Model
{
    protected $table = 'sales_leads';

    protected $primaryKey = 'sales_lead_id';

    public $timestamps = true;
  
}