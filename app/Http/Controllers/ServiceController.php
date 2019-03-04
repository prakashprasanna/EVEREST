<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryFormRequest;
use Illuminate\Http\Request;

use App\admission;
use App\funds;
use App\pcc;
use App\med;
use App\visa;
use App\onshore;
use App\enquiry;
use App\gonogo;
use App\followup;
use App\service_followup;
use App\gef_service;
use App\employee;
use App\service_leads;
use App\sales_leads;
use App\outcome;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;




class ServiceController extends Controller
{

     public function storeAdmission(Request $request, $gef_phone)
    {

            $admission = new admission;
            $admission->gef_phone = $gef_phone;         
            $admission->admission_course = $request->input('course_notes');         
            $admission->admission_intake = $request->input('status');  
            $admission->admission_stream = $request->input('subject');          
            $admission->admission_agent = $request->input('agent_notes'); 
            $admission->admission_courseChg = $request->input('stream'); 
            $admission->admission_changeNotes = $request->input('stream_notes'); 
            $admission->admission_ielts = $request->input('ielts'); 
            $admission->admission_ieltsNotes = $request->input('ielts_notes'); 
            $admission->admission_expenses = $request->input('expenses'); 
            $admission->admission_personal = $request->input('funds'); 
            $admission->admission_saveOld = $request->input('savings'); 
            $admission->admission_loanCol = $request->input('loan_notes'); 
            $admission->admission_funds = $request->input('sponsor_notes');
            $admission->addedBy = $request->input('addedBy');     
 

            $admission->save();
              $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();
              $enquiry->gef_serviceApproval = 'In Progress';
              $enquiry->tab = 'admissions';
              $enquiry->gef_up_lead_status = $request->input('status');
              $enquiry->save();
           

            return \Redirect::route('serviceView',$gef_phone);
    }



    public function storeVisa(Request $request, $gef_phone)
    {
            $service_visa = visa::where('gef_phone', '=', $gef_phone)->first();
            $service_admission = admission::where('gef_phone', '=', $gef_phone)->first();
            $outcome = outcome::where('gef_phone', '=', $gef_phone)->first();
            $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();

            $outcome->outcome_forApproval = $request->input('forApproval');
            
         if($service_visa === null && $service_admission === null){
            $visa = new visa;
            $visa->gef_phone = $gef_phone;
            $admission = new admission;
            $admission->gef_phone = $gef_phone; 

         
            $visa->visa_rejection = $request->input('rejection');         
            $visa->visa_rejNotes = $request->input('reject_notes'); 
            $visa->visa_fees = $request->input('fees');         
            $visa->visa_course = $request->input('course_notes');
            $visa->visa_gap = $request->input('gap');         
            $visa->visa_gapNotes = $request->input('gap_notes');
            $visa->visa_martial = $request->input('marital');         
            $visa->visa_spouse = $request->input('spouse');
            $visa->visa_familyFee = $request->input('family_fee');         
            $visa->visa_otherCountry = $request->input('country');
            $visa->visa_countryDocs = $request->input('country_notes');         
            $visa->visa_oldPassport = $request->input('passport');                                                
            $visa->visa_oldPassScan = $request->input('passport_notes');  
            $admission->admission_expenses = $request->input('expenses'); 
            $admission->admission_personal = $request->input('funds'); 
            $admission->admission_saveOld = $request->input('savings'); 
            $admission->admission_loanCol = $request->input('loan_notes'); 
            $admission->admission_funds = $request->input('sponsor_notes');
            $admission->admission_feeNotes = $request->input('fees_notes');
            $visa->addedBy = $request->input('addedBy');        
            $admission->addedBy = $request->input('addedBy');        
                                      
               if($outcome->outcome_ARM_CBA === null or
                  $outcome->outcome_ERM_CBA === null or     
                  $outcome->outcome_FNC_CBA === null or
                  $outcome->outcome_FSP_CBA === null){
                  $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();
                  $enquiry->tab = 'finance';
                  $enquiry->save();
                  \Session::flash('alert1', 'Please key in the mandatory checks before converting it to App!');
                  return \Redirect::route('leadView',$gef_phone);
               } else {
                 $visa->save();
                 $admission->save();
               }

            $enquiry->gef_salesApproval = 'Approved';
            $enquiry->gef_up_lead_status = $enquiry->gef_salesApproval; 
            $user = Auth::user();
            $emp = employee::where('AJV_EMP_Email', '=', $user->email)->first(); 
            if($emp->AJV_EMP_Lead != null){
               $assSTL = sales_leads::where('sales_lead_id', '=', $emp->AJV_EMP_Lead)->first();
            } else {
                $assSTL = null;
            }
               $gefService = gef_service::where('gef_phone', '=', $gef_phone)->first();
            if($gefService === null){
                 $gefS = new gef_service;
                 $gefS->gef_f_name = $enquiry->gef_f_name;     
                 $gefS->gef_l_name = $enquiry->gef_l_name;
                 $gefS->gef_phone = $enquiry->gef_phone;
                 $gefS->gef_email = $enquiry->gef_email;
                 $gefS->gef_skype = $enquiry->gef_skype;
                 $gefS->gef_nationality = $enquiry->gef_nationality;
                 $gefS->gef_location = $enquiry->gef_location;
                 $gefS->gef_destination = $enquiry->gef_destination;
                 $gefS->gef_source = $enquiry->gef_source;
                 $gefS->gef_comments = $enquiry->gef_comments;
                 $gefS->gef_subject = $enquiry->gef_subject;
                 $gefS->gef_cv = $enquiry->gef_cv;    
                if($assSTL != null){
                   $gefS->assigned_lead = $assSTL->sales_lead_email;
                } else {
                   $gefS->assigned_lead = null;  
                }
                 $gefS->gef_assigned_to = $user->email;
                 $gefS->gef_salesApproval = 'Approval Pending';  
                 $gefS->gef_serviceApproval = 'New Leads';  
                 $gefS->gef_up_lead_status = $enquiry->gef_salesApproval; 
                 $gefS->gef_added_by = $enquiry->gef_added_by;

                 $assign = service_leads::where('sales_assign_flag', '=', null)->first();
                 $assign->sales_assign_flag = 1;
                 $gefS->service_assigned_lead = $assign->sales_lead_email;
                 $gefS->gef_service_assigned_time = new DateTime();
                 $gefS->gef_service_assigned_to = $assign->sales_lead_email;
                 $notAssigned = service_leads::where('sales_assign_flag', '=', 1)->first();
                 $notAssigned->sales_assign_flag = null;
                 $notAssigned->save();
                 $assign->save();

                 $serTL = employee::where('AJV_EMP_Email', '=', $assign->sales_lead_email)->first();


    	         $data = array(
    			'firstname' => $enquiry->gef_f_name,
    			'lastname' => $enquiry->gef_l_name,
    			'deal_phone' => $enquiry->gef_phone,
    			'email' => $enquiry->gef_email,
    			'nationality' => $enquiry->gef_nationality,
    			'city' => $enquiry->gef_location,
    			'advisor' => $emp->AJV_EMP_Fname,
    			'serviceTL' => $serTL->AJV_EMP_Fname,
    			'subject' => 'New Deal!!! - '.$enquiry->gef_f_name,
    			'STL' => $assign->sales_lead_emailAlias,
    			'SAR' => $emp->AJV_EMP_emailAlias,

    	       );

    	        Mail::send('dealTemplate', $data, function ($message) use($data) {
    	        	$message->from($data['SAR'])->subject($data['firstname']);
    	
    	        	$message->to($data['STL'])->cc('dev.ops@ajv.kiwi')->subject($data['subject']);
    	        });
    	        
    	         $emp->save();

                 $gefS->save();

            }


         }

            $user = Auth::user();
            $emp = employee::where('AJV_EMP_Email', '=', $user->email)->first();
          if($emp->AJV_DEP_ID === '1'){
              $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();
              $enquiry->tab = null;
              $enquiry->gef_salesApproval = 'Approval Pending';
              $enquiry->save();
              $outcome->save();
              $flash = 'App converted and will be handled by service TL - '.$serTL->AJV_EMP_Fname;
                  \Session::flash('success', $flash);
           
              return \Redirect::route('leadView',$gef_phone);
            
         } else {
              $enquiry = gef_service::where('gef_phone', '=', $gef_phone)->first();
              $enquiry->tab = 'followup';
              $enquiry->save();
              $outcome->save();             
              return \Redirect::route('serviceView',$gef_phone);
         
         }
    }

     public function updateAdmission(Request $request, $gef_phone)
    {

            $admission = admission::where('gef_phone', '=', $gef_phone)->first();
            $admission->gef_phone = $gef_phone;         
            $admission->admission_course = $request->input('course_notes');         
            $admission->admission_intake = $request->input('status');  
            $admission->admission_stream = $request->input('subject');          
            $admission->admission_agent = $request->input('agent_notes'); 
            $admission->admission_courseChg = $request->input('stream'); 
            $admission->admission_changeNotes = $request->input('stream_notes'); 
            $admission->admission_ielts = $request->input('ielts'); 
            $admission->admission_ieltsNotes = $request->input('ielts_notes'); 
            $admission->admission_expenses = $request->input('expenses'); 
            $admission->admission_personal = $request->input('funds'); 
            $admission->admission_saveOld = $request->input('savings'); 
            $admission->admission_loanCol = $request->input('loan_notes'); 
            $admission->admission_funds = $request->input('sponsor_notes'); 

            $admission->save();
              $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();
              $enquiry->gef_serviceApproval = 'In Progress';
              $enquiry->tab = 'admissions';
              $enquiry->gef_up_lead_status = $request->input('status');
              $enquiry->save();
           

            return \Redirect::route('serviceView',$gef_phone);
    }



    public function updateVisa(Request $request, $gef_phone)
    {

            $visa = visa::where('gef_phone', '=', $gef_phone)->first();
            $admission = admission::where('gef_phone', '=', $gef_phone)->first();

            $visa->gef_phone = $gef_phone;
            $admission->gef_phone = $gef_phone;   
         
            $visa->visa_rejection = $request->input('rejection');         
            $visa->visa_rejNotes = $request->input('reject_notes'); 
            $visa->visa_fees = $request->input('fees');         
            $visa->visa_course = $request->input('course_notes');
            $visa->visa_gap = $request->input('gap');         
            $visa->visa_gapNotes = $request->input('gap_notes');
            $visa->visa_martial = $request->input('marital');         
            $visa->visa_spouse = $request->input('spouse');
            $visa->visa_familyFee = $request->input('family_fee');         
            $visa->visa_otherCountry = $request->input('country');
            $visa->visa_countryDocs = $request->input('country_notes');         
            $visa->visa_oldPassport = $request->input('passport');                                                
            $visa->visa_oldPassScan = $request->input('passport_notes');   
            $admission->admission_expenses = $request->input('expenses'); 
            $admission->admission_personal = $request->input('funds'); 
            $admission->admission_saveOld = $request->input('savings'); 
            $admission->admission_loanCol = $request->input('loan_notes'); 
            $admission->admission_funds = $request->input('sponsor_notes');       

                                       
            $visa->save();
            $admission->save();

            $user = Auth::user();
            $emp = employee::where('AJV_EMP_Email', '=', $user->email)->first();
          if($emp->AJV_DEP_ID === '1'){
              $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();
              $enquiry->tab = 'finance';
              $enquiry->gef_salesApproval = 'Approval Pending';
              $enquiry->save();


           if($enquiry->gef_service_assigned_to != null) {   

                $CO= employee::where('AJV_EMP_Email', '=', $enquiry->gef_service_assigned_to)->first();
            
               if($enquiry->service_assigned_lead != null){
                  $serTL = employee::where('AJV_EMP_Email', '=', $enquiry->service_assigned_lead)->first();
               } else {
                  $serTL = employee::where('AJV_EMP_Email', '=', $enquiry->gef_service_assigned_to)->first();
               }            
               
    	         $data = array(
    			'firstname' => $enquiry->gef_f_name,
    			'lastname' => $enquiry->gef_l_name,
    			'deal_phone' => $enquiry->gef_phone,
    			'email' => $enquiry->gef_email,
    			'nationality' => $enquiry->gef_nationality,
    			'city' => $enquiry->gef_location,
    			'advisor' => $emp->AJV_EMP_Fname,
    			'serviceTL' => $CO->AJV_EMP_Fname,
    			'subject' => 'Deal resent for Acceptance!!! - '.$enquiry->gef_f_name,
    			'CO' => $CO->AJV_EMP_emailAlias,
    			'STL' => $serTL->AJV_EMP_emailAlias,
    			'SAR' => $emp->AJV_EMP_emailAlias,

    	       );

    	        Mail::send('dealResent', $data, function ($message) use($data) {
    	        	$message->from($data['SAR'])->subject($data['firstname']);
    	
    	        	$message->to($data['CO'])->cc('dev.ops@ajv.kiwi',$data['STL'])->subject($data['subject']);
    	        });   
    	        
              $enquiry = gef_service::where('gef_phone', '=', $gef_phone)->first();
              $enquiry->gef_serviceApproval = 'New Leads';
              $enquiry->save();        	        
    	        
           }
           
            return \Redirect::route('leadView',$gef_phone);
          } else {
              $enquiry = gef_service::where('gef_phone', '=', $gef_phone)->first();
              $enquiry->tab = 'followup';
              $enquiry->save();              
            return \Redirect::route('serviceView',$gef_phone);
          }     
          
          
          
    }

    public function storeServiceFollowup(Request $request, $gef_phone)
    {

            $gonogo = gonogo::where('gef_phone', '=', $gef_phone)->first();
            $user = Auth::user();
        
            $followup = new service_followup;
            $followup->sales_followup_type = $request->input('followType');
            $followup->gef_phone = $gef_phone;                  
            $followup->sales_followup_notes = $request->input('notes');    
            $followup->sales_followup_status = $request->input('status');    
            $followup->added_by = $request->input('addedBy'); 
            $followup->tab = 'followup';
            
            $enquiry = gef_service::where('gef_phone', '=', $gef_phone)->first();
            $enquiry->tab = 'followup';
	        $enquiry->gef_up_app_status = $request->input('status');

            $followup->gef_assigned_to = $enquiry->gef_assigned_to; 
            $followup->gef_service_assigned_to = $enquiry->gef_service_assigned_to; 

            $followup->previous_status = $enquiry->gef_serviceApproval; 

            $employee = employee::where('AJV_EMP_Email', '=', $enquiry->gef_service_assigned_to)->first();
            
            $SA = employee::where('AJV_EMP_Email', '=', $enquiry->gef_assigned_to)->first();
            
            $SATL = employee::where('AJV_EMP_Email', '=', $enquiry->assigned_lead)->first();              
           if($SATL === null){   
               $SATL = employee::where('AJV_EMP_Email', '=', $enquiry->gef_assigned_to)->first();
           }             

            if($employee->AJV_DEP_ID === '2'){
              if($employee->AJV_EMP_Lead != null){
                if($employee->AJV_EMP_Lead === '3'){
                  $followup->sales_emp_lead = 'KIWI 1'; 
                } else {
                  $followup->sales_emp_lead = 'KIWI 2'; 
                }
              }
            } 

              $followup->sales_emp_sName = $employee->AJV_EMP_shortName;              

           if($request->input('reminder') != null){
              $enquiry->reminder_date = $request->input('reminder');
           }

           if($request->input('callCat') != null){
              $followup->sales_followup_subType = $request->input('callCat');
           } 
          
           if($request->input('dropCat') != null){    
              $followup->drop_category = $request->input('dropCat'); 
           }
             
            $gonogo->gonogo_skilled = $request->input('status');  
           
           if($request->input('status') != 'Drop Pending'){
              $enquiry->gef_serviceApproval = 'In Progress';
           } else {
              $enquiry->gef_serviceApproval = $request->input('status');
              $enquiry->gef_prev_status = 'Drop Pending';
              $enquiry->gef_up_app_status = 'Drop Pending';
            
               $gef = enquiry::where('gef_phone', '=', $gef_phone)->first();
            if($gef === null){
                 $gefS = new enquiry;
                 $gefS->gef_f_name = $enquiry->gef_f_name;     
                 $gefS->gef_l_name = $enquiry->gef_l_name;
                 $gefS->gef_phone = $enquiry->gef_phone;
                 $gefS->gef_email = $enquiry->gef_email;
                 $gefS->gef_skype = $enquiry->gef_skype;
                 $gefS->gef_nationality = $enquiry->gef_nationality;
                 $gefS->gef_location = $enquiry->gef_location;
                 $gefS->gef_destination = $enquiry->gef_destination;
                 $gefS->gef_source = $enquiry->gef_source;
                 $gefS->gef_comments = $enquiry->gef_comments;
                 $gefS->gef_subject = $enquiry->gef_subject;
                 $gefS->gef_cv = $enquiry->gef_cv;  
                if($enquiry->gef_assigned_to = 'dev.ops@ajvglobal.com'){
                  $assign = sales_leads::where('sales_assign_flag', '=', null)->first();
                  $assign->sales_assign_flag = 1;
                  $gefS->assigned_lead = $assign->sales_lead_email;
                  $gefS->gef_sales_assigned_time = new DateTime();
                  $gefS->gef_assigned_to = $assign->sales_lead_email;
                  $notAssigned = sales_leads::where('sales_assign_flag', '=', 1)->first();
                  $notAssigned->sales_assign_flag = null;
                  $notAssigned->save();
                  $assign->save();     
                  
                } else { 
                  $gefS->assigned_lead = $enquiry->assigned_lead;
                  $gefS->gef_assigned_to = $enquiry->gef_assigned_to;
                }   
                 $gefS->gef_salesApproval = 'New Leads';  
                 $gefS->gef_up_lead_status = 'New Leads'; 
                 $gefS->gef_up_app_status =  $enquiry->gef_up_app_status; 
                 $gefS->gef_serviceApproval = $enquiry->gef_serviceApproval; 
                 $gefS->service_assigned_lead = $enquiry->service_assigned_lead;
                 $gefS->gef_service_assigned_to = $enquiry->gef_service_assigned_to;                 
                 
                 $gefS->gef_added_by = $user->email;
                 
                 $gefS->save();
    
           } else {
                 $gef->gef_salesApproval = 'New Leads';  
                 $gef->gef_up_lead_status = 'New Leads'; 
                 $gef->gef_up_app_status =  $enquiry->gef_up_app_status; 
                 $gef->gef_serviceApproval = $enquiry->gef_serviceApproval; 
                 $gef->service_assigned_lead = $enquiry->service_assigned_lead;
                 $gef->gef_service_assigned_to = $enquiry->gef_service_assigned_to;                 
                 
                 $gef->gef_added_by = $user->email;  
                 $gef->save();
                
           }   
           
           
    	         $data = array(
    			'firstname' => $enquiry->gef_f_name,
    			'lastname' => $enquiry->gef_l_name,
    			'deal_phone' => $enquiry->gef_phone,
    			'email' => $enquiry->gef_email,
    			'nationality' => $enquiry->gef_nationality,
    			'city' => $enquiry->gef_location,
    			'advisor' => $SA->AJV_EMP_Fname,
    			'caseOfficer' => $employee->AJV_EMP_Fname,
    			'subject' => 'Deal Dropped!!! - '.$enquiry->gef_f_name,
    			'SA' => $SA->AJV_EMP_emailAlias,
    			'CO' => $employee->AJV_EMP_emailAlias,
                'reason' => $request->input('notes'),
                'SATL' => $SATL->AJV_EMP_emailAlias,
    	       );

    	        Mail::send('dealDropTemplate', $data, function ($message) use($data) {
    	        	$message->from($data['CO'])->subject($data['firstname']);
    	
    	        	$message->to($data['SA'])->cc('dev.ops@ajv.kiwi',$data['SATL'])->subject($data['subject']);
    	        });  
    	        
    	        
           }       

           if($request->input('status') === 'Accepted by CO'){
               
    	         $data = array(
    			'firstname' => $enquiry->gef_f_name,
    			'lastname' => $enquiry->gef_l_name,
    			'deal_phone' => $enquiry->gef_phone,
    			'email' => $enquiry->gef_email,
    			'nationality' => $enquiry->gef_nationality,
    			'city' => $enquiry->gef_location,
    			'advisor' => $SA->AJV_EMP_Fname,
    			'caseOfficer' => $employee->AJV_EMP_Fname,
    			'subject' => 'Deal Accepted!!! - '.$enquiry->gef_f_name,
    			'SA' => $SA->AJV_EMP_emailAlias,
    			'CO' => $employee->AJV_EMP_emailAlias,
                'reason' => $request->input('notes'),
                'SATL' => $SATL->AJV_EMP_emailAlias,
    	       );

    	        Mail::send('dealAccepted', $data, function ($message) use($data) {
    	        	$message->from($data['CO'])->subject($data['firstname']);
    	
    	        	$message->to($data['SA'])->cc('dev.ops@ajv.kiwi',$data['SATL'])->subject($data['subject']);
    	        });         
    	        
    	      $SA->appsCount = $SA->appsCount + 1;
              $SA->save(); 
           }       


            $enquiry->save();
 
            $gonogo->save();

            $followup->save();
   
            return \Redirect::route('serviceView',$gef_phone);
    }


}