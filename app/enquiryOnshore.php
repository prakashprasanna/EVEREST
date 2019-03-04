<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class enquiryOnshore extends Model
{
	protected $table = 'onshore_enquiry';
    //
	protected $primaryKey = 'onshore_id';

	public $incrementing = 'false';

    public $timestamps = true;

    protected $fillable = [
        'onshore_id',
        'onshore_phone',
'onshore_FN',
'onshore_LN',
'onshore_email',
'onshore_nationality',
'onshore_city',
'onshore_course',
'onshore_college',
'onshore_expDate',
'onshore_source',
'onshore_comments',
    ];

    public static function rules()
    {

         return [
    'firstname' => 'required',
    'onshore_phone' => 'required|unique:onshore_enquiry',
    'nationality' => 'required',
    'city' => 'required',
    'course' => 'required',
    'college' => 'required',
    'expDate' => 'required',
    'source' => 'required',
     ];
    }

    public static  $messages=array(
         'firstname.required'=>'Enter your First Name',
         'lastname.required'=>'Enter your Last Name',
         'onshore_phone.unique'=>'There is already an enquiry with this mobile number',
         'onshore_phone.required'=>'Enter your Mobile Number',
         'email.unique'=>'There is already an enquiry with this email id',
         'email.required'=>'Enter your Email-id',
         'nationality.required'=>'Your Nationality',
         'city.required'=>'Your current city',
         'course.required'=>'Please enter the course',
         'college.required'=>'Please enter the college',
         'expDate.required'=>'Visa Expiry Date',
         'source.required'=>'Enter a Source'

        );


public function nationality()
    {
        return $this->belongsTo('App\nationality','onshore_nationality','nationality_id');
    }




}

