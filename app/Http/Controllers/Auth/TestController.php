<?php
 
namespace App\Http\Controllers\Auth;
 
use Cache; 
use App\LoginUser;
use App\enquiry;
use App\gonogo;
use App\employee;
use App\followup;
use App\subject;
use App\ajv_department;
use App\sales_leads;
use Illuminate\Http\Request;
use App\Exceptions\SocialAuthException;
use Illuminate\Support\Facades\Auth;
use Charts;

 
class TestController extends Controller
{
    protected $loginUser;


    public function TLdashboard(Request $request)
    {
    $user = Auth::user();
    $gefData3 = employee::where('AJV_DEP_ID', '=', '1')->orderBy('AJV_EMP_workCompleted','DESC')->get();

    if($user != null){    
       $emp = employee::where('AJV_EMP_Email', '=', $user->email)->first();
      if($request->adviser != null){  
        $emp->dash_filter = $request->adviser;
        $emp->dash_tab = $request->tab;
      }  
      if($request->filter != null){  
        $emp->dash_filter_status = $request->filter;
        $emp->dash_tab = $request->tab;
      } 

        $emp->save();
    if($user != null){
     $dep = sales_leads::where('sales_lead_email','=',$user->email)->first();
     if($dep != null){
          $gefData = enquiry::where('gef_salesApproval','=','New Leads')->where('assigned_lead','=',$dep->sales_lead_email)->where('gef_assigned_to','=',$emp->dash_filter)->orderBy('created_at', 'DESC')->paginate(80);
          $NLCount = enquiry::where('gef_salesApproval','=','New Leads')->where('assigned_lead','=',$dep->sales_lead_email)->where('gef_assigned_to','=',$emp->dash_filter)->get();
  
          $accepted = enquiry::where('gef_salesApproval', '=', 'Approved')->where('gef_assigned_to','=',$emp->dash_filter)->where('assigned_lead','=',$dep->sales_lead_email)->orderBy('updated_at', 'DESC')->paginate(40);           
          $aCount   = enquiry::where('gef_salesApproval','=','Approved')->where('gef_assigned_to','=',$emp->dash_filter)->where('assigned_lead','=',$dep->sales_lead_email)->get(); 
          $dropped = enquiry::where('gef_salesApproval', '=', 'Drop Pending')->where('gef_assigned_to','=',$emp->dash_filter)->where('assigned_lead','=',$dep->sales_lead_email)->orderBy('updated_at', 'DESC')->paginate(300);
          $dCount = enquiry::where('gef_salesApproval', '=', 'Drop Pending')->where('gef_assigned_to','=',$emp->dash_filter)->where('assigned_lead','=',$dep->sales_lead_email)->get();

          $NLCount1 = enquiry::where('gef_salesApproval','=','New Leads')->where('assigned_lead','=',$dep->sales_lead_email)->get();         
          $aCount1  = enquiry::where('gef_salesApproval','=','Approved')->where('assigned_lead','=',$dep->sales_lead_email)->get();    
          $dCount1 = enquiry::where('gef_salesApproval', '=', 'Drop Pending')->where('assigned_lead','=',$dep->sales_lead_email)->get(); 
          $IPCount1 = enquiry::whereNotNull('gef_assigned_To')->where('assigned_lead','=',$dep->sales_lead_email)->where('gef_salesApproval','=','In Progress')->get();   

           $gefData2 = enquiry::whereNotNull('gef_assigned_To')->where('gef_up_lead_status','=',$emp->dash_filter_status)->where('gef_assigned_to','=',$emp->dash_filter)->where('assigned_lead','=',$dep->sales_lead_email)->orderBy('updated_at', 'DESC')->paginate(40);
           $IPCount = enquiry::whereNotNull('gef_assigned_To')->where('gef_up_lead_status','=',$emp->dash_filter_status)->where('gef_assigned_to','=',$emp->dash_filter)->where('assigned_lead','=',$dep->sales_lead_email)->get();

     } else {

       $user = Auth::user();

       $emp = employee::where('AJV_EMP_Email', '=', $user->email)->first();

          $gefData2 = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->orderBy('updated_at', 'DESC')->paginate(40);

          $IPCount = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->get(); 
  
       if($emp->dash_filter_status != 'All'){

         $gefData2 = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->where('gef_up_lead_status','=',$emp->dash_filter_status)->orderBy('updated_at', 'DESC')->paginate(40);

       $IPCount = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->where('gef_up_lead_status','=',$emp->dash_filter_status)->get(); 
       
       } else {

          $gefData2 = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->orderBy('updated_at', 'DESC')->paginate(40);

          $IPCount = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->get(); 

       }

       $IPCount1 = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->get();        

        $gefData = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','New Leads')->orderBy('created_at', 'DESC')->paginate(300);

        $NLCount = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','New Leads')->get();    
      
        $accepted = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval', '=', 'Approved')->orderBy('updated_at', 'DESC')->paginate(40); 

        $aCount = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval', '=', 'Approved')->get();

        $dropped = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval', '=', 'Drop Pending')->orderBy('updated_at', 'DESC')->paginate(300);

        $dCount= enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval', '=', 'Drop Pending')->get();

          $NLCount1 = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','New Leads')->get();          
          $aCount1  = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval', '=', 'Approved')->get();   
          $dCount1 = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval', '=', 'Drop Pending')->get();

     }

       if($emp->AJV_DEP_ID === '1' and $emp->AJV_EMP_Lead === null){
          
             
          $gefData = enquiry::where('gef_salesApproval','=','New Leads')->where('gef_assigned_to','=',$emp->dash_filter)->orderBy('created_at', 'DESC')->paginate(80);
          $NLCount = enquiry::where('gef_salesApproval','=','New Leads')->where('gef_assigned_to','=',$emp->dash_filter)->get(); 
          $accepted = enquiry::where('gef_salesApproval', '=', 'Approved')->where('gef_assigned_to','=',$emp->dash_filter)->orderBy('updated_at', 'DESC')->paginate(40);           
          $aCount   = enquiry::where('gef_salesApproval','=','Approved')->where('gef_assigned_to','=',$emp->dash_filter)->get(); 
          $dropped = enquiry::where('gef_salesApproval', '=', 'Drop Pending')->where('gef_assigned_to','=',$emp->dash_filter)->orderBy('updated_at', 'DESC')->paginate(300);
          $dCount = enquiry::where('gef_salesApproval', '=', 'Drop Pending')->where('gef_assigned_to','=',$emp->dash_filter)->get();

          $NLCount1 = enquiry::where('gef_salesApproval','=','New Leads')->get();         
          $aCount1  = enquiry::where('gef_salesApproval','=','Approved')->get();    
          $dCount1 = enquiry::where('gef_salesApproval', '=', 'Drop Pending')->orwhere('gef_salesApproval', '=', 'Drop Pending')->get(); 
          $IPCount1 = enquiry::whereNotNull('gef_assigned_To')->where('gef_salesApproval','=','In Progress')->orderBy('updated_at', 'DESC')->get();   

           $gefData2 = enquiry::whereNotNull('gef_assigned_To')->where('gef_up_lead_status','=',$emp->dash_filter_status)->where('gef_assigned_to','=',$emp->dash_filter)->paginate(40);
           $IPCount = enquiry::whereNotNull('gef_assigned_To')->where('gef_up_lead_status','=',$emp->dash_filter_status)->where('gef_assigned_to','=',$emp->dash_filter)->get();

        

       } 



     $newLeadsCount = $NLCount->count();
     $inProgressCount = $IPCount->count(); 
     $acceptedCount = $aCount->count();
     $droppedCount = $dCount->count();

     $NLC = $NLCount1->count();
     $AC = $aCount1->count();
     $DC = $dCount1->count();
     $IP = $IPCount1->count();

    $href = $request->input('href');
    $newApps = 0; 
    $inProgress = 0; 
    $accepted1 = 0; 
    $dropped1 = 0; 

    $newApps = strpos($href,'newApps');
    $inProgress = strpos($href,'inProgress');
    $accepted1 = strpos($href,'accepted');
    $dropped1 = strpos($href,'dropped');

        if ($request->ajax()) {
            if ($newApps > 0) {
             return view('newApps', compact('gefData'));
            } 
            if($inProgress > 0){
             return view('inProgress', compact('gefData2'));
            }    
            if ($accepted1 > 0) {
             return view('accepted', compact('accepted'));
            } 
            if($dropped1 > 0){
             return view('dropped', compact('dropped'));
            }    
        }
    }


                    $dep = sales_leads::where('sales_lead_email','=',$user->email)->first();    
                   if($dep != null){
                      $LemployeeList = employee::where('AJV_DEP_ID', '=', '1')->where('AJV_EMP_Lead', '=', $dep->sales_lead_id)->pluck('AJV_EMP_Fname', 'AJV_EMP_Email');
                   }
                    $MemployeeList = employee::where('AJV_DEP_ID', '=', '1')->pluck('AJV_EMP_Fname', 'AJV_EMP_Email');
                    $emp = employee::where('AJV_EMP_Email','=',$user->email)->first();  

    if($request->startDate != null){
       $from = $request->startDate.' '.'00:00:00';
       $to = $request->endDate.' '.'24:00:00';
    } else {
       $from = null;
       $to = null;
    }

  

   }
                   

    return view('TLdashboard', compact('gefData','gefData2','gefData3','accepted','dropped','newLeadsCount','inProgressCount','acceptedCount','droppedCount','NLC','AC','DC','IP','user','dep','LemployeeList','MemployeeList','emp','from','to','chart','koru1Chart','koru2Chart','koruChart'));
    
}

}
