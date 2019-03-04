<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class outcome extends Model
{
    protected $table = 'sales_outcome';

    protected $primaryKey = 'outcome_ID';

    public $timestamps = true;

    protected $fillable = [
'outcome_forApproval',
'outcome_status',
'outcome_passportNo',
'outcome_inTakeQuater',
'outcome_inst1',
'outcome_inst1_campus',
'outcome_course1',
'outcome_course1_startDate',
'outcome_inst2',
'outcome_inst2_campus',
'outcome_course2',
'outcome_course2_startDate',
'outcome_inst3',
'outcome_inst3_campus',
'outcome_course3', 
'outcome_course3_startDate',
'outcome_comments'  
    ];

    public function ajv_department()
    {
        return $this->belongsTo('App\ajv_department','outcome_forApproval','AJV_DEP_ID');
    }


 } 