<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class academics extends Model
{
    protected $table = 'sales_academics';

    protected $primaryKey = 'academics_ID';

    public $timestamps = true;

    protected $fillable = [

'academics_higestDegree1', 
'academics_yearOfPassing1',
'academics_university1',
'academics_uni_city1',
'academics_final_result1', 
'academics_higestDegree2', 
'academics_yearOfPassing2',
'academics_university2',
'academics_uni_city2',
'academics_final_result2', 
'academics_anyGap',
'academics_gap_howLong',
'academics_gap_reason',

    ];


 } 