@extends('layouts.master')
@section('page-title', 'App Approvals')
@section('page-content')
<br>
<br>
<br>
<br>
@if(auth()->check())
<div class="container">
	<div class="row">
		<div class="col-md-12">
<div class="container">
	<div class="row">
		<div class="col-md-12">
            <div class="input-group" id="adv-search">
                <input type="text" class="form-control" placeholder="Search EVEREST" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
          </div>
        </div>
	</div>

<br>
<br>

<section style="background:#efefe9;">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/user_tabs.css') }}" />

        <div class="container">
            <div class="row">
               <table class=buttons>
                 <tr>
                  <td><a href="{{ url('servicedashboard') }}"><button type="button"><B>DASHBOARD</B></button></a>
                  <td><a href="{{ url('appApprovals') }}"><button type="button"><B>APPROVALS</B></button></a>
                  <td><a href="https://docs.google.com/spreadsheets/d/14_5ZwJ9HLZEJ6PUxtHWWZoRvKT0OCjCmTGoRQ8Wqhag/edit" target="_blank"><button type="button"><B>KNOWLEDGE BASE</B></button>
                  <td><button type="button"><B>DAILY TOOLS</B></button>
                  <td><button type="button"><B>IMPROVE EVEREST</B></button>
                 </tr>
               </table> 
                <div class="board">
                    <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                    <div class="board-inner">
                    <ul class="nav nav-tabs" id="myTab">
                    <div class="liner"></div>
                     <li class="active">
                     <a href="#review" data-toggle="tab" title="Reviews">
                      <span class="round-tabs one">
                              <i class="glyphicon glyphicon-stats"></i>
                      </span> 
                  </a></li>

                  <li><a href="#approval" data-toggle="tab" title="Approvals">
                     <span class="round-tabs two">
                         <i class="glyphicon glyphicon-user"></i>
                     </span> 
                   </a>
                 </li>
                    
                     </ul>
                   </div>

                     <div class="tab-content">
                      <div class="tab-pane fade in active" id="review">
                 <?php 
                  $user = Auth::user();
                  $dep = App\sales_leads::where('sales_lead_email','=',$user->email)->first();                          
                 ?>
                 @if($dep != null) 

                          <!-- Start of Reviews tab -->
                             <h1>Reviews Pending</h1>   
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
                  <tbody>
                          @foreach ($reviews as $retrive)
                    <tr>
                      <td>{{ $retrive->gef_f_name }}</td>
                      <td>{{ $retrive->gef_l_name }}</td>
                      <td>{{ $retrive->gef_phone }}</td>
                      <td>{{ $retrive->nationality->nationality }}</td>
                      <td>{{ $retrive->country->country }}</td>
                      <?php $emp  = App\employee::where('AJV_EMP_Email','=',$retrive2->gef_service_assigned_to)->first();
	              ?>
                      <td>{{ $emp->AJV_EMP_Fname }} {{ $emp->AJV_EMP_Lname }}</td>
                  <td>  
                              {!! Form::model($retrive, ['method' => 'GET','route' => ['serviceView', $retrive->gef_phone]]) !!}
                  {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                                                            {{ Form::close() }}                  
                </td> 
                    </tr>
                @endforeach 
            </tbody>
          </table>
        </div>

       
<!--  end of Reviews tab -->
                      <!-- Start of Approvals Tab -->
                      <div class="tab-pane fade" id="approval">

                                                     <h1>Approvals Pending</h1>   
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
                  <tbody>
                          @foreach ($approvals as $retrive2)
                    <tr>
                      <td>{{ $retrive2->gef_f_name }}</td>
                      <td>{{ $retrive2->gef_l_name }}</td>
                      <td>{{ $retrive2->gef_phone }}</td>
                      <td>{{ $retrive2->nationality->nationality }}</td>
                      <td>{{ $retrive2->country->country }}</td>
                      <?php $emp  = App\employee::where('AJV_EMP_Email','=',$retrive2->gef_service_assigned_to)->first();
	              ?>
                      <td>{{ $emp->AJV_EMP_Fname }} {{ $emp->AJV_EMP_Lname }}</td>
                      <td>  
                              {!! Form::model($retrive2, ['method' => 'GET','route' => ['serviceView', $retrive2->gef_phone]]) !!}
                  {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                                                            {{ Form::close() }}                  
                </td> 
                    </tr>
                @endforeach 
            </tbody>
          </table>
                          
                      </div>
                     <!--  End of Approvals Tab-->

<div class="clearfix"></div>
</div>

</div>
</div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{asset('/public/js/summaryAjax.js')}}"></script>

</section>
@else

 <div class="row">
   <div class="col-md-7">    
      <ul class="list-inline pull-right">
          <img src={{ asset("/public/images/noAccess.jpg") }} alt="ajv" style="height:280px;">
      </ul>                          
   </div> 
 </div>  
     
<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Only Team Leaders have access to this page<h3>

@endif
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
