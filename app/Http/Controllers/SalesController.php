<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryFormRequest;
use Illuminate\Http\Request;

use App\gonogo;
use App\english;
use App\followup;
use App\academics;
use App\work;
use App\finance;
use App\outcome;
use App\enquiry;
use App\gef_NL;
use App\gef_IP;
use App\gef_DL;
use App\gef_service;
use App\employee;
use App\sales_leads;
use Illuminate\Support\Facades\Auth;
use App\comments;
use DateTime;
use PDF;
use Mail;
use Charts;

class SalesController extends Controller
{

    public function store(Request $request, $gef_phone)
    {
             
            $gonogo = gonogo::where('gef_phone', '=', $gef_phone)->first();     
            $academics = academics::where('gef_phone', '=', $gef_phone)->first();     
            $english = english::where('gef_phone', '=', $gef_phone)->first();     
            $work = work::where('gef_phone', '=', $gef_phone)->first();     
            $finance = finance::where('gef_phone', '=', $gef_phone)->first();     
            $outcome = outcome::where('gef_phone', '=', $gef_phone)->first();     
            $followup = followup::where('gef_phone', '=', $gef_phone)->orderBy('created_at','DESC')->first();     

            $gonogo->gonogo_intakePlan = $request->input('intake');    
            $gonogo->gonogo_dob = $request->input('age');
            $gonogo->gonogo_spokenEnglish = $request->input('englishSkill');
            $english->english_testTaken = $request->input('ieltspte');   
            $academics->academics_anyGap  = $request->input('gaps');   
            $academics->academics_gap_reason = $request->input('gapComments');     
            $work->work_totalExp = $request->input('workExp');  
            $work->work_gap_reason = $request->input('workComments'); 
            $finance->sales_fin_35To45k = $request->input('afford');   
            $finance->sales_fin_fundSource = $request->input('funds'); 
            $finance->sales_fin_comments = $request->input('fundsComments'); 
            $gonogo->gonogo_prevInsAgentOrSelf = $request->input('app');   
            $gonogo->gonogo_appComments = $request->input('appComments');  
            $gonogo->gonogo_priorVisaRejection = $request->input('decline');
            $gonogo->gonogo_prevNzVisa = $request->input('declineComments');
            $gonogo->gonogo_characterIssue = $request->input('criminal'); 
            $gonogo->gonogo_criminalComments = $request->input('criminalComments');

            $gonogo->gonogo_healthIssue = $request->input('health');  
            $gonogo->gonogo_healthComments = $request->input('healthComments');

            $gonogo->gonogo_family = $request->input('family'); 
            $gonogo->gonogo_familyComments = $request->input('familyComments');

            if($request->input('No') != 'No'){          
               $gonogo->australia = $request->input('Australia');           
               $gonogo->canada = $request->input('Canada');           
               $gonogo->uk = $request->input('UK');           
               $gonogo->usa = $request->input('USA');           
               $gonogo->ireland = $request->input('Ireland');           
               $gonogo->singapore= $request->input('Singapore');           
               $gonogo->dubai = $request->input('Dubai');           
               $gonogo->germany = $request->input('Germany');
            }   
            $gonogo->gonogo_no= $request->input('No');
            $gonogo->gonogo_passport = $request->input('passport'); 
            $gonogo->gonogo_friend = $request->input('fb'); 
            $gonogo->gonogo_group = $request->input('fbLink');
            $gonogo->gonogo_ajvFee = $request->input('ajvFee'); 
            $gonogo->gonogo_feeComments = $request->input('feeComments');
            $gonogo->gonogo_skilled = $request->input('status'); 

            if($gonogo->gonogo_comments === null){
               $gonogo->gonogo_comments = $request->input('comments');  
            }

            $gonogo->added_by = $request->input('addedBy');     
              $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();

              $enquiry->gef_salesApproval = 'In Progress';
              $enquiry->tab = 'enquiryAssess';
              $enquiry->gef_up_lead_status = $request->input('status');

              $enquiry->save();

          if($followup != null){
               if($followup->sales_followup_status != $request->input('status')){     
                  $followup = new followup;
                  $followup->sales_followup_type = 'New';
                  $followup->gef_phone = $gef_phone;                  
                  $followup->sales_followup_notes = $request->input('comments');    
                  $followup->sales_followup_status = $request->input('status');    
                  $followup->added_by = $request->input('addedBy');
                  $followup->tab = 'followup';

                  $followup->save();
            }
          }
      
             
                                                        
            $gonogo->save();
            $english->save();
            $academics->save();
            $work->save();
            $finance->save();
            $outcome->save();

           

            return \Redirect::route('leadView',$gef_phone);  
    }

    public function storeFollowup(Request $request, $gef_phone)
    {

            $gonogo = gonogo::where('gef_phone', '=', $gef_phone)->first();
            $followup = new followup;
            $followup->sales_followup_type = $request->input('followType');
            $followup->gef_phone = $gef_phone;                  
            $followup->sales_followup_notes = $request->input('notes');    
            $followup->sales_followup_status = $request->input('status');    
            $followup->added_by = $request->input('addedBy'); 
            $followup->tab = 'followup';

            
            $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();
            if($enquiry === null){
               $gef = gef_DL::where('gef_phone', '=', $gef_phone)->first();

                 $gefDL = new enquiry;
                 $gefDL->gef_f_name = $gef->gef_f_name;     
                 $gefDL->gef_l_name = $gef->gef_l_name;
                 $gefDL->gef_phone = $gef->gef_phone;
                 $gefDL->gef_email = $gef->gef_email;
                 $gefDL->gef_skype = $gef->gef_skype;
                 $gefDL->gef_nationality = $gef->gef_nationality;
                 $gefDL->gef_location = $gef->gef_location;
                 $gefDL->gef_destination = $gef->gef_destination;
                 $gefDL->gef_source = $gef->gef_source;
                 $gefDL->gef_comments = $gef->gef_comments;
                 $gefDL->gef_subject = $gef->gef_subject;
                 $gefDL->gef_cv = $gef->gef_cv;           
                 $gefDL->assigned_lead = $gef->assigned_lead;
                 $gefDL->gef_assigned_to = $gef->gef_assigned_to;
                 $gefDL->gef_sales_assigned_time =  new DateTime();     
                 $gefDL->gef_salesApproval = 'In Progress';  
                 $gefDL->tab = 'gonogo';
	         $gefDL->gef_up_lead_status = $request->input('status');
                 $gefDL->save();

                 $gefDLD = gef_DL::where('gef_phone', '=', $gef_phone)->delete();
                 $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();

            } else {

                 $enquiry->tab = 'gonogo';
	         $enquiry->gef_up_lead_status = $request->input('status');
                 $followup->gef_assigned_to = $enquiry->gef_assigned_to; 
                 $followup->previous_status = $gonogo->gonogo_skilled; 
                 $enquiry->gef_salesApproval = 'In Progress';  
                 if($request->input('reminder') != null){
                    $enquiry->reminder_date = $request->input('reminder');
                 }
                 $enquiry->save();
            }

                 $employee = employee::where('AJV_EMP_Email', '=', $enquiry->gef_assigned_to)->first();


           if($request->input('status') === 'Drop Pending'){
              $enquiry->gef_salesApproval = $request->input('status');
              $enquiry->gef_prev_status = 'Drop Pending';
              $enquiry->save();

              $gefDEL = gef_DL::where('gef_phone', '=', $gef_phone)->first();
               if($gefDEL === null){

                 $gefDL = new gef_DL;
                 $gefDL->gef_f_name = $enquiry->gef_f_name;     
                 $gefDL->gef_l_name = $enquiry->gef_l_name;
                 $gefDL->gef_phone = $enquiry->gef_phone;
                 $gefDL->gef_email = $enquiry->gef_email;
                 $gefDL->gef_skype = $enquiry->gef_skype;
                 $gefDL->gef_nationality = $enquiry->gef_nationality;
                 $gefDL->gef_location = $enquiry->gef_location;
                 $gefDL->gef_destination = $enquiry->gef_destination;
                 $gefDL->gef_source = $enquiry->gef_source;
                 $gefDL->gef_comments = $enquiry->gef_comments;
                 $gefDL->gef_subject = $enquiry->gef_subject;
                 $gefDL->gef_cv = $enquiry->gef_cv;           
                 $gefDL->gef_salesApproval = $enquiry->gef_salesApproval;
                 $gefDL->gef_up_lead_status = $enquiry->gef_up_lead_status;             
                 $gefDL->assigned_lead = $enquiry->assigned_lead;
                 $gefDL->gef_assigned_to = $enquiry->gef_assigned_to;
                 $gefDL->gef_added_by = $enquiry->gef_added_by;
                 $gefDL->save();
                  $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->delete();

              }


           }  
          
           if($employee->AJV_EMP_Lead != null){
              if($employee->AJV_EMP_Lead === '1'){
                 $followup->sales_emp_lead = 'KORU 1'; 
              } else {
                 $followup->sales_emp_lead = 'KORU 2'; 
              }
           }

              $followup->sales_emp_sName = $employee->AJV_EMP_shortName;              

           if($request->input('callCat') != null){
              $followup->sales_followup_subType = $request->input('callCat');
           } 
          
           if($request->input('dropCat') != null){    
              $followup->drop_category = $request->input('dropCat'); 
           }
             
            $gonogo->gonogo_skilled = $request->input('status');  
           
 
            $gonogo->save();

            $followup->save();
   
       $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();
       if($enquiry != null){
            return \Redirect::route('leadView',$gef_phone);
       }else {
        return \Redirect::route('dashboard');
       }
    }

    public function storeAcademics(Request $request, $gef_phone)
    {

            $academics = academics::where('gef_phone', '=', $gef_phone)->first();    
           if($academics->academics_higestDegree1 != null){        
              $academics->academics_anyGap  = $request->input('gaps');         
              $academics->academics_gap_reason = $request->input('comments');  
              $academics->added_by = $request->input('addedBy');   
              $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();
              $enquiry->tab = 'academics';
              $enquiry->save();
              $academics->save();
           } else {
            \Session::flash('alert', 'Enter highest two qualifications before you save!');
            return \Redirect::route('leadView',$gef_phone);
           }               
             
            return \Redirect::route('leadView',$gef_phone);
    }

    public function storeWork(Request $request, $gef_phone)
    {

            $work = work::where('gef_phone', '=', $gef_phone)->first();            
            $work->work_anyExp = $request->input('anyExp');
            $work->work_totalExp = $request->input('exp');                     
            $work->work_anyGap = $request->input('gaps');            
            $work->work_gap_reason = $request->input('comments'); 
            $work->added_by = $request->input('addedBy'); 
              $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();
              $enquiry->tab = 'work';
              $enquiry->save();  
    

            $work->save();
           

            return \Redirect::route('leadView',$gef_phone);
    }

    public function storeFinance(Request $request, $gef_phone)
    {

            $finance = finance::where('gef_phone', '=', $gef_phone)->first();            
            $finance->sales_fin_maritalStatus = $request->input('martial');         
            $finance->sales_fin_35To45k = $request->input('spend');            
            $finance->sales_fin_fundSource = $request->input('funds'); 
            $finance->sales_fin_comments = $request->input('comments');
            $finance->added_by = $request->input('addedBy'); 
              $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();
              $enquiry->tab = 'finance';
              $enquiry->save();  
    
 
            $finance->save();
           

            return \Redirect::route('leadView',$gef_phone);
    }

    public function storeOutcome(Request $request, $gef_phone)
    {

            $outcome = outcome::where('gef_phone', '=', $gef_phone)->first();            
            $outcome->outcome_ajvFeeApp = $request->input('ajvFeeApp');         
            $outcome->outcome_feeApp = $request->input('feeApp');            
            $outcome->outcome_paidWhen = $request->input('paidWhen'); 
            $outcome->added_by = $request->input('addedBy');     

            $outcome->save();
            $enquiry = gef_service::where('gef_phone', '=', $gef_phone)->first();
            $enquiry->tab = 'finance';                
            $enquiry->save();
           

            return \Redirect::route('serviceView',$gef_phone);
    }

 public function storeComments(Request $request)
    {
            $user = Auth::user();
            $lead    = sales_leads::where('sales_lead_email', '=', $user->email)->first();  
            $enquiry = enquiry::where('gef_phone', '=', $request->input('process_phone'))->first();
            $emp = employee::where('AJV_EMP_Email', '=', $user->email)->first();
            if($user != null){
              $comments = new comments;
              $comments->comment_process_id = $request->input('process_id');     
              $comments->comment_process_name = $request->input('process_name'); 
              $comments->comment_process_phone = $request->input('process_phone');         
              $comments->comment_user = $emp->AJV_EMP_Fname . ' ' . $emp->AJV_EMP_Lname . ', ' . $emp->AJV_EMP_designation;
              $comments->comment_time = new DateTime();
              $comments->comments = $request->input('comment');

              $comments->save();

           if($lead === null){
              if($request->input('drop') != null){
                 $enquiry->gef_salesApproval = $request->input('Drop');
                 $enquiry->save();

                $gefDEL = gef_DL::where('gef_phone', '=', $request->input('process_phone'))->first();
                if($gefDEL === null){

                 $gefDL = new gef_DL;
                 $gefDL->gef_f_name = $enquiry->gef_f_name;     
                 $gefDL->gef_l_name = $enquiry->gef_l_name;
                 $gefDL->gef_phone = $enquiry->gef_phone;
                 $gefDL->gef_email = $enquiry->gef_email;
                 $gefDL->gef_skype = $enquiry->gef_skype;
                 $gefDL->gef_nationality = $enquiry->gef_nationality;
                 $gefDL->gef_location = $enquiry->gef_location;
                 $gefDL->gef_destination = $enquiry->gef_destination;
                 $gefDL->gef_source = $enquiry->gef_source;
                 $gefDL->gef_comments = $enquiry->gef_comments;
                 $gefDL->gef_subject = $enquiry->gef_subject;
                 $gefDL->gef_cv = $enquiry->gef_cv;           
                 $gefDL->gef_salesApproval = $enquiry->gef_salesApproval;
                 $gefDL->gef_up_lead_status = $enquiry->gef_up_lead_status;             
                 $gefDL->assigned_lead = $enquiry->assigned_lead;
                 $gefDL->gef_assigned_to = $enquiry->gef_assigned_to;
                 $gefDL->gef_added_by = $enquiry->gef_added_by;
                 $gefDL->save();
                  $enquiry = enquiry::where('gef_phone', '=', $request->input('process_phone'))->delete();
              }
           } else {
              if($request->input('drop') != null){
                 $enquiry->gef_salesApproval = 'Dropped';
                 $enquiry->save();

                $gefDEL = gef_DL::where('gef_phone', '=', $request->input('process_phone'))->first();
                if($gefDEL === null){

                 $gefDL = new gef_DL;
                 $gefDL->gef_f_name = $enquiry->gef_f_name;     
                 $gefDL->gef_l_name = $enquiry->gef_l_name;
                 $gefDL->gef_phone = $enquiry->gef_phone;
                 $gefDL->gef_email = $enquiry->gef_email;
                 $gefDL->gef_skype = $enquiry->gef_skype;
                 $gefDL->gef_nationality = $enquiry->gef_nationality;
                 $gefDL->gef_location = $enquiry->gef_location;
                 $gefDL->gef_destination = $enquiry->gef_destination;
                 $gefDL->gef_source = $enquiry->gef_source;
                 $gefDL->gef_comments = $enquiry->gef_comments;
                 $gefDL->gef_subject = $enquiry->gef_subject;
                 $gefDL->gef_cv = $enquiry->gef_cv;           
                 $gefDL->gef_salesApproval = $enquiry->gef_salesApproval;
                 $gefDL->gef_up_lead_status = $enquiry->gef_up_lead_status;             
                 $gefDL->assigned_lead = $enquiry->assigned_lead;
                 $gefDL->gef_assigned_to = $enquiry->gef_assigned_to;
                 $gefDL->gef_added_by = $enquiry->gef_added_by;
                 $gefDL->save();
                  $enquiry = enquiry::where('gef_phone', '=', $request->input('process_phone'))->delete();

                }
              }
           }  
         }

          
          }  
          
      if($emp->AJV_DEP_ID === '1'){          
         $enquiry = enquiry::where('gef_phone', '=', $request->input('process_phone'))->first();
         if($enquiry != null){
            return redirect()->back();
         }else {
          return \Redirect::route('dashboard');
         }
      } else {
         $enquiry = gef_service::where('gef_phone', '=', $request->input('process_phone'))->first();
         if($enquiry != null){
         return redirect()->back();
         }else {
          return \Redirect::route('servicedashboard');
         }          
      }     

   } 

    public function leadDetails($gef_phone)
{

    $gef = enquiry::where('gef_phone', '=', $gef_phone)->first();

    return view('leadDetails',compact('gef'));
}

    public function pdfview(Request $request)
    {
        $gef = enquiry::where('gef_phone', '=', $request->input('phone'))->first();
        $outcome = outcome::where('gef_phone', '=', $request->input('phone'))->first();
        view()->share('outcome',$outcome);

        if($request->has('download')){
            $pdf = PDF::loadView('pdfview');
            return $pdf->download($gef->gef_f_name . ' ' . $gef->gef_l_name. ' Cover Note.pdf');
        }


        return view('pdfview');
    }

    public function dailyReport(Request $request)
    {

    $user = Auth::user();
    $emp = employee::where('AJV_EMP_Email', '=', $user->email)->first();
    if($request->startDate != null){
       $from = $request->startDate.' '.'00:00:00';
       $to = $request->endDate.' '.'24:00:00';
    } else {
       $from = null;
       $to = null;
    }

     $koru1 = employee::where('AJV_EMP_Lead', '=', '1')->get();

     $k1totalS = 0;
     $k1totalN = 0;
     $k1totalO = 0;
     $k1totalC = 0;
     $k1totalD = 0;

    foreach ($koru1 as $k1){

     $followS = 0;
     $followNS = 0;
     $others = 0;
     $AJM = 0;

    if($from != null){

     $followS = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Spoken')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

     $followNS = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Not Spoken')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

     $others = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

     $AJMs = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Spoken')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

     $AJMns = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Not Spoken')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

     $AJMo = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

     $AJM = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

} else {

     $followS = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Spoken')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

     $followNS = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Not Spoken')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

     $others = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

     $AJMs = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Spoken')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

     $AJMns = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Not Spoken')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

     $AJMo = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

     $AJM = followup::where('gef_assigned_to','=',$k1->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

}

     $k1->dailyCountS = $followS->count() + $AJMs->count();
     $k1->dailyCountNS = $followNS->count() + $AJMns->count();
     $k1->dailyOthers = $others->count() + $AJMo->count();
     $k1->daily_count = $k1->dailyCountS + $k1->dailyCountNS + $k1->dailyOthers;
     $k1->dailyDropped = $AJM->count();

     $k1totalS = $k1totalS + $k1->dailyCountS;
     $k1totalN = $k1totalN + $k1->dailyCountNS;
     $k1totalO = $k1totalO + $k1->dailyOthers;
     $k1totalC = $k1totalC + $k1->daily_count;
     $k1totalD = $k1totalD + $k1->dailyDropped;

     $k1->save();
    }

     $koru2 = employee::where('AJV_EMP_Lead', '=', '2')->get();
     $k2totalS = 0;
     $k2totalN = 0;
     $k2totalO = 0;
     $k2totalC = 0;
     $k2totalD = 0;

    foreach ($koru2 as $k2){

     $followS = 0;
     $followNS = 0;
     $others = 0;
     $AJM = 0;

    if($from != null){

     $followS = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Spoken')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

     $followNS = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Not Spoken')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

     $others = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

     $AJMs = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Spoken')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

     $AJMns = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Not Spoken')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

     $AJMo = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

     $AJM = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

} else {

     $followS = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Spoken')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

     $followNS = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Not Spoken')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

     $others = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

     $AJMs = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Spoken')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

     $AJMns = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Not Spoken')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

     $AJMo = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

     $AJM = followup::where('gef_assigned_to','=',$k2->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

}

     $k2->dailyCountS = $followS->count() + $AJMs->count();
     $k2->dailyCountNS = $followNS->count() + $AJMns->count();
     $k2->dailyOthers = $others->count() + $AJMo->count();
     $k2->daily_count = $k2->dailyCountS + $k2->dailyCountNS + $k2->dailyOthers;
     $k2->dailyDropped = $AJM->count();

     $k2totalS = $k2totalS + $k2->dailyCountS;
     $k2totalN = $k2totalN + $k2->dailyCountNS;
     $k2totalO = $k2totalO + $k2->dailyOthers;
     $k2totalC = $k2totalC + $k2->daily_count;
     $k2totalD = $k2totalD + $k2->dailyDropped;

     $k2->save();
    }

     $coru1 = employee::where('AJV_EMP_Lead', '=', '1')->get();
     $coru2 = employee::where('AJV_EMP_Lead', '=', '2')->get();

    return view('dailyReport', compact('coru1','coru2','from','to','emp','k1totalS','k2totalS','k1totalN','k2totalN','k1totalO','k2totalO','k1totalC','k2totalC','k1totalD','k2totalD'));

    }

    public function monthlyReport(Request $request)
    {
   	$users = followup::whereMonth('created_at', '=', date('m'))->get();
        $dis = $users->unique('gef_phone');
        $dis->values()->all();
        $cMonth = \Carbon\Carbon::now();
        $MS = $cMonth->format('F');
        $chart = Charts::database($dis, 'bar', 'highcharts')
			      ->title($MS .' '. " Statistics")
			      ->elementLabel($MS)
			      ->dimensions(1000, 500)
			      ->responsive(false)
			      ->groupBy('sales_emp_sName');

    	$koru1 = followup::where('sales_emp_lead', '=', 'KORU 1')->whereMonth('created_at', '=', date('m'))->get();
        $koru1Dis = $koru1->unique('gef_phone');
        $koru1Dis->values()->all();
        $koru1Chart = Charts::database($koru1Dis, 'pie', 'highcharts')
			      ->title("KORU 1 " .$MS. " Statistics")
			      ->elementLabel("Koru 1 Statistics")
			      ->dimensions(600, 300)
			      ->responsive(false)
			      ->groupBy('sales_emp_sName');

    	$koru2 = followup::where('sales_emp_lead', '=', 'KORU 2')->whereMonth('created_at', '=', date('m'))->get();
        $koru2Dis = $koru2->unique('gef_phone');
        $koru2Dis->values()->all();
        $koru2Chart = Charts::database($koru2Dis, 'pie', 'highcharts')
			      ->title("KORU 2 " .$MS. " Statistics")
			      ->elementLabel("Koru 2 Statistics")
			      ->dimensions(600, 300)
			      ->responsive(false)
			      ->groupBy('sales_emp_sName');

    	$koru = followup::where('sales_emp_lead', '!=', null)-> whereMonth('created_at', '=', date('m'))->get();
        $koruDis = $koru->unique('gef_phone');
        $koruDis->values()->all();
        $koruChart = Charts::database($koruDis, 'pie', 'highcharts')
			      ->title("Competitive " .$MS. " Statistics")
			      ->elementLabel("KORU Statistics")
			      ->dimensions(1000, 500)
			      ->responsive(false)
			      ->groupBy('sales_emp_lead');



    return view('monthlyReport', compact('chart','koru1Chart','koru2Chart','koruChart','cMonth'));

    }
    
    public function dailySTA(Request $request)
    {

    $user = Auth::user();
    $emp = employee::where('AJV_EMP_Email', '=', $user->email)->first();

     $koru1 = employee::where('AJV_EMP_Lead', '=', '1')->get();


     $k1totalNL = 0;
     $k1totalJFM = 0;
     $k1totalAMJ = 0;
     $k1totalJAS = 0;
     $k1totalOND = 0;
     $k1totalHOT = 0;
     $k1totalBYD = 0;
     $k1totalDP = 0;


    foreach ($koru1 as $k1){
     $k1NL = enquiry::where('gef_assigned_to', '=', $k1->AJV_EMP_Email)->where('gef_salesApproval', '=', 'New Leads')->get();
     $k1->currentNL = $k1NL->count();
     $k1STA = enquiry::where('gef_assigned_to', '=', $k1->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'STA-JFM19')->get();
     $k1->currentSTA = $k1STA->count();
     $k1AMJ = enquiry::where('gef_assigned_to', '=', $k1->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'STA-AMJ19')->get();
     $k1->currentSTAAMJ = $k1AMJ->count();
     $k1JAS = enquiry::where('gef_assigned_to', '=', $k1->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'STA-JAS19')->get();
     $k1->currentSTAJAS = $k1JAS->count();
     $k1OND = enquiry::where('gef_assigned_to', '=', $k1->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'STA-OND19')->get();
     $k1->currentSTAOND = $k1OND->count();
     $k1HOT = enquiry::where('gef_assigned_to', '=', $k1->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'Hot')->get();
     $k1->currentHOT = $k1HOT->count();
     $k1BYD = enquiry::where('gef_assigned_to', '=', $k1->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'BEYOND')->get();
     $k1->currentSTABYD = $k1BYD->count();
     $k1DP = enquiry::where('gef_assigned_to', '=', $k1->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'Docs Pending')->get();
     $k1->currentDP = $k1DP->count();     

     $k1totalNL = $k1totalNL + $k1NL->count();
     $k1totalJFM = $k1totalJFM + $k1STA->count();
     $k1totalAMJ = $k1totalAMJ + $k1AMJ->count();
     $k1totalJAS = $k1totalJAS + $k1JAS->count();
     $k1totalOND = $k1totalOND + $k1OND->count();
     $k1totalHOT = $k1totalHOT + $k1HOT->count();
     $k1totalBYD = $k1totalBYD + $k1BYD->count();
     $k1totalDP = $k1totalDP + $k1DP->count();

     $k1->save();
    }

     $koru2 = employee::where('AJV_EMP_Lead', '=', '2')->get();

     $k2totalNL = 0;
     $k2totalJFM = 0;
     $k2totalAMJ = 0;
     $k2totalJAS = 0;
     $k2totalOND = 0;
     $k2totalHOT = 0;
     $k2totalBYD = 0;
     $k2totalDP = 0;

    foreach ($koru2 as $k2){
     $k2NL = enquiry::where('gef_assigned_to', '=', $k2->AJV_EMP_Email)->where('gef_salesApproval', '=', 'New Leads')->get();
     $k2->currentNL = $k2NL->count();
     $k2STA = enquiry::where('gef_assigned_to', '=', $k2->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'STA-JFM19')->get();
     $k2->currentSTA = $k2STA->count();
     $k2AMJ = enquiry::where('gef_assigned_to', '=', $k2->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'STA-AMJ19')->get();
     $k2->currentSTAAMJ = $k2AMJ->count();
     $k2JAS = enquiry::where('gef_assigned_to', '=', $k2->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'STA-JAS19')->get();
     $k2->currentSTAJAS = $k2JAS->count();
     $k2OND = enquiry::where('gef_assigned_to', '=', $k2->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'STA-OND19')->get();
     $k2->currentSTAOND = $k2OND->count();
     $k2HOT = enquiry::where('gef_assigned_to', '=', $k2->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'Hot')->get();
     $k2->currentHOT = $k2HOT->count();
     $k2BYD = enquiry::where('gef_assigned_to', '=', $k2->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'BEYOND')->get();
     $k2->currentSTABYD = $k2BYD->count();
     $k2DP = enquiry::where('gef_assigned_to', '=', $k2->AJV_EMP_Email)->where('gef_up_lead_status', '=', 'Docs Pending')->get();
     $k2->currentDP = $k2DP->count(); 

     $k2totalNL = $k2totalNL + $k2NL->count();
     $k2totalJFM = $k2totalJFM + $k2STA->count();
     $k2totalAMJ = $k2totalAMJ + $k2AMJ->count();
     $k2totalJAS = $k2totalJAS + $k2JAS->count();
     $k2totalOND = $k2totalOND + $k2OND->count();
     $k2totalHOT = $k2totalHOT + $k2HOT->count();    
     $k2totalBYD = $k2totalBYD + $k2BYD->count();
     $k2totalDP = $k2totalDP + $k2DP->count();


     $k2->save();
    }

     $coru1 = employee::where('AJV_EMP_Lead', '=', '1')->get();
     $coru2 = employee::where('AJV_EMP_Lead', '=', '2')->get();
     
     $k1apps = employee::where('AJV_EMP_Lead', '=', '1')->sum('appsCount');
     $k2apps = employee::where('AJV_EMP_Lead', '=', '2')->sum('appsCount');

    return view('dailySTA', compact('coru1','coru2','k1apps','k2apps','emp','k2totalNL','k2totalJFM','k2totalAMJ','k2totalJAS','k2totalOND','k2totalHOT','k1totalNL','k1totalJFM','k1totalAMJ','k1totalJAS','k1totalOND','k1totalHOT','k1totalDP','k2totalDP','k1totalBYD','k2totalBYD'));

    }

    public function storeEmpDetails(Request $request, $AJV_EMP_Email)
    {

            $emp= employee::where('AJV_EMP_Email', '=', $AJV_EMP_Email)->first();    
              $emp->AJV_EMP_Mname = $request->input('MN');         
              $emp->AJV_EMP_Lname = $request->input('LN');   
              $emp->AJV_EMP_shortName = $request->input('SN');               
              $emp->AJV_EMP_DOB = $request->input('dob');         
              $emp->AJV_EMP_JoinDate = $request->input('joinDate');         
              $emp->AJV_EMP_MobileNum = $request->input('mobile');         
              $emp->AJV_EMP_SpouseMobile = $request->input('spouse');         
              $emp->AJV_EMP_Address = $request->input('address');         
              $emp->AJV_EMP_LocationOfWork = $request->input('wcountry');         
              $emp->AJV_EMP_Aadhar = $request->input('aadhar');         
              $emp->AJV_EMP_PanNo = $request->input('pan');         
              $emp->AJV_EMP_BankAccountNo = $request->input('account');         
              $emp->AJV_EMP_BankName = $request->input('bname');         
              $emp->AJV_EMP_BankAddress = $request->input('baddress');         
              $emp->AJV_EMP_IFSCCode = $request->input('ifsc');         

              $emp->save();
            
             
            return \Redirect::route('empDetails',$emp);
    }


}