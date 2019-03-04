@extends('layouts.master')
@section('page-title', 'SALES DAILY STA REPORT')
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
<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();   
});
</script>

</br>
        <h2 class="text-center">
            Sales Advisors Daily Report
        </h2>

</br>


<br>


        <h2 class="text-center">
            KORU 1 Daily Report
        </h2>
<table id="keywords" cellspacing="0" cellpadding="0">
				<thead>
				<tr> 
                                 <th><span>Advisor</span></th>
                                 <th><span>Apps</span></th>
                                 <th><span>NL</span></th>
                                 <th><span>STA-JFM19</span></th>
                                 <th><span>STA-AMJ19</span></th>
                                 <th><span>STA-JAS19</span></th>
                                 <th><span>STA-OND19</span></th>
                                 <th><span>HOT</span></th>
                                 <th><span>Beyond</span></th>
                                 <th><span>Docs Pending</span></th>

				</tr>
			     </thead>
			<tbody>
                      @foreach ($coru1 as $c1)
			<tr> 
                       <?php 
                         $user = Auth::user();
                         $emp = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();
                         $empApps = App\gef_service::where('gef_assigned_to', '=', $c1->AJV_EMP_Email)->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();
                     ?>                        
                         <td><a href="#" data-toggle="popover" title="Apps sent to service today" data-content=<?php foreach($empApps as $apps){  echo $apps->gef_f_name; } ?>>{{ $c1->AJV_EMP_shortName }} ({{$c1->monthly_count}})</a></td>
                         <td>{{ $c1->appsCount }}</td>
                         <td>{{ $c1->currentNL }}</td>
                         <td>{{ $c1->currentSTA }}</td>
                         <td>{{ $c1->currentSTAAMJ }}</td>
                         <td>{{ $c1->currentSTAJAS }}</td>
                         <td>{{ $c1->currentSTAOND }}</td>
                         <td>{{ $c1->currentHOT }}</td>
                         <td>{{ $c1->currentSTABYD }}</td>
                         <td>{{ $c1->currentDP }}</td>

                         
                        </tr>
                      @endforeach
                       <thead>
                      	<tr> 
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;Total<span></th>
                         <th><span>&nbsp;&nbsp;{{ $k1apps }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k1totalNL }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k1totalJFM }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $k1totalAMJ }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k1totalJAS }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $k1totalOND }}<span></th>
                         <th><span>{{ $k1totalHOT }}<span></th>
                         <th><span>{{ $k1totalBYD }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $k1totalDP }}<span></th>
                        </tr>  
                      </thead>
</table>
            <table id="keywords" cellspacing="0" cellpadding="0">
                    <thead>
                      <tr> 
                         <th><span><span></th>
                        <th><span><span></th>
                        <th><span>Total K1 leads in progress for the next 4 quarters as of now is {{ $k1totalNL + $k1totalJFM + $k1totalAMJ + $k1totalJAS + $k1totalOND + $k1totalHOT + $k1totalBYD + $k1totalDP }}<span></th>
                        <th><span><span></th>
                        <th><span><span></th>                         

                        </tr>  
                      </thead>
                </table>

</br>

</br>
        <h2 class="text-center">
            KORU 2 Daily Report
        </h2>

<table id="keywords" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
                                 <th><span>Advisor Name</span></th>
                                 <th><span>Apps</span></th>
                                 <th><span>NL</span></th>
                                 <th><span>STA-JFM19</span></th>
                                 <th><span>STA-AMJ19</span></th>
                                 <th><span>STA-JAS19</span></th>
                                 <th><span>STA-OND19</span></th>
                                 <th><span>HOT</span></th>
                                 <th><span>Beyond</span></th>
                                 <th><span>Docs Pending</span></th>
				</tr>
			     </thead>
			<tbody>
                      @foreach ($coru2 as $c2)
			           <tr> 
                       <?php 
                         $user = Auth::user();
                         $emp = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();
                         $empApps = App\gef_service::where('gef_assigned_to', '=', $c2->AJV_EMP_Email)->whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->get();
                     ?>                        
                         <td><a href="#" data-toggle="popover" title="Apps sent to service today" data-content=<?php foreach($empApps as $apps){  echo $apps->gef_f_name; } ?>>{{ $c2->AJV_EMP_shortName }} ({{$c2->monthly_count}})</a></td>			           
                         <td>{{ $c2->appsCount }}</td>
                         <td>{{ $c2->currentNL }}</td>
                         <td>{{ $c2->currentSTA }}</td>
                         <td>{{ $c2->currentSTAAMJ }}</td>
                         <td>{{ $c2->currentSTAJAS }}</td>
                         <td>{{ $c2->currentSTAOND }}</td>
                         <td>{{ $c2->currentHOT }}</td>
                         <td>{{ $c2->currentSTABYD }}</td>
                         <td>{{ $c2->currentDP }}</td>
                        </tr>
                      @endforeach
                    <thead>
			           <tr> 
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;Total<span></th>
                         <th><span>&nbsp;&nbsp;{{ $k2apps }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k2totalNL }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k2totalJFM }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $k2totalAMJ }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $k2totalJAS }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $k2totalOND }}<span></th>
                         <th><span>{{ $k2totalHOT }}<span></th>
                         <th><span>{{ $k2totalBYD }}<span></th>
                         <th><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $k2totalDP }}<span></th>

                        </tr> 
                       </thead>

          </tbody>
</table>
            <table id="keywords" cellspacing="0" cellpadding="0">
                    <thead>
                      <tr> 
                         <th><span><span></th>
                        <th><span><span></th>
                        <th><span>Total K2 leads in progress for the next 4 quarters as of now is {{ $k2totalNL + $k2totalJFM + $k2totalAMJ + $k2totalJAS + $k2totalOND + $k2totalHOT + $k2totalBYD + $k2totalDP }}<span></th>
                        <th><span><span></th>
                        <th><span><span></th>                         

                        </tr>  
                      </thead>
                </table>

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