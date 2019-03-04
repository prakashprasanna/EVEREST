<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class finance extends Model
{
    protected $table = 'sales_finance';

    protected $primaryKey = 'sales_fin_ID';

    public $timestamps = true;

    protected $fillable = [

'sales_fin_maritalStatus',
'sales_fin_35To45k',
'sales_fin_fundSource',

    ];


 } 