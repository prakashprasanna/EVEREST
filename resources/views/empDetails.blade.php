@extends('layouts.master')
@section('page-title', 'Employee Details')
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
            {{ $emp->AJV_EMP_Fname }} Details
        </h2>
              </br>

       <div class="container">
                            {!! Form::model($emp, ['method' => 'PATCH','route' => ['storeEmpDetails', $emp->AJV_EMP_Email]]) !!}
	       <div class="row">
		<div class="col-md-5">
                </div>
		<div class="col-md-1">
                      <IMG SRC={{ auth()->user()->avatar }} style="width:60px;height:60px;">
                  </div>
		<div class="col-md-2">
                   {!! Form::label('Short Name') !!}  
                   {!! Form::text('SN', $emp->AJV_EMP_shortName,
                           array('class'=>'form-control',
                                'id'=>'SN',
                                'name'=>'SN')) !!}
                  </div>
		<div class="col-md-4">
                </div>
                </div>
              </br>
     
	       <div class="row">
		<div class="col-md-1">
                </div>
		<div class="col-md-3">
                   {!! Form::label('First Name') !!}  
                   {!! Form::text('FN', $emp->AJV_EMP_Fname,
                           array('class'=>'form-control',
                                'readonly'=>'readonly',
                                'id'=>'FN',
                                'name'=>'FN')) !!}
                  </div>
		<div class="col-md-3">
                   {!! Form::label('Middle Name') !!}  
                   {!! Form::text('MN', $emp->AJV_EMP_Mname,
                           array('class'=>'form-control',
                                'id'=>'MN',
                                'name'=>'MN')) !!}
                  </div>
		<div class="col-md-4">
                   {!! Form::label('Last Name') !!}  
                   {!! Form::text('LN', $emp->AJV_EMP_Lname,
                           array('class'=>'form-control',
                                'id'=>'LN',
                                'name'=>'LN')) !!}
                  </div>
                </div>
              </br>
	       <div class="row">
		<div class="col-md-1">
                </div>
		<div class="col-md-5">
                   {!! Form::label('Date of Birth') !!}  
                   {!! Form::text('dob', $emp->AJV_EMP_DOB,
                           array('class'=>'form-control clsDatePicker',
                                'readonly'=>'readonly',
                                'id'=>'dob',
                                'name'=>'dob')) !!}
                  </div>
		<div class="col-md-5">
                   {!! Form::label('AJV Join Date') !!}  
                   {!! Form::text('joinDate', $emp->AJV_EMP_JoinDate,
                           array('class'=>'form-control clsDatePicker',
                                'readonly'=>'readonly',
                                'id'=>'joinDate',
                                'name'=>'joinDate')) !!}
                  </div>
                </div>
              </br>

	       <div class="row">
		<div class="col-md-1">
                </div>
		<div class="col-md-5">  
                   {!! Form::label('Mobile No') !!}  
                   {!! Form::text('mobile', $emp->AJV_EMP_MobileNum,
                           array('class'=>'form-control',
                                'id'=>'mobile',
                                'name'=>'mobile')) !!}
                  </div>
		<div class="col-md-5">
                   {!! Form::label('Spouse Mobile') !!}  
                   {!! Form::text('spouse', $emp->AJV_EMP_SpouseMobile,
                           array('class'=>'form-control',
                                'id'=>'spouse',
                                'name'=>'spouse')) !!}
                  </div>
                </div>  
              </br>

	       <div class="row">
		<div class="col-md-1">
                </div>
		<div class="col-md-5">  
                   {!! Form::label('Country of work') !!}
               <?php
                $countryList = App\country::pluck('country', 'country_id')->all();
               ?>
                   {!! Form::select('wcountry', $countryList, $emp->AJV_EMP_LocationOfWork, ['placeholder' => 'where are you located', 'class' => 'form-control']) !!}     
                  </div>
		<div class="col-md-5">
                  {!! Form::label('Home Address') !!}
                  {!! Form::textarea('address', $emp->AJV_EMP_Address, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'address')) !!}
                  </div>
                </div>  
              </br>

	       <div class="row">
		<div class="col-md-1">
                </div>
		<div class="col-md-5">  
                   {!! Form::label('Aadhar No') !!}  
                   {!! Form::text('aadhar', $emp->AJV_EMP_Aadhar,
                           array('class'=>'form-control',
                                'id'=>'aadhar',
                                'name'=>'aadhar')) !!}
                  </div>
		<div class="col-md-5">
                   {!! Form::label('Pan or IRD number') !!}  
                   {!! Form::text('pan', $emp->AJV_EMP_PanNo,
                           array('class'=>'form-control',
                                'id'=>'pan',
                                'name'=>'pan')) !!}
                  </div>
                </div>
              </br>

	       <div class="row">
		<div class="col-md-1">
                </div>
		<div class="col-md-5">  
                   {!! Form::label('Bank Account No') !!}  
                   {!! Form::text('account', $emp->AJV_EMP_BankAccountNo,
                           array('class'=>'form-control',
                                'id'=>'account',
                                'name'=>'account')) !!}
                  </div>
		<div class="col-md-5">
                   {!! Form::label('Bank Name') !!}  
                   {!! Form::text('bname', $emp->AJV_EMP_BankName,
                           array('class'=>'form-control',
                                'id'=>'bname',
                                'name'=>'bname')) !!}
                  </div>
                </div>
              </br>

	       <div class="row">
		<div class="col-md-1">
                </div>
		<div class="col-md-5">  
                  {!! Form::label('Bank Address') !!}
                  {!! Form::textarea('baddress', $emp->AJV_EMP_BankAddress, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'bank address')) !!}
                  </div>
		<div class="col-md-5">
                   {!! Form::label('IFSC Code') !!}  
                   {!! Form::text('ifsc', $emp->AJV_EMP_IFSCCode,
                           array('class'=>'form-control',
                                'id'=>'ifsc',
                                'name'=>'ifsc')) !!}
                  </div>
                </div>
              </br>
	       <div class="row">
		<div class="col-md-1">
                </div>
		   <div class="col-md-1">
                            {!! Form::submit('Save', 
                              array('class'=>'btn btn-primary','id' => 'submit')) !!}
                     {{ Form::close() }}
                   </div>
	       </div>
                  </br>

	</div>


</div>

<script type="text/javascript"> 

   $('#dob').datepicker({
     dateFormat: 'yy-mm-dd',
     minDate: "-60y",
     yearRange: "-60:-10",
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

  $('#joinDate').datepicker({
     dateFormat: 'yy-mm-dd',
     minDate: "-20y",
     yearRange: "-20:-0",
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