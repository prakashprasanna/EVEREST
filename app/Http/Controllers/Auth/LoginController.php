<?php
 
namespace App\Http\Controllers\Auth;
 
use Cache; 
use App\LoginUser;
use App\enquiry;
use App\gef_service;
use App\gonogo;
use App\employee;
use App\followup;
use App\subject;
use App\ajv_department;
use App\sales_leads;
use App\service_leads;
use Illuminate\Http\Request;
use App\Exceptions\SocialAuthException;
use Illuminate\Support\Facades\Auth;
use Charts;

 
class LoginController extends Controller
{
    protected $loginUser;
 
    public function __construct(LoginUser $loginUser)
    {
        $this->loginUser = $loginUser;
    }
 
    public function showLoginPage()
    {
       return view('auth.login');
    }
 
    
    public function auth($provider)
    {
        return $this->loginUser->authenticate($provider);
    }
 
     public function login($provider)
    {
        try {
            $this->loginUser->login($provider);
            $user = Auth::user();
            if($user != null){
               $emp = employee::where('AJV_EMP_Email', '=', $user->email)->first();
               $dep = sales_leads::where('sales_lead_email','=',$user->email)->first();
               if($emp->AJV_DEP_ID == '2' || $emp->AJV_DEP_ID == '4'){
                  return redirect()->route('servicedashboard');
               } else { 
                  if($emp->AJV_DEP_ID == '1'){
                     $emp->dash_tab = '#summary';
                     $emp->save();
                     return redirect()->route('dashboard'); 
                  } else {      
                     return redirect()->route('selectProcess');
                  }    
               }
            }  
                  return redirect()->route('dashboard');

        } catch (SocialAuthException $e) {
            return redirect()->action('App\Http\Controllers\Auth\LoginController@showLoginPage')
                ->with('flash-message', $e->getMessage());
        }
    }
 
    public function logout()
    {
       auth()->logout();
       Cache::flush();
       return redirect()->to('/'); 
    }

    public function destinations()
    {
        return view('auth.destinations');
    }

    public function dashboard(Request $request)
    {
    $user = Auth::user();
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
          $gefData = enquiry::where('gef_salesApproval','=','New Leads')->where('assigned_lead','=',$dep->sales_lead_email)->where('gef_assigned_to','=',$emp->dash_filter)->orderBy('created_at', 'DESC')->paginate($emp->NL_row);
          $NLCount = enquiry::where('gef_salesApproval','=','New Leads')->where('assigned_lead','=',$dep->sales_lead_email)->where('gef_assigned_to','=',$emp->dash_filter)->get();

          $NLCount1 = enquiry::where('gef_salesApproval','=','New Leads')->where('assigned_lead','=',$dep->sales_lead_email)->get();          
          $IPCount1 = enquiry::whereNotNull('gef_assigned_To')->where('assigned_lead','=',$dep->sales_lead_email)->where('gef_salesApproval','=','In Progress')->get();   

           $gefData2 = enquiry::whereNotNull('gef_assigned_To')->where('gef_up_lead_status','=',$emp->dash_filter_status)->where('gef_assigned_to','=',$emp->dash_filter)->where('assigned_lead','=',$dep->sales_lead_email)->orderBy('updated_at', 'DESC')->paginate(200);
           $IPCount = enquiry::whereNotNull('gef_assigned_To')->where('gef_up_lead_status','=',$emp->dash_filter_status)->where('gef_assigned_to','=',$emp->dash_filter)->where('assigned_lead','=',$dep->sales_lead_email)->get();
           
          $accepted = gef_service::where('gef_salesApproval', '=', 'Approval Pending')->where('gef_assigned_to','=',$emp->dash_filter)->where('assigned_lead','=',$dep->sales_lead_email)->orderBy('updated_at', 'DESC')->paginate(40);           
          $aCount   = gef_service::where('gef_salesApproval','=','Approval Pending')->where('gef_assigned_to','=',$emp->dash_filter)->where('assigned_lead','=',$dep->sales_lead_email)->get();            
          $aCount1  = gef_service::where('gef_salesApproval','=','Approval Pending')->where('assigned_lead','=',$dep->sales_lead_email)->get();    


     } else {

       $user = Auth::user();

       $emp = employee::where('AJV_EMP_Email', '=', $user->email)->first();

          $gefData2 = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->orderBy('updated_at', 'DESC')->paginate(80);

          $IPCount = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->get(); 
  
       if($emp->dash_filter_status != 'All'){

         $gefData2 = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->where('gef_up_lead_status','=',$emp->dash_filter_status)->orderBy('updated_at', 'DESC')->paginate(80);

       $IPCount = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->where('gef_up_lead_status','=',$emp->dash_filter_status)->get(); 
       
       } else {

          $gefData2 = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->orderBy('updated_at', 'DESC')->paginate(80);

          $IPCount = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->get(); 

       }

       $IPCount1 = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','In Progress')->get();        

        $gefData = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','New Leads')->orderBy('created_at', 'DESC')->paginate(100);

        $NLCount = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','New Leads')->get();    
      
          $NLCount1 = enquiry::where('gef_assigned_To','=',$user->email)->where('gef_salesApproval','=','New Leads')->get();   

        $accepted = gef_service::where('gef_assigned_to','=',$user->email)->where('gef_salesApproval', '=', 'Approval Pending')->orderBy('updated_at', 'DESC')->paginate(40); 

        $aCount = gef_service::where('gef_assigned_to','=',$user->email)->where('gef_salesApproval', '=', 'Approval Pending')->get();

          $aCount1  = gef_service::where('gef_assigned_to','=',$user->email)->where('gef_salesApproval', '=', 'Approval Pending')->get();   
          
          

     }

       if($emp->AJV_DEP_ID === '1' || '9' and $emp->AJV_EMP_Lead === null){
          
             
          $gefData = enquiry::where('gef_salesApproval','=','New Leads')->where('gef_assigned_to','=',$emp->dash_filter)->orderBy('created_at', 'DESC')->paginate($emp->NL_row);
          $NLCount = enquiry::where('gef_salesApproval','=','New Leads')->where('gef_assigned_to','=',$emp->dash_filter)->get(); 

          $NLCount1 = enquiry::where('gef_salesApproval','=','New Leads')->get();         
          $IPCount1 = enquiry::whereNotNull('gef_assigned_To')->where('gef_salesApproval','=','In Progress')->orderBy('updated_at', 'DESC')->get();   

           $gefData2 = enquiry::whereNotNull('gef_assigned_To')->where('gef_up_lead_status','=',$emp->dash_filter_status)->where('gef_assigned_to','=',$emp->dash_filter)->paginate(100);
           $IPCount = enquiry::whereNotNull('gef_assigned_To')->where('gef_up_lead_status','=',$emp->dash_filter_status)->where('gef_assigned_to','=',$emp->dash_filter)->get();
          $accepted = gef_service::where('gef_salesApproval', '=', 'Approval Pending')->where('gef_assigned_to','=',$emp->dash_filter)->orderBy('updated_at', 'DESC')->paginate(40);           
          $aCount   = gef_service::where('gef_salesApproval','=','Approval Pending')->where('gef_assigned_to','=',$emp->dash_filter)->get(); 
          $aCount1  = gef_service::where('gef_salesApproval','=','Approval Pending')->get();    
          
       } 



     $newLeadsCount = $NLCount->count();
     $inProgressCount = $IPCount->count(); 
     $acceptedCount = $aCount->count();
     


     $NLC = $NLCount1->count();

     $IP = $IPCount1->count();
     
     $AC = $aCount1->count();
     

    $href = $request->input('href');
    $newApps = 0; 
    $inProgress = 0; 
    $accepted1 = 0; 

    $newApps = strpos($href,'newApps');
    $inProgress = strpos($href,'inProgress');
    $accepted1 = strpos($href,'accepted');
    


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
        }
    }

                    $leads = sales_leads::where('sales_lead_head', '=', '1')->pluck('sales_lead_SN','sales_lead_email');    

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
    
         $coru1 = employee::where('AJV_EMP_Lead', '=', '1')->get();
     $coru2 = employee::where('AJV_EMP_Lead', '=', '2')->get();
     
     $k1apps = employee::where('AJV_EMP_Lead', '=', '1')->sum('appsCount');
     $k2apps = employee::where('AJV_EMP_Lead', '=', '2')->sum('appsCount');

   }
                   

    return view('dashboard', compact('gefData','gefData2','newLeadsCount','inProgressCount','NLC','IP','user','dep','LemployeeList','MemployeeList','emp','from','to','leads','coru1','coru2','k1apps','k2apps','accepted','acceptedCount','AC'));
    

    }


    public function servicedashboard(Request $request)
    {
    $user = Auth::user();
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
     $dep = service_leads::where('sales_lead_email','=',$user->email)->first();
     if($dep != null){
          $gefData = gef_service::where('gef_serviceApproval','=','New Leads')->where('service_assigned_lead','=',$dep->sales_lead_email)->where('gef_service_assigned_to','=',$emp->dash_filter)->orderBy('created_at', 'DESC')->paginate(300);
          $NLCount = gef_service::where('gef_serviceApproval','=','New Leads')->where('service_assigned_lead','=',$dep->sales_lead_email)->where('gef_service_assigned_to','=',$emp->dash_filter)->get();
  
          $accepted = gef_service::where('gef_serviceApproval', '=', 'Approved')->where('gef_service_assigned_to','=',$emp->dash_filter)->where('service_assigned_lead','=',$dep->sales_lead_email)->orderBy('updated_at', 'DESC')->paginate(40);           
          $aCount   = gef_service::where('gef_serviceApproval','=','Approved')->where('gef_service_assigned_to','=',$emp->dash_filter)->where('service_assigned_lead','=',$dep->sales_lead_email)->get(); 
          $dropped = gef_service::where('gef_serviceApproval', '=', 'Drop Pending')->where('gef_service_assigned_to','=',$emp->dash_filter)->where('service_assigned_lead','=',$dep->sales_lead_email)->orderBy('updated_at', 'DESC')->paginate(300);
          $dCount = gef_service::where('gef_serviceApproval', '=', 'Drop Pending')->where('gef_service_assigned_to','=',$emp->dash_filter)->where('service_assigned_lead','=',$dep->sales_lead_email)->get();

          $NLCount1 = gef_service::where('gef_serviceApproval','=','New Leads')->where('service_assigned_lead','=',$dep->sales_lead_email)->get();         
          $aCount1  = gef_service::where('gef_serviceApproval','=','Approved')->where('service_assigned_lead','=',$dep->sales_lead_email)->get();    
          $dCount1 = gef_service::where('gef_serviceApproval', '=', 'Drop Pending')->where('service_assigned_lead','=',$dep->sales_lead_email)->get(); 
          $IPCount1 = gef_service::whereNotNull('gef_service_assigned_to')->where('service_assigned_lead','=',$dep->sales_lead_email)->where('gef_serviceApproval','=','In Progress')->get();   

       if($emp->dash_filter_status != 'All'){

           $gefData2 = gef_service::whereNotNull('gef_service_assigned_to')->where('gef_up_app_status','=',$emp->dash_filter_status)->where('gef_service_assigned_to','=',$emp->dash_filter)->where('service_assigned_lead','=',$dep->sales_lead_email)->orderBy('updated_at', 'DESC')->paginate(300);
           $IPCount = gef_service::whereNotNull('gef_service_assigned_to')->where('gef_up_app_status','=',$emp->dash_filter_status)->where('gef_service_assigned_to','=',$emp->dash_filter)->where('service_assigned_lead','=',$dep->sales_lead_email)->get();

      } else {

           $gefData2 = gef_service::whereNotNull('gef_service_assigned_to')->where('gef_serviceApproval','=','In Progress')->where('gef_service_assigned_to','=',$emp->dash_filter)->where('service_assigned_lead','=',$dep->sales_lead_email)->orderBy('updated_at', 'DESC')->paginate(300);
           $IPCount = gef_service::whereNotNull('gef_service_assigned_to')->where('gef_serviceApproval','=','In Progress')->where('gef_service_assigned_to','=',$emp->dash_filter)->where('service_assigned_lead','=',$dep->sales_lead_email)->get();
     
     }

     } else {

       $user = Auth::user();

       $emp = employee::where('AJV_EMP_Email', '=', $user->email)->first();

          $gefData2 = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval','=','In Progress')->orderBy('updated_at', 'DESC')->paginate(40);

          $IPCount = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval','=','In Progress')->get(); 
  
       if($emp->dash_filter_status != 'All'){

         $gefData2 = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval','=','In Progress')->where('gef_up_app_status','=',$emp->dash_filter_status)->orderBy('updated_at', 'DESC')->paginate(300);

       $IPCount = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval','=','In Progress')->where('gef_up_app_status','=',$emp->dash_filter_status)->get(); 
       
       } else {

          $gefData2 = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval','=','In Progress')->orderBy('updated_at', 'DESC')->paginate(300);

          $IPCount = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval','=','In Progress')->get(); 

       }

       $IPCount1 = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval','=','In Progress')->get();        

        $gefData = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval','=','New Leads')->orderBy('created_at', 'DESC')->paginate(300);

        $NLCount = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval','=','New Leads')->get();    
      
        $accepted = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval', '=', 'Approved')->orderBy('updated_at', 'DESC')->paginate(40); 

        $aCount = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval', '=', 'Approved')->get();

        $dropped = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval', '=', 'Drop Pending')->orderBy('updated_at', 'DESC')->paginate(300);

        $dCount= gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval', '=', 'Drop Pending')->get();

          $NLCount1 = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval','=','New Leads')->get();          
          $aCount1  = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval', '=', 'Approved')->get();   
          $dCount1 = gef_service::where('gef_service_assigned_to','=',$user->email)->where('gef_serviceApproval', '=', 'Drop Pending')->get();

     }

       if($emp->AJV_DEP_ID === '2' || '9' and $emp->AJV_EMP_Lead === null){
          $gefData = gef_service::where('gef_serviceApproval','=','New Leads')->where('gef_service_assigned_to','=',$emp->dash_filter)->orderBy('created_at', 'DESC')->paginate(300);
          $NLCount = gef_service::where('gef_serviceApproval','=','New Leads')->where('gef_service_assigned_to','=',$emp->dash_filter)->get(); 
          $accepted = gef_service::where('gef_serviceApproval', '=', 'Approved')->where('gef_service_assigned_to','=',$emp->dash_filter)->orderBy('updated_at', 'DESC')->paginate(40);           
          $aCount   = gef_service::where('gef_serviceApproval','=','Approved')->where('gef_service_assigned_to','=',$emp->dash_filter)->get(); 
          $dropped = gef_service::where('gef_serviceApproval', '=', 'Drop Pending')->where('gef_service_assigned_to','=',$emp->dash_filter)->orderBy('updated_at', 'DESC')->paginate(300);
          $dCount = gef_service::where('gef_serviceApproval', '=', 'Drop Pending')->where('gef_service_assigned_to','=',$emp->dash_filter)->get();

          $NLCount1 = gef_service::where('gef_serviceApproval','=','New Leads')->get();         
          $aCount1  = gef_service::where('gef_serviceApproval','=','Approved')->get();    
          $dCount1 = gef_service::where('gef_serviceApproval', '=', 'Drop Pending')->get(); 
          $IPCount1 = gef_service::whereNotNull('gef_service_assigned_to')->where('gef_serviceApproval','=','In Progress')->orderBy('updated_at', 'DESC')->get();   

       if($emp->dash_filter_status != 'All'){
           $gefData2 = gef_service::whereNotNull('gef_service_assigned_to')->where('gef_up_app_status','=',$emp->dash_filter_status)->where('gef_service_assigned_to','=',$emp->dash_filter)->paginate(300);
           $IPCount = gef_service::whereNotNull('gef_service_assigned_to')->where('gef_up_app_status','=',$emp->dash_filter_status)->where('gef_service_assigned_to','=',$emp->dash_filter)->get();

      } else {

           $gefData2 = gef_service::where('gef_serviceApproval','=','In Progress')->where('gef_service_assigned_to','=',$emp->dash_filter)->orderBy('updated_at', 'DESC')->paginate(300);
           $IPCount = gef_service::where('gef_serviceApproval','=','In Progress')->where('gef_service_assigned_to','=',$emp->dash_filter)->get();
     
     }

       } 

       if($emp->AJV_DEP_ID === '4'){
          
             
          $gefData = gef_service::where('admissions_assigned_to','=',$user->email)->where('admissions_sendToAdmissions','=','Admissions Team')->orderBy('created_at', 'DESC')->paginate(200);

          $NLCount = gef_service::where('admissions_assigned_to','=',$user->email)->where('admissions_sendToAdmissions','=','Admissions Team')->get();    
      
          $NLCount1 = gef_service::where('admissions_assigned_to','=',$user->email)->where('admissions_sendToAdmissions','=','Admissions Team')->get(); 

         $gefData2 = gef_service::where('admissions_assigned_to','=',$user->email)->where('admissions_sendToAdmissions','=','Service Team')->orderBy('updated_at', 'DESC')->paginate(40);

       $IPCount = gef_service::where('admissions_assigned_to','=',$user->email)->where('admissions_sendToAdmissions','=','Service Team')->get(); 
       

       $IPCount1 = gef_service::where('admissions_assigned_to','=',$user->email)->where('admissions_sendToAdmissions','=','Service Team')->get();        


       } 

    $todayLead= gonogo::whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

    $todayLeadCount = $todayLead->count();

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


                    $leads = service_leads::where('sales_lead_head', '=', '2')->pluck('sales_lead_SN','sales_lead_email');    

                    $dep = service_leads::where('sales_lead_email','=',$user->email)->first();    
                   if($dep != null){
                      $LemployeeList = employee::where('AJV_DEP_ID', '=', '2')->where('AJV_EMP_Lead', '=', $dep->sales_lead_id)->pluck('AJV_EMP_Fname', 'AJV_EMP_Email');
                   }
                    $MemployeeList = employee::where('AJV_DEP_ID', '=', '2')->pluck('AJV_EMP_Fname', 'AJV_EMP_Email');
                    $emp = employee::where('AJV_EMP_Email','=',$user->email)->first();  

   }
                   

    return view('servicedashboard', compact('gefData','gefData2','accepted','dropped','newLeadsCount','inProgressCount','acceptedCount','droppedCount','NLC','AC','DC','IP','user','dep','LemployeeList','MemployeeList','emp','todayLeadCount','leads'));
    
    }

 public function selectAjax(Request $request)
    {
    	if($request->ajax()){
           $subjects = subject::where('pathway',$request->sub)->pluck('subject_name', 'subject_id')->all();
    	   $data = view('ajax-select-subjects',compact('subjects'))->render();
    	   return response()->json(['options'=>$data]);
    	}
    }

 public function subjectVal(Request $request)
    {
    	if($request->ajax()){
           $subjects = subject::where('subject_id', '=', $request->sub_id)->first();
           $subject = $subjects->subject_name;
    	   return response()->json($subject);
    	}
    }

    public function selectProcess()
    {
    
    return view('auth.selectProcess');
    }
 
}