<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class employee extends Model
{
        use Notifiable;

    protected $table = 'ajv_employee';

    protected $primaryKey = 'AJV_EMP_ID';

    public $timestamps = true;

    protected $fillable = [
'AJV_EMP_Fname',
'AJV_EMP_Lname', 
'AJV_EMP_DOB', 
'AJV_EMP_JoinDate', 
'AJV_EMP_Email', 
'AJV_EMP_MobileNum', 
'AJV_EMP_HomeNum', 
'AJV_EMP_SpouseMobile', 
'AJV_EMP_Address', 
'AJV_EMP_LocationOfWork', 
'AJV_EMP_Aadhar', 
'AJV_EMP_PanNo', 
'AJV_EMP_IrdNo', 
'AJV_DEP_ID', 
'AJV_EMP_FullName_ID_proof',
'AJV_EMP_BankAccountNo', 
'AJV_EMP_BankName', 
'AJV_EMP_BankAddress', 
'AJV_EMP_IFSCCode', 
'AJV_EMP_SalaryBand', 
'AJV_EMP_MonthlyTarget', 
'AJV_EMP_workAssigned', 
'AJV_EMP_workCompleted' 
    ];


    public function gef()
    {
        return $this->hasMany('App\enquiry', 'gef_assigned_to','AJV_EMP_email');
    }

    public static function getEmpSummary()
	{
     	$value=employee::all();
    	return $value;
	}

}

