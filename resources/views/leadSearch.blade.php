@extends('layouts.master')
@section('page-title', 'Lead Search')
@section('page-content')
<br>
<br>
<br>
<br>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/empLogin.css') }}" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@if(auth()->check())
	<div class="row">
	  <div class="col-md-11">
            <div class="container">
	       <div class="row">
		<div class="col-md-11">
                   {!! Form::open(array('method' => 'GET','route' => 'searchLead', 'target' => '_blank')) !!}        
                   {!! Form::text('search', null,
                           array('required',
                                'class'=>'form-control',
                                'placeholder'=>'Enter a Name to search in EVEREST.....')) !!}
                  </div>
		   <div class="col-md-1">
                     {{Form::button('Search', array('type' => 'submit', 'class' => 'btn btn-success'))}}
                     {{ Form::close() }}
                   </div>
	     </div>
            </div>
          </div>
	</div>

<br>
<style>
.center {
    margin: auto;
    width: 80%;
    padding: 10px;
}
.center_b {
    margin: auto;
    width: 80%;
    padding: 10px;
    border: 3px solid black;
}

.center_c {
    margin: auto;
    width: 90%;
    padding: 10px;
    border: 3px solid black;
}
.content {
  display: flex;
}

#prompt {
  flex-shrink: 0;
}

#td {
  min-width: 600px;
  word-break: break-all;
  cursor: text;
  background-color:white;
  border: 1px solid black;
padding: 0.5em;
}

</style>

<style>
	.blink{
		width:100px;
		height: 25px;
	    background-color: green;
		padding: 10px;	
		text-align: center;
		line-height: 0px;
	}
	.blink1{
		width:100px;
		height: 25px;
	    background-color: maroon;
		padding: 10px;	
		text-align: center;
		line-height: 0px;
	}
	span1{
		font-size: 10px;
		font-family: cursive;
		color: white;
		animation: blink 1s linear infinite;
	}
@keyframes blink{
0%{opacity: 0;}
50%{opacity: .5;}
100%{opacity: 1;}
}

</style>

<section style="background:#efefe9;">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/user_tabs.css') }}" />

        <div class="container">
            <div class="row">
               <table class=buttons>
                 <tr>
                  <td><a href="{{ url('dashboard') }}"><button type="button"><B>DASHBOARD</B></button></a>
                  <td><a href="{{ url('leadApprovals') }}"><button type="button"><B>APPROVALS</B></button></a>
                  <td><a href="https://docs.google.com/spreadsheets/d/14_5ZwJ9HLZEJ6PUxtHWWZoRvKT0OCjCmTGoRQ8Wqhag/edit" target="_blank"><button type="button"><B>KNOWLEDGE BASE</B></button>
                  <td><a href="{{ url('enquiry') }}" target="_blank"><button type="button"><B>ADD ENQUIRY</B></button></a>
                  <td><button type="button"><B>IMPROVE EVEREST</B></button>
                 </tr>
               </table> 
              </div>
          <div class="board center_c">

             @if($search != null || $phone != null || $email != null || $searchDL != null || $phoneDL != null || $emailDL != null)

                  <p>Name Search Results</p>
                  <table id="keywords" cellspacing="0" cellpadding="0">
                  <thead>
                    <tr>
                      <th><span>Call Update</span></th>
                      <th><span>Created On</span></th>
                      <th><span>Full Name</span></th>
                      <th><span>Phone</span></th>
                      <th><span>Email</span></th>
                      <th><span>Source</span></th>
                      <th><span>Status</span></th>
                      <th><span>SA</span></th>
                      <th><span>CO</span></th>
                    </tr>
                  </thead>
                  <tbody>
                 @if($search != null)
                 @foreach ($search as $searchName)
                    <tr>
                      <?php 
                        $user = Auth::user();
                        $follow = App\followup::where('gef_phone','=',$searchName->gef_phone)->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->first();
                        $gonogo = App\gonogo::where('gef_phone','=',$searchName->gef_phone)->whereDate('updated_at', '=', \Carbon\Carbon::today()->toDateString())->first();
                        $gonogo1 = App\gonogo::where('gef_phone','=',$searchName->gef_phone)->first();
                        $gef = App\enquiry::where('gef_phone','=',$searchName->gef_phone)->first();
                        if($gef === null){
                            $emp = null;
                        } else {
                            $emp = App\employee::where('AJV_EMP_Email','=',$gef->gef_assigned_to)->first();
                        }
                        if($emp != null){
                           $lead = App\sales_leads::where('sales_lead_id','=',$emp->AJV_EMP_Lead)->where('sales_lead_email','=',$user->email)->first();
                        } else {
                           $lead = null; 
                        }
                          
                      ?>

                     @if($follow != null || $gonogo != null)
                        <td><div class="blink"><span1>{{ 'Called Today' }}</span1></div></td>
                     @else
                      <td>{{ ' ' }}</td> 
                     @endif
                      <td>{{ $searchName->created_at }}</td>
                      <td>{{ $searchName->gef_f_name }}</td>
                      <td>{{ $searchName->gef_phone }}</td>
                      <td>{{ $searchName->gef_email }}</td>
                      <td>{{ $searchName->gef_source }}</td>
                      <td>{{ $searchName->gef_salesApproval }}</td>
                    @if($searchName->gef_assigned_to != null)   
                      <?php 
                        $emps = App\employee::where('AJV_EMP_Email','=',$searchName->gef_assigned_to)->first();     
                      ?>
                     @if($emps != null)
                      <td>{{ $emps->AJV_EMP_shortName }}</td>
                     @else
                      <td>'Employee no more with AJV'</td>
                     @endif 
                    @else
                      <td>{{ 'Yet to be Assigned' }}</td>
                    @endif 
                    @if($searchName->gef_service_assigned_to != null)   
                      <?php 
                        $CO = App\employee::where('AJV_EMP_Email','=',$searchName->gef_service_assigned_to)->first();                         
                      ?>                    
                     @if($CO != null)
                      <td>{{ $CO->AJV_EMP_shortName }}</td>
                     @else
                      <td>'Employee no more with AJV'</td>
                     @endif 
                    @else
                      <td>{{ 'Yet to be Assigned' }}</td>
                    @endif                    
                 <td>  
                 <?php
                    $user = Auth::user();
                    $empa = App\employee::where('AJV_EMP_Email','=',$user->email)->first();                         
                    ?>
                  @if($searchName->gef_service_assigned_to === $user->email || $lead != null || $empa->AJV_EMP_Lead === null || $searchName->gef_assigned_to === $user->email)
                  
                   @if($empa->AJV_DEP_ID === '1')
                       {!! Form::model($searchName, ['method' => 'GET','route' => ['leadView', $searchName->gef_phone],'target' => '_blank']) !!}
                   @else
                       {!! Form::model($searchName, ['method' => 'GET','route' => ['serviceView', $searchName->gef_phone],'target' => '_blank']) !!}
                   @endif
                  {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                  {{ Form::close() }}   
                  @else
                   {{ 'No Access' }}               
                  @endif
                </td> 
               </tr>
              @endforeach
            @endif

            @if($search === null && $searchDL === null)
             <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No Leads found during search </p>
            @endif              

                 @if($searchDL != null)
                 @foreach ($searchDL as $searchName)
                    <tr>
                      <?php 
                        $user = Auth::user();
                        $follow = App\followup::where('gef_phone','=',$searchName->gef_phone)->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->first();
                        $gonogo = App\gonogo::where('gef_phone','=',$searchName->gef_phone)->whereDate('updated_at', '=', \Carbon\Carbon::today()->toDateString())->first();
                        $gonogo1 = App\gonogo::where('gef_phone','=',$searchName->gef_phone)->first();
                        $gef = App\gef_DL::where('gef_phone','=',$searchName->gef_phone)->first();
                        if($gef === null){
                            $emp = null;
                        } else {
                            $emp = App\employee::where('AJV_EMP_Email','=',$gef->gef_assigned_to)->first();
                        }                        
                        if($emp != null){
                           $lead = App\sales_leads::where('sales_lead_id','=',$emp->AJV_EMP_Lead)->where('sales_lead_email','=',$user->email)->first();
                        } else {
                           $lead = null; 
                        }
                          
                      ?>

                     @if($follow != null || $gonogo != null)
                        <td><div class="blink"><span1>{{ 'Called Today' }}</span1></div></td>
                     @else
                      <td>{{ ' ' }}</td> 
                     @endif
                      <td>{{ $searchName->created_at }}</td>
                      <td>{{ $searchName->gef_f_name }}</td>
                      <td>{{ $searchName->gef_phone }}</td>
                      <td>{{ $searchName->gef_email }}</td>
                      <td>{{ $searchName->gef_source }}</td>
                      <td>{{ $searchName->gef_salesApproval }}</td>
                    @if($searchName->gef_assigned_to != null)   
                      <?php 
                        $emps = App\employee::where('AJV_EMP_Email','=',$searchName->gef_assigned_to)->first(); 
                      ?>
                     @if($emps != null)
                      <td>{{ $emps->AJV_EMP_shortName }}</td>
                     @else
                      <td>'Employee no more with AJV'</td>
                     @endif 
                    @else
                      <td>{{ 'Yet to be Assigned' }}</td>
                    @endif 
                    @if($searchName->gef_service_assigned_to != null)   
                     <?php
                       $CO = App\employee::where('AJV_EMP_Email','=',$searchName->gef_service_assigned_to)->first();                         
                     ?>
                     @if($CO != null)
                      <td>{{ $CO->AJV_EMP_shortName }}</td>
                     @else
                      <td>'Employee no more with AJV'</td>
                     @endif 
                    @else
                      <td>{{ 'Yet to be Assigned' }}</td>
                    @endif                    
                 <td>  
                 <?php
                    $user = Auth::user();
                    $empa = App\employee::where('AJV_EMP_Email','=',$user->email)->first();                         
                    ?>
                  @if($lead != null || $empa->AJV_EMP_Lead === null || $searchName->gef_assigned_to === $user->email)
                   {!! Form::model($searchName, ['method' => 'GET','route' => ['leadView', $searchName->gef_phone],'target' => '_blank']) !!}
                  {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                  {{ Form::close() }}   
                  @else
                   {{ 'No Access' }}               
                  @endif
                </td> 
               </tr>
              @endforeach
            @endif       
              </tbody>
             </table>
</br>
</br>
                  <p>Mobile Search Results</p>
                  <table id="keywords" cellspacing="0" cellpadding="0">
                  <thead>
                    <tr>
                      <th><span>Call Update</span></th>
                      <th><span>Created On</span></th>
                      <th><span>Full Name</span></th>
                      <th><span>Phone</span></th>
                      <th><span>Email</span></th>
                      <th><span>Source</span></th>
                      <th><span>Status</span></th>
                      <th><span>SA</span></th>
                      <th><span>CO</span></th>
                      </tr>
                  </thead>
                  <tbody>
               @if($phone != null)
                 @foreach ($phone as $searchPhone)
                    <tr>
                      <?php 
                        $user = Auth::user();
                        $follow = App\followup::where('gef_phone','=',$searchPhone->gef_phone)->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->first();
                        $gonogo = App\gonogo::where('gef_phone','=',$searchPhone->gef_phone)->whereDate('updated_at', '=', \Carbon\Carbon::today()->toDateString())->first();
                        $gonogo1 = App\gonogo::where('gef_phone','=',$searchPhone->gef_phone)->first();
                        $gef = App\enquiry::where('gef_phone','=',$searchPhone->gef_phone)->first();
                        if($gef === null){
                            $emp = null;
                        } else {
                            $emp = App\employee::where('AJV_EMP_Email','=',$gef->gef_assigned_to)->first();
                        }                        
                        if($emp != null){
                           $lead = App\sales_leads::where('sales_lead_id','=',$emp->AJV_EMP_Lead)->where('sales_lead_email','=',$user->email)->first();
                        } else {
                           $lead = null; 
                        }                      ?>

                     @if($follow != null || $gonogo != null)
                        <td><div class="blink"><span1>{{ 'Called Today' }}</span1></div></td>
                     @else
                      <td>{{ ' ' }}</td> 
                     @endif
                      <td>{{ $searchPhone->created_at }}</td>
                      <td>{{ $searchPhone->gef_f_name }}</td>
                      <td>{{ $searchPhone->gef_phone }}</td>
                      <td>{{ $searchPhone->gef_email }}</td>
                      <td>{{ $searchPhone->gef_source }}</td>
                      <td>{{ $searchPhone->gef_salesApproval }}</td>
                    @if($searchPhone->gef_assigned_to != null)   
                      <?php 
                        $emps = App\employee::where('AJV_EMP_Email','=',$searchPhone->gef_assigned_to)->first();        
                      ?>
                     @if($emps != null)
                      <td>{{ $emps->AJV_EMP_shortName }}</td>
                     @else
                      <td>'Employee no more with AJV'</td>
                     @endif 
                    @else
                      <td>{{ 'Yet to be Assigned' }}</td>
                    @endif 
                    @if($searchPhone->gef_service_assigned_to != null)   
                     <?php
                       $CO = App\employee::where('AJV_EMP_Email','=',$searchPhone->gef_service_assigned_to)->first();                         
                     ?>                    
                     @if($CO != null)
                      <td>{{ $CO->AJV_EMP_shortName }}</td>
                     @else
                      <td>'Employee no more with AJV'</td>
                     @endif 
                    @else
                      <td>{{ 'Yet to be Assigned' }}</td>
                    @endif                    
                 <td>  
                 <?php
                    $user = Auth::user();
                    $empa = App\employee::where('AJV_EMP_Email','=',$user->email)->first();                         
                    ?>
                  @if($searchPhone->gef_assigned_to === $user->email || $lead != null || $empa->AJV_EMP_Lead === null || $searchPhone->gef_service_assigned_to === $user->email)   
                                 
                   @if($empa->AJV_DEP_ID === '1')
                    {!! Form::model($searchPhone, ['method' => 'GET','route' => ['leadView', $searchPhone->gef_phone],'target' => '_blank']) !!}
                  {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                    
                   @else
                    {!! Form::model($searchPhone, ['method' => 'GET','route' => ['serviceView', $searchPhone->gef_phone],'target' => '_blank']) !!}
                  {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                    
                   @endif
                  {{ Form::close() }}   
                  @else
                   {{ 'No Access' }}               
                  @endif
                </td> 
               </tr>
              @endforeach
            @endif

            @if($phone === null && $phoneDL === null)
             <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No Leads found during search, if searched for email id </p>
            @endif

               @if($phoneDL != null)
                 @foreach ($phoneDL as $searchPhone)
                    <tr>
                      <?php 
                        $user = Auth::user();
                        $follow = App\followup::where('gef_phone','=',$searchPhone->gef_phone)->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->first();
                        $gonogo = App\gonogo::where('gef_phone','=',$searchPhone->gef_phone)->whereDate('updated_at', '=', \Carbon\Carbon::today()->toDateString())->first();
                        $gonogo1 = App\gonogo::where('gef_phone','=',$searchPhone->gef_phone)->first();
                        $gef = App\gef_DL::where('gef_phone','=',$searchPhone->gef_phone)->first();
                        if($gef === null){
                            $emp = null;
                        } else {
                            $emp = App\employee::where('AJV_EMP_Email','=',$gef->gef_assigned_to)->first();
                        }
                        if($emp != null){
                           $lead = App\sales_leads::where('sales_lead_id','=',$emp->AJV_EMP_Lead)->where('sales_lead_email','=',$user->email)->first();
                        } else {
                           $lead = null; 
                        }                      ?>

                     @if($follow != null || $gonogo != null)
                        <td><div class="blink"><span1>{{ 'Called Today' }}</span1></div></td>
                     @else
                      <td>{{ ' ' }}</td> 
                     @endif
                      <td>{{ $searchPhone->created_at }}</td>
                      <td>{{ $searchPhone->gef_f_name }}</td>
                      <td>{{ $searchPhone->gef_phone }}</td>
                      <td>{{ $searchPhone->gef_email }}</td>
                      <td>{{ $searchPhone->gef_source }}</td>
                      <td>{{ $searchPhone->gef_salesApproval }}</td>
                    @if($searchPhone->gef_assigned_to != null)   
                      <?php 
                        $emps = App\employee::where('AJV_EMP_Email','=',$searchPhone->gef_assigned_to)->first();                         
                      ?>
                     @if($emps != null)
                      <td>{{ $emps->AJV_EMP_shortName }}</td>
                     @else
                      <td>'Employee no more with AJV'</td>
                     @endif 
                    @else
                      <td>{{ 'Yet to be Assigned' }}</td>
                    @endif 
                    @if($searchPhone->gef_service_assigned_to != null)   
                     <?php
                       $CO = App\employee::where('AJV_EMP_Email','=',$searchPhone->gef_service_assigned_to)->first();                         
                     ?>                    
                     @if($CO != null)
                      <td>{{ $CO->AJV_EMP_shortName }}</td>
                     @else
                      <td>'Employee no more with AJV'</td>
                     @endif 
                    @else
                      <td>{{ 'Yet to be Assigned' }}</td>
                    @endif                     
                 <td>  
                 <?php
                    $user = Auth::user();
                    $empa = App\employee::where('AJV_EMP_Email','=',$user->email)->first();                         
                    ?>
                  @if($searchPhone->gef_assigned_to === $user->email || $lead != null || $empa->AJV_EMP_Lead === null)
                   {!! Form::model($searchPhone, ['method' => 'GET','route' => ['leadView', $searchPhone->gef_phone],'target' => '_blank']) !!}
                  {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                  {{ Form::close() }}   
                  @else
                   {{ 'No Access' }}               
                  @endif
                </td> 
               </tr>
              @endforeach
            @endif

              </tbody>
             </table>

</br>
</br>
 
                  <p>Email Search Results</p>
                  <table id="keywords" cellspacing="0" cellpadding="0">
                  <thead>
                    <tr>
                      <th><span>Call Update</span></th>
                      <th><span>Created On</span></th>
                      <th><span>Full Name</span></th>
                      <th><span>Phone</span></th>
                      <th><span>Email</span></th>
                      <th><span>Source</span></th>
                      <th><span>Status</span></th>
                      <th><span>SA</span></th>
                      <th><span>CO</span></th>
                    </tr>
                  </thead>
                  <tbody>
               @if($email != null)
                 @foreach ($email as $searchEmail)
                    <tr>
                      <?php 
                        $user = Auth::user();
                        $follow = App\followup::where('gef_phone','=',$searchEmail->gef_phone)->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->first();
                        $gonogo = App\gonogo::where('gef_phone','=',$searchEmail->gef_phone)->whereDate('updated_at', '=', \Carbon\Carbon::today()->toDateString())->first();
                        $gonogo1 = App\gonogo::where('gef_phone','=',$searchEmail->gef_phone)->first();
                        $gef = App\enquiry::where('gef_phone','=',$searchEmail->gef_phone)->first();
                        if($gef === null){
                            $emp = null;
                        } else {
                            $emp = App\employee::where('AJV_EMP_Email','=',$gef->gef_assigned_to)->first();
                        }
                        if($emp != null){
                           $lead = App\sales_leads::where('sales_lead_id','=',$emp->AJV_EMP_Lead)->where('sales_lead_email','=',$user->email)->first();
                        } else {
                           $lead = null; 
                        }                      ?>

                     @if($follow != null || $gonogo != null)
                        <td><div class="blink"><span1>{{ 'Called Today' }}</span1></div></td>
                     @else
                      <td>{{ ' ' }}</td> 
                     @endif
                      <td>{{ $searchEmail->created_at }}</td>
                      <td>{{ $searchEmail->gef_f_name }}</td>
                      <td>{{ $searchEmail->gef_phone }}</td>
                      <td>{{ $searchEmail->gef_email }}</td>
                      <td>{{ $searchEmail->gef_source }}</td>
                      <td>{{ $searchEmail->gef_salesApproval }}</td>
                    @if($searchEmail->gef_assigned_to != null)   
                      <?php 
                        $emps = App\employee::where('AJV_EMP_Email','=',$searchEmail->gef_assigned_to)->first();                         
                      ?>
                     @if($emps != null)
                      <td>{{ $emps->AJV_EMP_Fname }} {{ $emps->AJV_EMP_Lname }}</td>
                     @else
                      <td>'Employee no more with AJV'</td>
                     @endif 
                    @else
                      <td>{{ 'Yet to be Assigned' }}</td>
                    @endif 
                    @if($searchEmail->gef_service_assigned_to != null)   
                      <?php 
                        $CO = App\employee::where('AJV_EMP_Email','=',$searchEmail->gef_service_assigned_to)->first();                         
                      ?>
                     @if($CO != null)
                      <td>{{ $CO->AJV_EMP_shortName }}</td>
                     @else
                      <td>'Employee no more with AJV'</td>
                     @endif 
                    @else
                      <td>{{ 'Yet to be Assigned' }}</td>
                    @endif                     
                 <td>  
                 <?php
                    $user = Auth::user();
                    $empa = App\employee::where('AJV_EMP_Email','=',$user->email)->first();                         
                    ?>
                  @if($searchEmail->gef_assigned_to === $user->email || $lead != null || $empa->AJV_EMP_Lead === null || $searchEmail->gef_service_assigned_to === $user->email )
                   @if($empa->AJV_DEP_ID === '1')
                    {!! Form::model($searchEmail, ['method' => 'GET','route' => ['leadView', $searchEmail->gef_phone],'target' => '_blank']) !!}
                   @else
                    {!! Form::model($searchEmail, ['method' => 'GET','route' => ['serviceView', $searchEmail->gef_phone],'target' => '_blank']) !!}
                   @endif
                  {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                  {{ Form::close() }}   
                  @else
                   {{ 'No Access' }}               
                  @endif
                </td> 
               </tr>
              @endforeach
            @endif

               @if($emailDL != null)
                 @foreach ($emailDL as $searchEmail)
                    <tr>
                      <?php 
                        $user = Auth::user();
                        $follow = App\followup::where('gef_phone','=',$searchEmail->gef_phone)->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->first();
                        $gonogo = App\gonogo::where('gef_phone','=',$searchEmail->gef_phone)->whereDate('updated_at', '=', \Carbon\Carbon::today()->toDateString())->first();
                        $gonogo1 = App\gonogo::where('gef_phone','=',$searchEmail->gef_phone)->first();
                        $gef = App\gef_DL::where('gef_phone','=',$searchEmail->gef_phone)->first();
                        if($gef === null){
                            $emp = null;
                        } else {
                            $emp = App\employee::where('AJV_EMP_Email','=',$gef->gef_assigned_to)->first();
                        }
                        if($emp != null){
                           $lead = App\sales_leads::where('sales_lead_id','=',$emp->AJV_EMP_Lead)->where('sales_lead_email','=',$user->email)->first();
                        } else {
                           $lead = null; 
                        }                      ?>

                     @if($follow != null || $gonogo != null)
                        <td><div class="blink"><span1>{{ 'Called Today' }}</span1></div></td>
                     @else
                      <td>{{ ' ' }}</td> 
                     @endif
                      <td>{{ $searchEmail->created_at }}</td>
                      <td>{{ $searchEmail->gef_f_name }}</td>
                      <td>{{ $searchEmail->gef_phone }}</td>
                      <td>{{ $searchEmail->gef_email }}</td>
                      <td>{{ $searchEmail->gef_source }}</td>
                      <td>{{ $searchEmail->gef_salesApproval }}</td>
                    @if($searchEmail->gef_assigned_to != null)   
                      <?php 
                        $emps = App\employee::where('AJV_EMP_Email','=',$searchEmail->gef_assigned_to)->first();                         
                      ?>
                     @if($emps != null)
                      <td>{{ $emps->AJV_EMP_shortName }}</td>
                     @else
                      <td>'Employee no more with AJV'</td>
                     @endif 
                    @else
                      <td>{{ 'Yet to be Assigned' }}</td>
                    @endif 
                    @if($searchEmail->gef_service_assigned_to != null)   
                      <?php 
                        $CO = App\employee::where('AJV_EMP_Email','=',$searchEmail->gef_service_assigned_to)->first();                         
                      ?>
                     @if($CO != null)
                      <td>{{ $CO->AJV_EMP_shortName }}</td>
                     @else
                      <td>'Employee no more with AJV'</td>
                     @endif 
                    @else
                      <td>{{ 'Yet to be Assigned' }}</td>
                    @endif                     
                 <td>  
                 <?php
                    $user = Auth::user();
                    $empa = App\employee::where('AJV_EMP_Email','=',$user->email)->first();                         
                    ?>
                  @if($searchEmail->gef_assigned_to === $user->email || $lead != null || $empa->AJV_EMP_Lead === null)
                   {!! Form::model($searchEmail, ['method' => 'GET','route' => ['leadView', $searchEmail->gef_phone],'target' => '_blank']) !!}
                  {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                  {{ Form::close() }}   
                  @else
                   {{ 'No Access' }}               
                  @endif
                </td> 
               </tr>
              @endforeach
            @endif

              </tbody>
             </table>

           @if($email === null && $emailDL === null)
             <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No Leads found during search, if searched for email id </p>
            @endif
        @else
             <table id="keywords" cellspacing="0" cellpadding="0">
                  <thead>
                    <tr>
                      <th><span>First Name</span></th>
                      <th><span>Last Name</span></th>
                      <th><span>Phone</span></th>
                      <th><span>Nationality</span></th>
                      <th><span>Location</span></th>
                      <th><span>Assigned To</span></th>
                    </tr>
                  </thead>
             </table>
             <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No Leads found with the Name or email or phone or FB ID you are trying to search </p>
      @endif

         </div>  
       </div>       

@else
</br>
</br>
</br>
</br>
</br>
</br>
</br>
<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You are not logged in or you are not Authorized to access.</h3> 
<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please login to access your account or contact administrator.</h3>
<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Email : dev.ops@ajv.kiwi </h3> 
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/empLogin.css') }}" />

  <div class="container">
    <div class="omb_login">
        <div class="row omb_row-sm-offset-3 omb_socialButtons">
            <div class="col-xs-8 col-sm-4">
                <a href="{{ action('App\Http\Controllers\Auth\LoginController@auth', ['provider' => 'google']) }}" class="btn btn-lg btn-block omb_btn-google">
                    <i class="fa fa-google-plus visible-xs"></i>
                    <span class="hidden-xs">Google+</span>
                </a>
            </div>
        </div>          
    </div>
  </div>
@endif
@stop
