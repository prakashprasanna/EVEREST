@extends('layouts.master')
@section('page-title', 'Lead Upload')
@section('page-content')

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
<div class="container">

</br>
        <h2 class="text-center">
            Upload Leads
        </h2>

        @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
    @endif

    @if ( Session::has('error') )
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>{{ Session::get('error') }}</strong>
    </div>
    @endif

    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      <div>
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
</div>
@endif

<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    Choose your xls File : <input type="file" name="file" class="form-control">

    <input type="submit" class="btn btn-primary btn-lg" style="margin-top: 3%">
</form>

</br>

    @if ( Session::has('error1') )
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>{{ Session::get('error1') }}</strong>
    </div>
    @endif
<!--

        <h4 class="text-center">
            FB Leads with phone uploaded
        </h4>
                         <table id="keywords" cellspacing="0" cellpadding="0">
                  <thead>
                    <tr>
                      <th><span>Name</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
 
-->


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

<section style="background:#efefe9;">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/user_tabs.css') }}" />


    <!-- Styles -->
    <style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
        padding: 5%
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
