@extends('layouts.master')
@section('page-title', 'Export Leads')
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

<div class="container">

</br>
        <h2 class="text-center">
            Export Leads
        </h2>

       <div class="container">
	       <div class="row">
		<div class="col-md-5">
                   {!! Form::open(array('method' => 'GET','route' => 'exportLead', 'target' => '_blank')) !!}      
                   {!! Form::label('Start Date') !!}  
                   {!! Form::text('startDate', null,
                           array('required',
                                'class'=>'form-control clsDatePicker',
                                'readonly'=>'readonly',
                                'id'=>'startDate',
                                'name'=>'startDate')) !!}
                  </div>
		<div class="col-md-5">
                   {!! Form::label('End Date') !!}  
                   {!! Form::text('endDate', null,
                           array('required',
                                'class'=>'form-control clsDatePicker',
                                'readonly'=>'readonly',
                                'id'=>'endDate',
                                'name'=>'endDate')) !!}
                  </div>
                </div>  
              </br>
	       <div class="row">
		<div class="col-md-5">
                   {!! Form::label('Select Adviser (Not Mandatory)') !!}  
                   {!! Form::select('adviser', $MemployeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control']) !!} 
                </div>
		<div class="col-md-5">
                   {!! Form::label('Select Status (Not Mandatory)') !!}
                   {{ Form::select('status', [
                                   'New Leads' => 'New Leads',
                                   'In Progress' => 'In Progress',
                                   'Drop Pending' => 'Dropped'], null, ['placeholder' => 'Select Status', 'class' => 'form-control']
                  ) }}
                  </div>
                </div>  
              </br>
	       <div class="row">
		   <div class="col-md-1">
                       <a href="{{ url('exportLead') }}"><button class="btn btn-success btn-lg">Export to Excel</button></a>
                     {{ Form::close() }}
                   </div>
	       </div>
                  </br>

	</div>


</div>

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