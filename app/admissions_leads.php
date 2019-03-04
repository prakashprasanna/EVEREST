
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admissions_leads extends Model
{
    protected $table = 'admissions_leads';

    protected $primaryKey = 'sales_lead_id';

    public $timestamps = true;
  
}