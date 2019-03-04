@extends('layouts.master')
@section('page-title', 'SALES DAILY REPORT')
@section('page-content')
<br>
<br>
<br>
<br>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/empLogin.css') }}" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
 <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
 <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/user_tabs.css') }}" />


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
<div class="container">
	<div class="board">

               <table class=buttons>
                 <tr>
                  <td><a href="{{ url('dashboard') }}"><button type="button"><B>DASHBOARD</B></button></a>
                  <td><a href="{{ url('leadApprovals') }}"><button type="button"><B>APPROVALS</B></button></a>
                  <td><a href="https://docs.google.com/spreadsheets/d/14_5ZwJ9HLZEJ6PUxtHWWZoRvKT0OCjCmTGoRQ8Wqhag/edit" target="_blank"><button type="button"><B>KNOWLEDGE BASE</B></button>
                  <td><a href="{{ url('uploadLead') }}" target="_blank"><button type="button"><B>Lead Upload</B></button>
                  <td><button type="button"><B>IMPROVE EVEREST</B></button>
                  <td><button type="button"><B>LEAVE REQUEST</B></button>
                 </tr>
               </table> 
</br>
</br>
<section style="background:#ffffff;">


</br>
        <h2 class="text-center">
            Sales Advisors Daily Call Report
        </h2>

</br>


<br>

       @if($emp->AJV_EMP_Lead === null) 
	       <div class="row">		
                <div class="col-md-3">
                </div> 
		<div class="col-md-3">
                   {!! Form::open(array('method' => 'GET','route' => 'dailyReport')) !!}      
                   {!! Form::text('startDate', null,
                           array('required',
                                'class'=>'form-control clsDatePicker',
                                'readonly'=>'readonly',
                                'id'=>'startDate',
                                'name'=>'startDate', 'placeholder' => 'Start Date')) !!}
                  </div>
		<div class="col-md-3">
                   {!! Form::text('endDate', null,
                           array('required',
                                'class'=>'form-control clsDatePicker',
                                'readonly'=>'readonly',
                                'id'=>'endDate',
                                'name'=>'endDate', 'placeholder' => 'End Date')) !!}
                  </div>
		   <div class="col-md-1">
                       <button class="btn btn-success">Submit</button></a>
                     {{ Form::close() }}
                   </div>
	       </div>
                  </br>
<script type="text/javascript"> 

   $('#startDate').datepicker({
     dateFormat: 'yy-mm-dd',
     minDate: "-6y",
     yearRange: "-6:-0",
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

  $('#endDate').datepicker({
     dateFormat: 'yy-mm-dd',
     minDate: "-6y",
     yearRange: "-6:-0",
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

</script>

<style type="text/css">
.clsDatePicker {
    z-index: 100000;
}
</style>
         @endif 


   @if($from != null)
<?php

       $todayLead= App\enquiry::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->get();
                        $todayLeadCount = $todayLead->count();

?>
    @else
<?php
       $todayLead= App\enquiry::whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();
                        $todayLeadCount = $todayLead->count();
?>
    @endif

	       <div class="row">
		<div class="col-md-5">
                </div>
		<div class="col-md-2">
                  Total leads added - {{ $todayLeadCount }}
                </div>
		<div class="col-md-5">
                </div>
               </div> 
<br>
<br>

        <h2 class="text-center">
            KORU 1 Call Report
        </h2>

          <table class="tablesorter" id="keywords" cellspacing="0" cellpadding="0">

        <thead>
          <tr>
              <th><span>Advisor Name</span></th>
                 <th><span>Spoken</span></th>
                 <th><span>UnSpoken</span></th>
                 <th><span>Others</span></th>
                 <th><span>Total Calls</span></th>
                 <th><span>Dropped</span></th>
          </tr>
         </thead>

            <tr>             
                      @foreach ($coru1 as $c1)
			<tr> 
                         <td>{{ $c1->AJV_EMP_shortName }}</td>
                         <td>{{ $c1->dailyCountS }}</td>
                         <td>{{ $c1->dailyCountNS }}</td>
                         <td>{{ $c1->dailyOthers }}</td>
                         <td>{{ $c1->daily_count }}</td>
                         <td>{{ $c1->dailyDropped }}</td>
                        </tr>
                      @endforeach
        <thead>
			<tr> 
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;Total<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k1totalS }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k1totalN }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k1totalO }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k1totalC }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k1totalD }}<span></th>
                        </tr>
        </thead>
            </tr>

        </table> 


</br>

</br>

        <h2 class="text-center">
            KORU 2 Call Report
        </h2>

          <table class="tablesorter" id="keywords" cellspacing="0" cellpadding="0">

        <thead>
          <tr>
              <th><span>Advisor Name</span></th>
                 <th><span>Spoken</span></th>
                 <th><span>UnSpoken</span></th>
                 <th><span>Others</span></th>
                 <th><span>Total Calls</span></th>
                 <th><span>Dropped</span></th>
          </tr>
         </thead>

            <tr>             
                      @foreach ($coru2 as $c2)
			<tr> 
                         <td>{{ $c2->AJV_EMP_shortName }}</td>
                         <td>{{ $c2->dailyCountS }}</td>
                         <td>{{ $c2->dailyCountNS }}</td>
                         <td>{{ $c2->dailyOthers }}</td>
                         <td>{{ $c2->daily_count }}</td>
                         <td>{{ $c2->dailyDropped }}</td>
                        </tr>
                      @endforeach
        <thead>
			<tr> 
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;Total<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k2totalS }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k2totalN }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k2totalO }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k2totalC }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k2totalD }}<span></th>
                        </tr>
        </thead>

            </tr>

        </table> 
        </div>
      </div>

</br>






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