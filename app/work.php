<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class work extends Model
{
    protected $table = 'sales_work';

    protected $primaryKey = 'work_ID';

    public $timestamps = true;

    protected $fillable = [

'work_anyExp',
'work_exp_company1',
'work_exp_designation1',
'work_exp_employmentPeriod1',
'work_exp_location1',
'work_exp_company2',
'work_exp_designation2',
'work_exp_employmentPeriod2',
'work_exp_location2',
'work_anyGap',
'work_gap_howLong',
'work_gap_reason',

    ];


 } 