<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class enquiry extends Model
{
	protected $table = 'gef';
    //
	protected $primaryKey = 'gef_id';

	public $incrementing = 'false';

    public $timestamps = true;

    protected $fillable = [
        'gef_id',
        'gef_phone',
'gef_f_name',
'gef_l_name',
'gef_email',
'gef_skype',
'gef_nationality',
'gef_location',
'gef_destination',
'gef_pathway',
'gef_subject',
'gef_institute',
'gef_source',
'gef_cv',
'gef_comments',
'gef_assigned_to',
'gef_service_assigned_to',
'gef_salesApproval',
'gef_serviceApproval'

    ];

    public static function rules()
    {

         return [
    'firstname' => 'required',
    'gef_phone' => 'required',
    'nationality' => 'required',
    'destination' => 'required',
    'subject' => 'required',
    'source' => 'required',
     ];
    }

    public static  $messages=array(
         'firstname.required'=>'Enter your First Name',
         'gef_phone.required'=>'Enter your Mobile Number',
         'gef_email.required'=>'Enter your Email-id',
         'nationality.required'=>'Your Nationality',
         'Location.required'=>'Your current Location',
         'subject.required'=>'Choose a Pathway',
         'Source.required'=>'How did you get to know about AJV? choose a Source',

        );




	public static function getGefData()
{
    $user = Auth::user();
    if($user != null){
     $dep = ajv_department::where('AJV_DEP_Head','=',$user->email)->first();
     if($dep != null){
       $value=enquiry::where('gef_salesApproval','=','New Leads')->paginate(7);
     } else {
       $value=enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','New Leads')->paginate(7);        
     }
    return $value;
    }
}

    public static function getGefData2()
{
    $user = Auth::user();
    if($user != null){
     $dep = ajv_department::where('AJV_DEP_Head','=',$user->email)->first();    
     if($dep != null){    
        $value=enquiry::whereNotNull('gef_assigned_To')->where('gef_salesApproval','=','In Progress')->paginate(7);
     } else {
        $value=enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->paginate(7);        
     } 
    return $value;
    }
}


public function nationality()
    {
        return $this->belongsTo('App\nationality','gef_nationality','nationality_id');
    }

public function country()
    {
        return $this->belongsTo('App\country','gef_location','country_id');
    }

public function employee()
    {
        return $this->belongsTo('App\employee','gef_assigned_to','AJV_EMP_email');
    }

public function pathway()
    {
        return $this->belongsTo('App\pathway','gef_pathway','AJV_destination_pathway_id');
    }

public function destination()
    {
        return $this->belongsTo('App\destination', 'gef_destination','AJV_destination_id');
    }

public function source()
    {
        return $this->belongsTo('App\source', 'gef_source','source_id');
    }
    
public function subject()
    {
        return $this->belongsTo('App\subject', 'gef_subject','subject_id');
    }


}

