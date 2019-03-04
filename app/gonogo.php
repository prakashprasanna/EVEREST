<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gonogo extends Model
{
    protected $table = 'sales_gonogo';

    protected $primaryKey = 'gonogo_ID';

    public $timestamps = true;

    protected $fillable = [
'gonogo_spokenEnglish',      
'gonogo_dob',                
'gonogo_prevNzVisa',         
'gonogo_prevInsAgentOrSelf', 
'gonogo_intakePlan',         
'gonogo_priorVisaRejection', 
'gonogo_friend',
'gonogo_group',
'gonogo_skilled',
'gonogo_ajvFee',
'gonogo_characterIssue',     
'gonogo_healthIssue',        
'gonogo_comments',           
    ];

 public function gef()
    {
        return $this->hasMany('App\enquiry', 'sales_gonogo','gonogo_ID');
    }

 }   