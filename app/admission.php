<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admission extends Model
{
    protected $table = 'service_admission';

    protected $primaryKey = 'admission_ID';

    public $timestamps = true;

    protected $fillable = [
'admission_course', 
'admission_intake',
'admission_stream',
'admission_agent',
'admission_courseChg',
'admission_changeNotes',
'admission_ielts',
'admission_ieltsNotes',
'admission_expenses',
'admission_personal',
'admission_savings',
'admission_saveOld',
'admission_loanCol',
'admission_funds',
'addedBy',
    ];


}