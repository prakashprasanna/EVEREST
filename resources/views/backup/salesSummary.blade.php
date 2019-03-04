    @if($from != null)
<?php

       $todayLead= App\gonogo::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->get();
                        $todayLeadCount = $todayLead->count();

?>
    @else
<?php

       $todayLead= App\gonogo::whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();
                        $todayLeadCount = $todayLead->count();
?>
    @endif

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Daily report of all Sales advisors)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total leads added - {{ $todayLeadCount }}

<br>
<br>

        <div class="container">
		
      <table class="tablesorter" id="keywords" cellspacing="0" cellpadding="0">

        <thead>
          <tr>
              <th><span>Advisor Name</span></th>
                 <th><span>Enq Added</span></th>
                 <th><span>NL</span></th>
                 <th><span>STA</span></th>
                 <th><span>STA-JAS 18</span></th>
                 <th><span>STA-OND 18</span></th>
                 <th><span>Docs pending</span></th>
                 <th><span>Hots</span></th>
                 <th><span>Total (S+NS+Others)</span></th>
                 <th><span>Dropped</span></th>

          </tr>
         </thead>

           @foreach ($gefData3 as $retrive3)
            <tr id="product{{$retrive3->AJV_EMP_ID}}">             
              <td class="lalign">{{ $retrive3->AJV_EMP_Fname }} {{ $retrive3->AJV_EMP_Lname }}</td>
<?php

    if($from != null){
                        $enqAdded = App\enquiry::where('gef_added_by','=',$retrive3->AJV_EMP_Email)->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

                        $followS = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Spoken')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

                        $followNS = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Not Spoken')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

                        $others = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','!=','Call')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

                        $newLeads = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','New Leads')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();
                        $STA = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','STA')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();
                        $JFM = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','STA-JFM19')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

                        $AJMs = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Spoken')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

                        $AJMns = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Not Spoken')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

                        $AJMo = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','!=','Call')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();

                        $AJM = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();
                        $JAS = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','STA-JAS18')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();
                        $OND = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','STA-OND18')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();
                        $JFM1 = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','STA-JFM18')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();
                        $docs = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','Docs Pending')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();
                        $hots = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','Hot')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();
                        $DP = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','Drop Pending')->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();
                        $null = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=',null)->whereDate('created_at','>=', $from)->whereDate('created_at', '<=', $to)->get();
  
    } else {

                        $enqAdded = App\enquiry::where('gef_added_by','=',$retrive3->AJV_EMP_Email)->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

                        $follow = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

                        $followS = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Spoken')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

                        $followNS = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Not Spoken')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

                        $others = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','!=','Drop Pending')->where('sales_followup_type','!=','Call')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

                        $newLeads = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','New Leads')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();
                        $STA = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','STA')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();
                        $JFM = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','STA-JFM19')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();
                        $AJM = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

                        $AJMs = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Spoken')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

                        $AJMns = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','=','Call')->where('sales_followup_subType','=','Not Spoken')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

                        $AJMo = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('sales_followup_status','=','Drop Pending')->where('sales_followup_type','!=','Call')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();

                        $JAS = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','STA-JAS18')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();
                        $OND = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','STA-OND18')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();
                        $JFM1 = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','STA-JFM18')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();
                        $docs = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','Docs Pending')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();
                        $hots = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','Hot')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();
                        $DP = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=','Drop Pending')->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();
                        $null = App\followup::where('gef_assigned_to','=',$retrive3->AJV_EMP_Email)->where('previous_status','=',null)->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();   
    }

                        $dailyNL = $newLeads->count() + $DP->count() + $null->count(); 
                        $dailySTA = $STA->count(); 
                        $dailyJFM = $JFM->count(); 
                        $dailyAJM = $AJM->count(); 
                        $dailyJAS = $JAS->count(); 
                        $dailyOND = $OND->count(); 
                        $dailyJFM1 = $JFM1->count(); 
                        $dailyDocs = $docs->count(); 
                        $dailyHots = $hots->count();                 
                        $dailyCountS = $followS->count() + $AJMs->count();
                        $dailyCountNS = $followNS->count() + $AJMns->count();
                        $dailyOthers = $others->count() + $AJMo->count();
                        $dailyAdded = $enqAdded->count();
                        $total = $followS->count() + $AJMs->count() + $followNS->count() + $AJMns->count() + $others->count() + $AJMo->count();

?>
              <td>{{ $dailyAdded }}</td>
              <td>{{ $dailyNL }}</td>
              <td>{{ $dailySTA }}</td>
              <td>{{ $dailyJAS }}</td>
              <td>{{ $dailyOND }}</td>
              <td>{{ $dailyDocs }}</td>
              <td>{{ $dailyHots }}</td>
              <td>{{ $dailyCountS }} + {{ $dailyCountNS }} + {{ $dailyOthers }} = {{ $total }}</td>
              <td>{{ $dailyAJM }}</td>
            </tr>
           @endforeach

        </table> 
      </div>

