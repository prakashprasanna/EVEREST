@extends('layouts.master')
@section('page-title', 'Approvals')
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

        <div class="container">
            <div class="row">
               <table class=buttons>
                 <tr>
                  <td><a href="{{ url('dashboard') }}"><button type="button"><B>DASHBOARD</B></button></a>
                  <td><a href="{{ url('leadApprovals') }}"><button type="button"><B>APPROVALS</B></button></a>
                  <td><a href="https://docs.google.com/spreadsheets/d/14_5ZwJ9HLZEJ6PUxtHWWZoRvKT0OCjCmTGoRQ8Wqhag/edit" target="_blank"><button type="button"><B>KNOWLEDGE BASE</B></button>
                  <td><a href="{{ url('enquiry') }}" target="_blank"><button type="button"><B>Add Enquiry</B></button></a>
                  <td><button type="button"><B>IMPROVE EVEREST</B></button>
                 </tr>
               </table> 
                <div class="board">
                    <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                    <div class="board-inner">
                    <ul class="nav nav-tabs" id="myTab">
                    <div class="liner"></div>
                     <li class="active">
                     <a href="#Drop" data-toggle="tab" title="Drop Approvals">
                      <span class="round-tabs one">
                              <i class="glyphicon glyphicon-stats"></i>
                      </span> 
                  </a></li>

                  <li><a href="#approval" data-toggle="tab" title="App Approvals">
                     <span class="round-tabs two">
                         <i class="glyphicon glyphicon-user"></i>
                     </span> 
                   </a>
                 </li>
                    
                     </ul>
                   </div>

                     <div class="tab-content">
                      <div class="tab-pane fade in active" id="Drop">
                 <?php 
                  $user = Auth::user();
                  $dep = App\sales_leads::where('sales_lead_email','=',$user->email)->first();    
                  $emp = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();
                  $empDL = App\gef_DL::where('gef_assigned_to', '=', $user->email)->where('gef_salesApproval', '=', 'Drop Pending')->get();
                  $empAL = App\gef_DL::where('gef_assigned_to', '=', $user->email)->where('gef_salesApproval', '=', 'Approval Pending')->get();  
                      
                 ?>
                 @if($dep != null) 

                          <!-- Start of Reviews tab -->
                             <h1>Drop Approvals</h1>   
                @if(!$reviews->isEmpty())

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
                      <td>{{ $retrive->gef_nationality }}</td>
                      <td>{{ $retrive->gef_country  }}</td>
                      <td>{{ $retrive->gef_assigned_to }}</td>
                                                                <td>  
                              {!! Form::model($retrive, ['method' => 'GET','route' => ['leadView', $retrive->gef_phone]]) !!}
                  {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                                                            {{ Form::close() }}                  
                </td> 
                    </tr>
                @endforeach 
            </tbody>
          </table>

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
</br>
</br>
</br>
</br>
</br>

                <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; There are no leads in Drop Pending Status</h3> 
              @endif
        </div>

       
<!--  end of Reviews tab -->
                      <!-- Start of Approvals Tab -->
                      <div class="tab-pane fade" id="approval">

                                                     <h1>App Approvals</h1>   
                @if(!$approvals->isEmpty())
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
                      <td>{{ $retrive2->gef_nationality }}</td>
                      <td>{{ $retrive2->gef_country }}</td>
                      <td>{{ $retrive2->gef_assigned_to }}</td>
                                                                <td>  
                              {!! Form::model($retrive2, ['method' => 'GET','route' => ['leadView', $retrive2->gef_phone]]) !!}
                  {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                                                            {{ Form::close() }}                  
                </td> 
                    </tr>
                @endforeach 
            </tbody>
          </table>
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
</br>
</br>
</br>
</br>
</br>

                <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; There are no leads in Approval pending status</h3> 
              @endif
                          
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

                          <!-- Start of Reviews tab -->
                             <h1>Drop Approvals</h1>  
                @if(!$empDL->isEmpty())
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
                          @foreach ($empDL as $empdl)
                    <tr>
                      <td>{{ $empdl->gef_f_name }}</td>
                      <td>{{ $empdl->gef_l_name }}</td>
                      <td>{{ $empdl->gef_phone }}</td>
                      <td>{{ $empdl->gef_nationality }}</td>
                      <td>{{ $empdl->gef_country }}</td>
                      <td>{{ $empdl->gef_assigned_to }}</td>
                                                                <td>  
                              {!! Form::model($empdl, ['method' => 'GET','route' => ['leadView', $empdl->gef_phone]]) !!}
                  {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                                                            {{ Form::close() }}                  
                </td> 
                    </tr>
                @endforeach 
               </tbody>

             </table>

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
</br>
</br>
</br>
</br>
</br>

                <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; None of your leads are in Drop Pending status</h3> 
              @endif
        </div>

       
<!--  end of Reviews tab -->
                      <!-- Start of Approvals Tab -->
                      <div class="tab-pane fade" id="approval">

                                                     <h1>App Approvals</h1>   
                @if(!$empAL->isEmpty())

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
                          @foreach ($empAL as $empal)
                    <tr>
                      <td>{{ $empal->gef_f_name }}</td>
                      <td>{{ $empal->gef_l_name }}</td>
                      <td>{{ $empal->gef_phone }}</td>
                      <td>{{ $empal->gef_nationality }}</td>
                      <td>{{ $empal->gef_country }}</td>
                      <td>{{ $empal->gef_assigned_to }}</td>
                                                                <td>  
                              {!! Form::model($empal, ['method' => 'GET','route' => ['leadView', $empal->gef_phone]]) !!}
                  {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                                                            {{ Form::close() }}                  
                </td> 
                    </tr>
                @endforeach 
              </tbody>
            </table>
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
</br>
</br>
</br>
</br>
</br>

                <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; None of your leads are in Approval Pending status</h3> 
              @endif
                          
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
