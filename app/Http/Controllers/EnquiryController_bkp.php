<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use App\enquiryOnshore;
use App\enquiry;
use App\gef_NL;
use App\gef_IP;
use App\gef_DL;
use App\gef_service;
use App\gonogo;
use App\pathway;
use App\english;
use App\followup;
use App\service_followup;
use App\academics;
use App\work;
use App\finance;
use App\outcome;
use App\admission;
use App\source;
use App\nationality;
use App\country;
use App\destination;
use App\funds;
use App\pcc;
use App\med;
use App\visa;
use App\onshore;
use App\employee;
use App\sales_leads;
use App\service_leads;
use App\comments;
use App\gef_duplicates;
use App\Notifications\approvals;
use DateTime;
use Excel;
use File;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    public function create()
    {
    
    return view('enquiry');
    }

    public function onshore()
    {
    
    return view('enquiryOnshore');
    }

    public function store(Request $request)
    {

     $validator = Validator::make(Input::all(),  enquiry::Rules(), enquiry::$messages);
     if ($validator->fails())
     {
        return \Redirect::back()->withErrors($validator)->withInput();
     }
     else
     {
            $enq = new enquiry;
            $enq->gef_f_name = $request->input('firstname');     
            $enq->gef_l_name = $request->input('lastname');
            $enq->gef_phone = $request->input('gef_phone');
            $enq->gef_email = $request->input('gef_email');
            $enq->gef_skype = $request->input('skype');
            $nat = nationality::where('nationality_id','=',$request->input('nationality'))->first(); 
            $enq->gef_nationality = $nat->nationality;
            $cou = country::where('country_id','=',$request->input('location'))->first(); 
            $enq->gef_location = $cou->country;
            $des = destination::where('AJV_destination_id','=',$request->input('destination'))->first(); 
            $enq->gef_destination = $des->AJV_destination;
            $sou = source::where('source_id','=',$request->input('source'))->first(); 
            $enq->gef_source = $sou->source_name;
            $enq->gef_comments = $request->input('message');
            $enq->gef_subject = $request->input('subject');

            if($request->has('cv')){
            $cvName = $enq->gef_phone . '_' . $enq->gef_l_name . '.' . 
            $request->file('cv')->getClientOriginalExtension();

            $request->file('cv')->move(
            base_path() . '/public/docs/cv/', $cvName
            );

           $enq->gef_cv = $request->input('/public/docs/cv/', $cvName);
           }
            $enq->gef_salesApproval = 'New Leads';
            $enq->gef_up_lead_status = $enq->gef_salesApproval; 
            
            $assign = sales_leads::where('sales_assign_flag', '=', null)->first();
            $assign->sales_assign_flag = 1;
            $enq->assigned_lead = $assign->sales_lead_email;
            $enq->gef_assigned_to = $assign->sales_lead_email;
            $notAssigned = sales_leads::where('sales_assign_flag', '=', 1)->first();
            $notAssigned->sales_assign_flag = null;
            $notAssigned->save();
            $assign->save();

            if($request->input('leader') != 'null'){
               $enq->assigned_lead = $request->input('leader');
            }
            if($request->input('adviser') != 'null'){
               $enq->gef_assigned_to = $request->input('adviser');
               $enq->gef_added_by = $request->input('adviser'); 
            }        


            $enq->save();
 
            //save gef key in other lead related data tables
            $gonogo = new gonogo;   
            $gonogo->gef_phone = $enq->gef_phone;   
            $gonogo->gonogo_skilled = 'New Leads';   
            $gonogo->save();
            $english = new english;   
            $english->gef_phone = $enq->gef_phone;   
            $english->save();
            $academics = new academics;   
            $academics->gef_phone = $enq->gef_phone;   
            $academics->save();
            $work = new work;   
            $work->gef_phone = $enq->gef_phone;   
            $work->save();
            $finance = new finance;   
            $finance->gef_phone = $enq->gef_phone;   
            $finance->save();
            $outcome = new outcome;     
            $outcome->gef_phone = $enq->gef_phone;   
            $outcome->save();
          
            return \Redirect::route('gefAfterSubmit');
      }
   }

  public function updateAssignTo(Request $request, $gef_id)
    {

        $user = Auth::user();   
        $emp = employee::where('AJV_EMP_Email', '=', $user->email)->first();    

      if($emp->AJV_DEP_ID === '1'){
         $gef = enquiry::where('gef_phone', '=', $gef_id)->first();
         if($gef === null){
            $gef = gef_DL::where('gef_phone', '=', $gef_id)->first();
         }
         $lead    = sales_leads::where('sales_lead_email', '=', $user->email)->first();  
       }else{
         $gef = gef_service::where('gef_phone', '=', $gef_id)->first();
         $lead    = service_leads::where('sales_lead_email', '=', $user->email)->first();  
       }



        if($lead != null){
          if($request->input('status') === 'Drop Pending'){ 
             $gef->gef_salesApproval = 'Dropped';
             $gef->gef_up_lead_status = $gef->gef_salesApproval; 
             $gef->gef_prev_status = 'Drop Pending'; 
             $gef->save();

                 $gefDL = new gef_DL;
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
                 $gefDL->gef_salesApproval = $gef->gef_salesApproval;
                 $gefDL->gef_up_lead_status = $gef->gef_up_lead_status;             
                 $gefDL->assigned_lead = $gef->assigned_lead;
                 $gefDL->gef_assigned_to = $gef->gef_assigned_to;
                 $gefDL->gef_added_by = $gef->gef_added_by;
                 $gefDL->save();

                

             $comments = new comments;
             $comments->comment_process_id = $gef->gef_id;     
             $comments->comment_process_name = 'gef'; 
             $comments->comment_process_phone = $gef->gef_phone;
             $comments->comment_user = $emp->AJV_EMP_Fname . ' ' . $emp->AJV_EMP_Lname . ', ' . $emp->AJV_EMP_designation;
             $comments->comment_time = new DateTime();
             $comments->comments = $request->input('comments');
             $comments->save();
              $gefDelete = enquiry::where('gef_phone', '=', $gef_id)->delete();

            return \Redirect::route('dashboard');
          }
        } 
        
       if($gef->gef_assigned_to != null){
            if($request->input('assignTo') === $gef->gef_assigned_to){
               \Session::flash('alert', 'This lead is already assigned to this advisor!');
                return redirect()->back();
            }
                       
              $comments = new comments;
              $comments->comment_process_id = $gef->gef_id;     
              $comments->comment_process_name = 'gef'; 
              $comments->comment_process_phone = $gef->gef_phone;
              $comments->comment_user = $emp->AJV_EMP_Fname . ' ' . $emp->AJV_EMP_Lname . ', ' . $emp->AJV_EMP_designation;
              $comments->comment_time = new DateTime();
            if($request->input('serAssignTo') === null){
              $emp = employee::where('AJV_EMP_Email', '=', $request->input('assignTo'))->first();
            }else{
              $emp = employee::where('AJV_EMP_Email', '=', $request->input('serAssignTo'))->first();
            }
              $comments->comments = 'Re-assigned to ' . $emp->AJV_EMP_Fname . ' ' . $emp->AJV_EMP_Lname;

              $comments->save();
       }         

       if($request->input('comments') != null){
          $gef->gef_process_comments = $request->input('comments');
          $emp1 = employee::where('AJV_EMP_Email', '=', $user->email)->first();      
          $gef->added_by =  $emp1->AJV_EMP_Fname . ' ' . $emp1->AJV_EMP_Lname . ', ' . $emp1->AJV_EMP_designation;  
       }    

       if($request->input('assignTo') != null){

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
                 $gefDL->gef_assigned_to = $request->input('assignTo');
                 $gefDL->gef_sales_assigned_time =  new DateTime();     
                 $gefDL->gef_salesApproval = 'New Leads';  
                 $gefDL->gef_up_lead_status = $gef->gef_salesApproval; 
                 $gefDL->gef_added_by = $gef->gef_added_by;
                 $gefDL->save();

                 $gefDLD = gef_DL::where('gef_phone', '=', $gef_id)->delete();
                 $gef = enquiry::where('gef_phone', '=', $gef_id)->first();

       }

       if($request->input('serAssignTo') != null){
        $gef->gef_service_assigned_to = $request->input('serAssignTo');
        $gef->gef_service_assigned_time =  new DateTime();     
        $gef->gef_serviceApproval = 'New Leads';   
        $gef->save();
       }
       
        return redirect()->back();
    }

    public function gefAfterSubmit()
    {
    
    return view('gefAfterSubmit');
    }

    public function onshoreSubmit()
    {
    
    return view('onshoreSubmit');
    }

    public function leadView(Request $request,$gef_phone)
{

    $gef = enquiry::where('gef_phone', '=', $gef_phone)->first();
    if($gef === null){
       $gef = gef_DL::where('gef_phone', '=', $gef_phone)->first();
    }
    $gonogo = gonogo::where('gef_phone', '=', $gef_phone)->first();
    $followup = followup::where('gef_phone', '=', $gef_phone)->where('tab', '=', 'followup')->get();
    $covernote = followup::where('gef_phone', '=', $gef_phone)->where('tab', '=', 'covernote')->get();

 
    $english = english::where('gef_phone', '=', $gef_phone)->first();
    $academics = academics::where('gef_phone', '=', $gef_phone)->first();
    $work = work::where('gef_phone', '=', $gef_phone)->first();
    $finance = finance::where('gef_phone', '=', $gef_phone)->first();
    $outcome = outcome::where('gef_phone', '=', $gef_phone)->first();
    $visa = visa::where('gef_phone', '=', $gef_phone)->first();
    $admission = admission::where('gef_phone', '=', $gef_phone)->first();

    
    if($request->refresh === '1'){
       $gef->tab = null;
       $gef->save();
    }

        if($request->has('download')){
            $pdf = PDF::loadView('leadView');
            return $pdf->download('leadView.pdf');
        }

    return view('leadView',compact('gef','gonogo','followup','english','academics','work','finance','outcome','visa','covernote','admission'));
}

    public function serviceView(Request $request,$gef_phone)
{

    $gef = gef_service::where('gef_phone', '=', $gef_phone)->first();
    $gonogo = gonogo::where('gef_phone', '=', $gef_phone)->first();
    $followup = service_followup::where('gef_phone', '=', $gef_phone)->where('tab', '=', 'followup')->get();
    $sales_followup = followup::where('gef_phone', '=', $gef_phone)->where('tab', '=', 'followup')->get();
    $covernote = followup::where('gef_phone', '=', $gef_phone)->where('tab', '=', 'covernote')->get();

    $english = english::where('gef_phone', '=', $gef_phone)->first();
    $academics = academics::where('gef_phone', '=', $gef_phone)->first();
    $work = work::where('gef_phone', '=', $gef_phone)->first();
    $finance = finance::where('gef_phone', '=', $gef_phone)->first();
    $outcome = outcome::where('gef_phone', '=', $gef_phone)->first();

    $admission = admission::where('gef_phone', '=', $gef_phone)->first();
    $visa = visa::where('gef_phone', '=', $gef_phone)->first();

    if($request->refresh === '1'){
       $gef->tab = null;
       $gef->save();
    }

    if($gonogo === null){
       $gonogo = new gonogo;   
       $gonogo->gef_phone = $gef->gef_phone; 
       $gonogo->save();
       $english = new english;   
       $english->gef_phone = $gef->gef_phone;   
       $english->save();
       $academics = new academics;   
       $academics->gef_phone = $gef->gef_phone;   
       $academics->save();
       $work = new work;   
       $work->gef_phone = $gef->gef_phone;   
       $work->save();
       $finance = new finance;   
       $finance->gef_phone = $gef->gef_phone;   
       $finance->save();
       $outcome = new outcome;     
       $outcome->gef_phone = $gef->gef_phone;   
       $outcome->save();  
    }

        if($request->has('download')){
            $pdf = PDF::loadView('leadView');
            return $pdf->download('leadView.pdf');
        }

    return view('serviceView',compact('gef','gonogo','followup','english','academics','work','finance','outcome','admission','visa','covernote','sales_followup'));
}

public function forApproval(Request $request, $gef_phone)
    {

        $outcome = outcome::where('gef_phone', '=', $gef_phone)->first();
        $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();

        $outcome->outcome_forApproval = $request->input('forApproval');
        if($request->input('review') != null){
           $enquiry->gef_salesApproval = $request->input('review');
           $enquiry->gef_up_lead_status = $enquiry->gef_salesApproval; 

           $outcome->outcome_status = $request->input('review');

        } 
        if($request->input('approval') != null){
           $enquiry->gef_salesApproval = $request->input('approval');
           $enquiry->gef_up_lead_status = $enquiry->gef_salesApproval; 
           $enquiry->tab = null;

            $assign = service_leads::where('sales_assign_flag', '=', null)->first();
            $assign->sales_assign_flag = 1;
            $enquiry->service_assigned_lead = $assign->sales_lead_email;
            $enquiry->gef_service_assigned_to = $assign->sales_lead_email;
            $notAssigned = service_leads::where('sales_assign_flag', '=', 1)->first();
            $notAssigned->sales_assign_flag = null;
            $notAssigned->save();
            $assign->save();

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
                 $gefS->assigned_lead = $enquiry->assigned_lead;
                 $gefS->gef_assigned_to = $enquiry->gef_assigned_to;
                 $gefS->gef_salesApproval = 'Approval Pending';  
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

    	         $data = array(
    			'firstname' => $enquiry->gef_f_name,
    			'lastname' => $enquiry->gef_l_name,
    			'deal_phone' => $enquiry->gef_phone,
    			'email' => $enquiry->gef_email,
    			'nationality' => $enquiry->gef_nationality,
    			'city' => $enquiry->gef_location,
    			'advisor' => $enquiry->gef_assigned_to,
    			'serviceTL' => $assign->sales_lead_email,

    	       );

    	        Mail::send('dealTemplate', $data, function ($message) use($data) {
    	        	$message->from('dev.ops@ajv.kiwi', 'New Deal!!!');
    	
    	        	$message->to('dev.ops@ajv.kiwi')->subject('New Deal!!!');
    	        });

                 $gefS->save();
            }
        }
        $outcome->save();
        $enquiry->save();

        return \Redirect::route('dashboard');
    }

      public function updateServiceAssignTo(Request $request, $gef_id)
    {

        $gef = enquiry::where('gef_id', '=', $gef_id)->first();

        $gef->gef_service_assigned_to = $request->input('assignTo');
        $gef->save();

        $emp = employee::where('AJV_EMP_Email', '=', $request->input('assignTo'))->first();
        $emp->AJV_EMP_workAssigned = $emp->AJV_EMP_workAssigned + 1;  
        $emp->save();

        return \Redirect::route('servicedashboard');
    }

    public function updateStatus(Request $request,$gef_phone)
    {

        $outcome = outcome::where('gef_phone', '=', $gef_phone)->first();
        $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();
        $user = Auth::user();   
        $lead    = sales_leads::where('sales_lead_email', '=', $user->email)->first();  

        if($lead === null){
          if($request->input('status') === 'Drop Pending'){
           $enquiry->gef_salesApproval = $request->input('status');
           $enquiry->gef_up_lead_status = $enquiry->gef_salesApproval;
           $enquiry->gef_prev_status = 'Drop Pending'; 

           $outcome->outcome_status = $request->input('status');
           $outcome->save(); 

           $enquiry->save();

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


               $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();
                if($enquiry != null){
                   return redirect()->back();
                }else {
                  return \Redirect::route('dashboard');
                }          
          }
        } else {
          if($request->input('status') === 'Drop Pending'){
           $enquiry->gef_salesApproval = 'Dropped';
           $enquiry->gef_up_lead_status = $enquiry->gef_salesApproval; 
           $enquiry->gef_prev_status = 'Drop Pending'; 

           $outcome->outcome_status = $request->input('status');
           $outcome->save();

           $enquiry->save();

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

           return \Redirect::route('dashboard');
          }

          if($request->input('status') === 'Approved'){
             $outcome->outcome_status = 'Approved';
             $outcome->save();
             $enquiry->gef_salesApproval = 'Approved';
             $enquiry->gef_up_lead_status = $enquiry->gef_salesApproval; 

             $enquiry->save();

          }
        } 


        if($request->input('status') === 'Approval Pending'){
           $outcome->outcome_status = $request->input('status');
           $outcome->save();
        }
        if($request->input('reAssignTo') != null){
           $enquiry->gef_assigned_to = $request->input('reAssignTo');
           $enquiry->gef_sales_assigned_time =  new DateTime();        
           $enquiry->save();
        }
        if($request->input('Drop') != null){
           $enquiry->gef_salesApproval = $request->input('Drop');
             $enquiry->gef_up_lead_status = $enquiry->gef_salesApproval; 

           $enquiry->save();

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

              return \Redirect::route('dashboard');
        }
 
        return \Redirect::route('dashboard');
    }

  public function forAppApproval(Request $request, $gef_phone)
    {

        $visa = visa::where('gef_phone', '=', $gef_phone)->first();
        $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();

        $visa->visa_forAppApproval = $request->input('forAppApproval');
        if($request->input('review') != null){
           $enquiry->gef_serviceApproval = $request->input('review');
           $visa->visa_status = $request->input('review');

        } else {
           $visa->visa_status = $request->input('approval');
           $enquiry->gef_serviceApproval = $request->input('approval');
           $emp = employee::where('AJV_EMP_Email', '=', $enquiry->gef_assigned_to)->first();
           $emp->AJV_EMP_workCompleted = $emp->AJV_EMP_workCompleted + 1;  
           $emp->save();
        }
        $visa->save();
        $enquiry->save();

        return \Redirect::route('servicedashboard');
    }

    public function updateAppStatus(Request $request,$gef_phone)
    {

        $visa = visa::where('gef_phone', '=', $gef_phone)->first();
        $enquiry = enquiry::where('gef_phone', '=', $gef_phone)->first();

        $visa->visa_status = $request->input('status');
        $visa->save();
        $enquiry->gef_serviceApproval = $request->input('status');
        $enquiry->save();

        return \Redirect::route('servicedashboard');
    }

    public function dashTab(Request $request)
    {
        $user = Auth::user();   
        $lead= employee::where('AJV_EMP_Email', '=', $user->email)->first();

        $lead->dash_tab = $request->value;
        $lead->save();

        return back();
    }

    public function searchLead(Request $request)
    {
        $user = Auth::user();   
        $emp= employee::where('AJV_EMP_Email', '=', $user->email)->first();

      if($emp->AJV_DEP_ID === '1' || '9'){
        $search = enquiry::where('gef_f_name', 'LIKE', '%'.$request->input('search').'%')->get();
        $phone = enquiry::where('gef_phone', 'LIKE', '%'.$request->input('search').'%')->get();
        $email = enquiry::where('gef_email', '=', $request->input('search'))->get();
        $searchDL = gef_DL::where('gef_f_name', 'LIKE', '%'.$request->input('search').'%')->get();
        $phoneDL = gef_DL::where('gef_phone', 'LIKE', '%'.$request->input('search').'%')->get();
        $emailDL = gef_DL::where('gef_email', '=', $request->input('search'))->get();
      }else{
        $search = gef_service::where('gef_f_name', 'LIKE', '%'.$request->input('search').'%')->get();
        $phone = gef_service::where('gef_phone', 'LIKE', '%'.$request->input('search').'%')->get();
        $email = gef_service::where('gef_email', '=', $request->input('search'))->get();
        $searchDL = gef_DL::where('gef_f_name', 'LIKE', '%'.$request->input('search').'%')->get();
        $phoneDL = gef_DL::where('gef_phone', 'LIKE', '%'.$request->input('search').'%')->get();
        $emailDL = gef_DL::where('gef_email', '=', $request->input('search'))->get();
      }


        return view('leadSearch', compact('search','phone','email','searchDL','phoneDL','emailDL'));

    }


	public function uploadLead()
	{

		return view('uploadLead');
	}

	public function import(Request $request){
    	//validate the xls file
		$this->validate($request, array(
			'file'      => 'required'
		));

		if($request->hasFile('file')){
                        $user = Auth::user();   
                        $uploadCount = 0; 
                        $dupCount = 0;
			$deleteDupData = DB::table('gef_duplicates')->delete();
			$extension = File::extension($request->file->getClientOriginalName());
			if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

				$path = $request->file->getRealPath();
				$data = Excel::load($path, function($reader) { 
				})->get();
				if(!empty($data) || $data->count()){

					foreach ($data as $key => $value) { 

                                         if($value->phone != null){  
					    $gef = enquiry::where('gef_phone','=',$value->phone)->first();
					    $gefDL = gef_DL::where('gef_phone','=',$value->phone)->first();


                                           if($value->email != null){
                                              $gefEmail = enquiry::where('gef_email','=',$value->email)->first();
                                              $gefDLEmail = gef_DL::where('gef_email','=',$value->email)->first();
                                           }
                                           if($gefDL != null || $gefDLEmail != null || $gef != null || $gefEmail != null ){ 
                                              $dupCount++;
                                           } else {
						$insert[] = [
						'gef_f_name' => $value->name,
						'gef_phone' => $value->phone,
						'gef_email' => $value->email,
						'gef_skype' => $value->skype,
						'gef_nationality' => $value->nationality,
						'gef_location' => $value->location,
						'gef_subject' => $value->subject,
						'gef_destination' => $value->destination,
						'gef_source' => $value->source,
						'gef_comments' => $value->comments,
						'gef_adviser_comments' => $value->adviser_comments,
						'gef_up_lead_status' => $value->status,
                                                'gef_salesApproval' => 'New Leads', 
                                                'gef_assigned_to' => $value->adviser,
                                                'assigned_lead' => $value->team_leader,
                                                'gef_added_by' => $user->email,
						];
						$gef = null;
                                                $gefEmail = null; 
                                                $inprogress = null;
						$insertData = DB::table('gef')->insert($insert);
                                                $insert = []; 
                                                $newgonogo = gonogo::where('gef_phone','=',$value->phone)->first();
                                                $uploadCount++;
                                                    if($newgonogo === null){
                                                        $gonogo = new gonogo;   
            						$gonogo->gef_phone = $value->phone; 
                                                        $gonogo->gonogo_skilled = $value->status;     
            						$gonogo->save();
            						$english = new english;   
            						$english->gef_phone = $value->phone;   
            						$english->save();
            						$academics = new academics;   
            						$academics->gef_phone = $value->phone;   
            						$academics->save();
            						$work = new work;   
            						$work->gef_phone = $value->phone;   
            						$work->save();
            						$finance = new finance;   
            						$finance->gef_phone = $value->phone;   
            						$finance->save();
            						$outcome = new outcome;     
            						$outcome->gef_phone = $value->phone;   
            						$outcome->save();  
                                                    }                                              
				            } 
                                        }
                                      }
                                  }

                                $Tcount = $data->count();
				Session::flash('success', 'Your Data has successfully uploaded (Total - '.$Tcount.' || Leads Uploaded Count - '.$uploadCount.' || Duplicate Count - '.$dupCount.')');
				return back();
			}else {
				Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
				return back();
			}
		}
	}


    public function delDuplicates()
    {
	$deleteDupData = DB::table('gef_duplicates')->delete();
	Session::flash('error1', 'Duplicate Leads Deleted..');

        return back();
    }

	public function export()
	{
                    $MemployeeList = employee::where('AJV_DEP_ID', '=', '1')->pluck('AJV_EMP_Fname', 'AJV_EMP_Email');

		return view('export',compact('MemployeeList'));
	}

	public function exportLead(Request $request)
	{
           //     $request->startDate = date('Y-m-d' . ' 00:00:00', time()); //need a space after dates.
           //     $request->endDate = date('Y-m-d' . ' 24:60:60', time());

                $from = $request->startDate.' '.'00:00:00';
                $to = $request->endDate.' '.'24:60:60';

                if($request->adviser != null){
                   if($request->status != null){
		      $data = enquiry::where('gef_assigned_to', '=', $request->adviser)->where('gef_salesApproval', '=', $request->status)->where('created_at','>=', $from)->where('created_at', '<=', $to)->get()->toArray();
                   } else {
		      $data = enquiry::where('gef_assigned_to', '=', $request->adviser)->where('created_at','>=', $from)->where('created_at', '<=', $to)->get()->toArray();
                   } 
                } else {
                   if($request->status != null){
 		      $data = enquiry::where('gef_salesApproval', '=', $request->status)->where('created_at','>=', $from)->where('created_at', '<=', $to)->get()->toArray();
                   } else {
 		      $data = enquiry::where('created_at','>=', $from)->where('created_at', '<=', $to)->get()->toArray();
                   }
                }                         
            //    $data->toArray();
		return Excel::create($request->startDate.' to '.$request->endDate, function($excel) use ($data) {
			$excel->sheet('LeadsExported', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download('xlsx');
	}


 public function storeOnshore(Request $request)
    {

     $validator = Validator::make(Input::all(),  enquiryOnshore::Rules(), enquiryOnshore::$messages);
     if ($validator->fails())
     {
        return \Redirect::back()->withErrors($validator)->withInput();
     }
     else
     {
            $onshore = enquiryOnshore::where('onshore_phone', '=', $request->input('phone'))->first();
            if($request->input('onshore_email') != null){
               $email = enquiryOnshore::where('onshore_email', '=', $request->input('email'))->first();  
            } else {
               $email = null;
            }
            if(is_null($onshore) and is_null($email)){ 
            $enq = new enquiryOnshore;
            $enq->onshore_FN = $request->input('firstname');     
            $enq->onshore_LN = $request->input('lastname');
            $enq->onshore_phone = $request->input('onshore_phone');
            $enq->onshore_email = $request->input('email');
            $nat = nationality::where('nationality_id','=',$request->input('nationality'))->first(); 
            $enq->nationality = $nat->nationality;
            $cou = country::where('country_id','=',$request->input('location'))->first(); 
            $enq->onshore_city = $request->input('city');
            $sou = source::where('source_id','=',$request->input('source'))->first(); 
            $enq->onshore_source = $sou->source_name;
            $enq->onshore_comments = $request->input('message');
            $enq->onshore_course = $request->input('course');
            $enq->onshore_college = $request->input('college');
            $enq->onshore_expDate = $request->input('expDate');

    	$data = array(
    			'firstname' => $request->input('firstname'),
    			'lastname' => $request->input('lastname'),
    			'onshore_phone' => $request->input('onshore_phone'),
    			'email' => $request->input('email'),
    			'nationality' => $nat->nationality,
    			'city' => $request->input('city'),
    			'course' => $request->input('course'),
    			'college' => $request->input('college'),
    			'source' => $sou->source_name,
    			'expDate' => $request->input('expDate'),
    			'comments' => $request->input('message'),

    	);

    	Mail::send('mailtemplate', $data, function ($message) use($data) {
    		$message->from('dev.ops@ajv.kiwi', 'New Onshore Enquiry!!!');
    	
    		$message->to('dev.ops@ajv.kiwi')->subject('Onshore Enquiry');
    	});
            $enq->save();


            return \Redirect::route('onshoreSubmit');
           } else {
            \Session::flash('alert', 'There is already an enquiry with your mobile number or email address!');
            return redirect()->back();
           }    
      }
   }

	public function empDetails()
	{
               $user = Auth::user();   
               $emp= employee::where('AJV_EMP_Email', '=', $user->email)->first();

		return view('empDetails', compact('emp'));
	}

}


