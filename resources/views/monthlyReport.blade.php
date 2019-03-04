@extends('layouts.master')
@section('page-title', 'SALES MONTHLY REPORT')
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
            Sales Advisors Monthly Report
        </h2>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">KORU 1 {{ $cMonth->format('F') }} REPORT</div>

                <div class="panel-body">
                    {!! $koru1Chart->html() !!}
                </div>
            </div>
        </div>
{!! Charts::scripts() !!}
{!! $koru1Chart->script() !!}
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">KORU 2 {{ $cMonth->format('F') }} REPORT</div>

                <div class="panel-body">
                    {!! $koru2Chart->html() !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $koru2Chart->script() !!}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $cMonth->format('F') }} COMPETITIVE REPORT</div>

                <div class="panel-body">
                    {!! $koruChart->html() !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $koruChart->script() !!}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $cMonth->format('F') }} REPORT</div>

                <div class="panel-body">
                    {!! $chart->html() !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}



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