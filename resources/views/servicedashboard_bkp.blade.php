@extends('layouts.master')
@section('page-title', 'Service Dashboard')
@section('page-content')

<br>
<br>
<br>
<br>
@if(auth()->check())
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
                     <a href="#home" data-toggle="tab" title="Summary">
                      <span class="round-tabs one">
                              <i class="glyphicon glyphicon-stats"></i>
                      </span> 
                  </a></li>

                  <li><a href="#profile" data-toggle="tab" title="New Apps">
                     <span class="round-tabs two">
                         <i class="glyphicon glyphicon-user"></i>
                     </span> 
           </a>
                 </li>
                 <li><a href="#messages" data-toggle="tab" title="In Progress">
                     <span class="round-tabs three">
                          <i class="glyphicon glyphicon-refresh"></i>
                     </span> </a>
                     </li>

                     <li><a href="#settings" data-toggle="tab" title="Accepted">
                         <span class="round-tabs one">
                              <i class="glyphicon glyphicon-thumbs-up"></i>
                         </span> 
                     </a></li>

                     <li><a href="#doner" data-toggle="tab" title="Dropped">
                         <span class="round-tabs four">
                              <i class="glyphicon glyphicon-thumbs-down"></i>
                         </span> </a>
                     </li>
                     
                     </ul></div>

                     <div class="tab-content">
                      <div class="tab-pane fade in active" id="home">

                          <!-- Start of summary tab -->
                             <h1>Summary of Apps Assigned</h1>   
      <table class="tablesorter" id="keywords" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
              <th><span>Advisor Name</span></th>
              <th><span>Monthly Target</span></th>
              <th><span>Assigned</span></th>
              <th><span>Completed</span></th>
          </tr>
         </thead>
         <tbody id="products-list" name="products-list">
           @foreach ($gefData3 as $retrive3)
            <tr id="product{{$retrive3->AJV_EMP_ID}}">
             <td>{{ $retrive3->AJV_EMP_Fname }} {{ $retrive3->AJV_EMP_Lname }}</td>
             <td>{{ $retrive3->AJV_EMP_MonthlyTarget }}</td>       
             <td>{{ $retrive3->AJV_EMP_workAssigned }}</td>        
             <td>{{ $retrive3->AJV_EMP_workCompleted }}</td>   
            </tr>
            @endforeach
        </tbody>
        </table>
          
        </div>

       <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Set Target</h4>
            </div>
            <div class="modal-body">
            <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                <div class="form-group error">
                 <label for="inputName" class="col-sm-3 control-label">Target</label>
                   <div class="col-sm-9">
                    <input type="text" class="form-control has-error" id="AJV_EMP_MonthlyTarget" name="AJV_EMP_MonthlyTarget" placeholder="Target" value="">
                   </div>
                   </div>
                   <div class="form-group">
                 <label for="inputDetail" class="col-sm-3 control-label">Assigned</label>
                    <div class="col-sm-9">
                   <input type="text" class="form-control" id="AJV_EMP_workAssigned" name="AJV_EMP_workAssigned" placeholder="Assigned" value="">
                    </div>
                </div>
                 <div class="form-group">
                 <label for="inputDetail1" class="col-sm-3 control-label">Completed</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="AJV_EMP_workCompleted" name="AJV_EMP_workCompleted" placeholder="Completed" value="">
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
            <input type="hidden" id="product_id" name="product_id" value="0">
            </div>
        </div>
      </div>
  </div>
            
<!--  end of summary tab -->
                      <!-- Start of New Leads Tab -->
                      <script src="{{asset('/public/js/pagination.js')}}"></script>

                      <div class="tab-pane fade" id="profile">
                          <h1>New Apps</h1>    
                        <div id="newApps-lists">
                            @include('newApps')
                        </div>
                          
                      </div>
                         
                          
                     <!--  End of New Leads Tab
                      Start of In Progress tab -->
                      <div class="tab-pane fade" id="messages">
                          <h1>Apps In Progress</h1>
                      <div id="inProgress-lists">
                          @include('inProgress')
                      </div>     
                          
                      </div>
                      <!-- End of In progress tab
                      Start of Accepted tab -->
                      <div class="tab-pane fade" id="settings">
                          <h1>Apps Accepted</h1>
                      <div id="accepted-lists">
                          @include('accepted')
                      </div>
                          
                      </div>

                     <!--  End of Accepted tab
                      Start of Dropped tab -->
                  <div class="tab-pane fade" id="doner">
                    <div class="text-center">
                     <i class="img-intro icon-checkmark-circle"></i>
                   </div>
                   <h1>Apps Dropped</h1>
                      <div id="dropped-lists">
                          @include('dropped')
                      </div>

                 </div>
          <!-- End of Dropped tab -->
<div class="clearfix"></div>
</div>

</div>
</div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{asset('/public/js/summaryAjax.js')}}"></script>
<script src="{{asset('/public/js/tabScript.js')}}"></script>

</section>
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
