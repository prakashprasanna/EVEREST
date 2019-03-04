@extends('layouts.master')
@section('page-title', 'Dashboard')
@section('page-content')
<br>
<br>
<br>
<br>
<script type="text/javascript">
   setTimeout(function(){
       location.reload();
   },720000);
</script>

<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/empLogin.css') }}" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
 <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
 <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">

@if(auth()->check())
<div class="container">

	<div class="row">
	  <div class="col-md-11">
            <div class="container">
	       <div class="row">
		<div class="col-md-11">
                   {!! Form::open(array('method' => 'GET','route' => 'searchLead', 'target' => '_blank')) !!}        
                   {!! Form::text('search', null,
                           array('required',
                                'class'=>'form-control',
                                'placeholder'=>'Enter a Name or mobile or email or FB id to search in EVEREST.....')) !!}
                  </div>
		   <div class="col-md-1">
                     {{Form::button('Search', array('type' => 'submit', 'class' => 'btn btn-success'))}}
                     {{ Form::close() }}
                   </div>
	     </div>
            </div>
          </div>
	</div>


<section style="background:#efefe9;">

    <noscript id="deferred-styles">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/user_tabs.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/animation.css') }}" />
    </noscript>

    <script>
      var loadDeferredStyles = function() {
        var addStylesNode = document.getElementById("deferred-styles");
        var replacement = document.createElement("div");
        replacement.innerHTML = addStylesNode.textContent;
        document.body.appendChild(replacement)
        addStylesNode.parentElement.removeChild(addStylesNode);
      };
      var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
          window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
      if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
      else window.addEventListener('load', loadDeferredStyles);
    </script>


        <div class="container">

            <div class="row">

                <div class="board">
               <table class=buttons>
                 <tr>
                  <td><a href="{{ url('dashboard') }}"><button type="button"><B>DASHBOARD</B></button></a></td>
                  <td><a href="{{ url('leadApprovals') }}"><button type="button"><B>APPROVALS</B></button></a></td>
                  <td><a href="https://docs.google.com/spreadsheets/d/14_5ZwJ9HLZEJ6PUxtHWWZoRvKT0OCjCmTGoRQ8Wqhag/edit" target="_blank"><button type="button"><B>KNOWLEDGE BASE</B></button></a></td>
                  <td><a href="{{ url('uploadLead') }}"><button type="button"><B>LEAD UPLOAD</B></button></a></td>
                  <td><a href="{{ url('enquiry') }}" target="_blank"><button type="button"><B>ADD ENQUIRY</B></button></a>
                  <td><button type="button"><B>LEAVE REQUEST</B></button></td>
                 </tr>
               </table> 
                    <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                    <div class="board-inner">
                    <ul class="nav nav-tabs" id="myTab">
                    <div class="liner"></div>


                     @if($emp->dash_tab === "#summary" || $emp->dash_tab === null )
                         <li class="active">
                     @else
                         <li>   
                     @endif
                     <a href="#home" data-toggle="tab" id="summary" title="Performance Summary" class="ajaxLink">
                      <span class="round-tabs one">
                              <i class="glyphicon glyphicon-stats"></i>
                      </span>                          
                     </a></li>

                     @if($emp->dash_tab === "#newApps")
                         <li class="active">
                     @else
                         <li>   
                     @endif              
                    <a href="#profile" data-toggle="tab" id="newApps" title="New Leads" class="ajaxLink">
                     <span class="round-tabs two">
                         <i class="glyphicon glyphicon-user"></i>
                     </span><span class="badge">{{ $NLC }}</span> 

                    </a>
                 </li>
                     @if($emp->dash_tab === "#inProgress")
                         <li class="active">
                     @else
                         <li>   
                     @endif                    
                     <a href="#messages" data-toggle="tab" id="inProgress" title="Leads In Progress" class="ajaxLink">
                     <span class="round-tabs three">
                          <i class="glyphicon glyphicon-refresh"></i>
                     </span><span class="badge">{{ $IP }}</span>
                      
                     </a>
                     </li>
                     @if($emp->dash_tab === "#accepted")
                         <li class="active">
                     @else
                         <li>   
                     @endif                       
                     <a href="#settings" data-toggle="tab" id="accepted" title="Sent to Service" class="ajaxLink">
                         <span class="round-tabs one">
                              <i class="glyphicon glyphicon-thumbs-up"></i>
                         </span><span class="badge">{{ $AC }}</span> 
                     </a></li>


                     </ul></div>


    <script>
$('.ajaxLink').click(function (e) {
  location.hash = this.id; // get the clicked link id
  var x = location.hash;
  e.preventDefault(); // cancel navigation
$.get('dashTab',{ value : x }, function(response) {
    // handle your response here
    console.log(response);
})
})
    </script>

                     <div class="tab-content">

                     @if($emp->dash_tab === "#summary" || $emp->dash_tab === null )
                         <div class="tab-pane fade in active" id="home">
                     @else
                         <div class="tab-pane fade" id="home">   
                     @endif                      

                          <!-- Start of summary tab -->
                   <div class="row"> 
                   <div class="col-md-1">
                   </div>
                    <div class="col-md-6">
                   
                    </div>
                   </div>    
                  </br>           
                  <div class="row"> 
                   <div class="col-md-1">
                   </div>
                   <div class="col-md-3">

        </div>
                   <div class="col-md-3">

        </div>
                   <div class="col-md-3">
                    <div class="form-group">
                     <h2 class="text-center">
                         <u>Performance Reports</u>
                    </h2>
                 </br>
                             @include('salesSummary')
                    </div>
                    </div>

                  </div>
	                </div>		      
                      <!--  end of summary tab -->
                      <!-- Start of New Leads Tab -->

                     @if($emp->dash_tab === "#newApps")
                         <div class="tab-pane fade in active" id="profile">
                     @else
                         <div class="tab-pane fade" id="profile">   
                     @endif
  
                          <h1>New Leads</h1>  

        @if($dep != null || $emp->AJV_EMP_Lead === null) 
             <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                </div>
             </div>
              <div class="col-md-2">
                <div class="form-group">
             {!! Form::open(array('method' => 'GET','route' => 'dashboard')) !!}       
           @if($dep != null)
            {!! Form::select('adviser', $LemployeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control','required' => '']) !!} 
           @else
            @if($emp->AJV_DEP_ID === '1' || '9')
               {!! Form::select('adviser', $MemployeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control','required' => '']) !!} 
            @endif
           @endif
                </div>
             </div>      
            <div class="col-md-2">
             <div class="form-group">
            <input name="tab" value="#newApps" type="hidden">
              {{ Form::submit('Adviser Filter', ['class' => 'btn btn-success']) }}
              {{ Form::close() }}
             </div>
            </div>
              <div class="col-md-1">
                <div class="form-group">
                      {!! Form::label('Filter Count') !!}<br>

                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                      {!! Form::label('count', $newLeadsCount, 
                          array('class'=>'form-control')) !!}
                </div>
              </div>
           </div>  

             <div class="row">
              <div class="col-md-7">
                <div class="form-group">
                    <button style="margin-bottom: 10px" class="btn btn-primary assign_all" data-url="{{ url('dashboard') }}">Assign All Selected</button> 
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select no of rows :
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">

            <form class="NL-row-form" method="patch">
{{ Form::select('NLrows', ['25' => '25',
                                   '50' => '50', 
                                   '75' => '75',
                                   '100' => '100',
                                   '150' => '150',
                                   '200' => '200'], null, ['placeholder' => 'Select', 'class' => 'form-control','id' => 'NLrows','name'=>'NLrows']) }}</form>
    <script src="{{asset('/public/js/sales_NL_row.js')}}"></script>

                </div>
                </div>
             </div>
       @endif


                    <div id="newApps-lists">
                            @include('newApps1')
                    </div>
                          
                      </div>
                         
                          
                     <!--  End of New Leads Tab
                      Start of In Progress tab -->
                     @if($emp->dash_tab === "#inProgress")
                         <div class="tab-pane fade in active" id="messages">
                     @else
                         <div class="tab-pane fade" id="messages">   
                     @endif
                          <h1>Leads In Progress</h1>

             <div class="row">
              <div class="col-md-1">
                <div class="form-group">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
        @if($dep != null || $emp->AJV_EMP_Lead === null) 
           <button style="margin-bottom: 10px" class="btn btn-primary assign1_all" data-url="{{ url('dashboard') }}">Assign All Selected</button> 


        @endif
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
        @if($dep != null || $emp->AJV_EMP_Lead === null) 
             {!! Form::open(array('method' => 'GET','route' => 'dashboard')) !!}       
           @if($dep != null)
            {!! Form::select('adviser', $LemployeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control','required' => '']) !!} 
           @else
            @if($emp->AJV_DEP_ID === '1' || '9')
               {!! Form::select('adviser', $MemployeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control','required' => '']) !!} 
            @endif
           @endif
        @else
             {!! Form::open(array('method' => 'GET','route' => 'dashboard')) !!}       
                 @endif
                </div>
             </div>   
              <div class="col-md-2">
                <div class="form-group">
                   {{ Form::select('filter', [
                                   'Docs Pending' => 'Docs Pending',
                                   'STA-JFM19' => 'STA-JFM19',
                                   'STA-AMJ19' => 'STA-AMJ19', 
                                   'STA-JAS19' => 'STA-JAS19',
                                   'STA-OND19' => 'STA-OND19',
                                   'STA-JFM20' => 'STA-JFM20',
                                   'BEYOND' => 'BEYOND',
                                   'Onshore Lead' => 'Onshore Lead',
                                   'Hot' => 'Hot', 'All' => 'All',], null, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '']
                    ) }}        
                </div>
             </div>   
            <div class="col-md-2">
             <div class="form-group">
            <input name="tab" value="#inProgress" type="hidden">
              {{ Form::submit('Status Filter', ['class' => 'btn btn-success']) }}
              {{ Form::close() }}
             </div>
            </div>
              <div class="col-md-1">
                <div class="form-group">
                      {!! Form::label('Filter Count') !!}<br>

                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                      {!! Form::label('count', $inProgressCount, 
                          array('class'=>'form-control')) !!}
                </div>
              </div>
           </div>               


                      <div id="inProgress-lists">
                          @include('inProgress')
                      </div>     
                          
                      </div>
                      <!-- End of In progress tab -->
                      <!--Start of Accepted tab -->

                     @if($emp->dash_tab === "#accepted")
                         <div class="tab-pane fade in active" id="settings">
                     @else
                         <div class="tab-pane fade" id="settings">   
                     @endif
                          <h1>Sent to Service</h1>

        @if($dep != null || $emp->AJV_EMP_Lead === null) 
             <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                </div>
             </div>
              <div class="col-md-2">
                <div class="form-group">
             {!! Form::open(array('method' => 'GET','route' => 'dashboard')) !!}       
           @if($dep != null)
            {!! Form::select('adviser', $LemployeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control','required' => '']) !!} 
           @else
            @if($emp->AJV_DEP_ID === '1' || '9')
               {!! Form::select('adviser', $MemployeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control','required' => '']) !!} 
            @endif
           @endif 
                </div>
             </div>      
            <div class="col-md-2">
             <div class="form-group">
            <input name="tab" value="#accepted" type="hidden">
              {{ Form::submit('Adviser Filter', ['class' => 'btn btn-success']) }}
              {{ Form::close() }}
             </div>
            </div>
              <div class="col-md-1">
                <div class="form-group">
                      {!! Form::label('Filter Count') !!}<br>

                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                      {!! Form::label('count', $acceptedCount, 
                          array('class'=>'form-control')) !!}
                </div>
              </div>
           </div> 
      @endif

                      <div id="accepted-lists">
                          @include('accepted')
                      </div>
                          
                      </div>

                     <!--  End of Accepted tab-->

<div class="clearfix"></div>
</div>
</div>
</div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
</section>


                       <!--  Assign MODAL -->
                          <div class="modal fade" id="myassign" tabindex="-1" role="dialog" aria-labelledby="myassignLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myassignLabel">Assign to Advisors or TL </h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                 <div class="form-group">
                                @if($dep != null || $emp->AJV_EMP_Lead === null) 
                                  <label for="inputDetail" class="col-sm-3 control-label">Assign To</label>
                                    <div class="col-sm-9">
           @if($dep != null)
            {!! Form::select('adviser', $LemployeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control','id' => 'adviser']) !!}</br>
{!! Form::label('or') !!}</br> </br>
            {!! Form::select('adviser', $leads, 0, ['placeholder' => 'Select TL','class' => 'form-control','id' => 'adviser3']) !!}</br>
           @else
            @if($emp->AJV_DEP_ID === '1' || '9')
               {!! Form::select('adviser', $MemployeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control','id' => 'adviser','required' => '']) !!} 
            @endif
           @endif            
                                        </div>
                                    </div>                                    
                                   </form>
                                  </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-assign" value="add">Assign</button>
                                        <input type="hidden" id="assign_id" name="assign_id" value="0">
                                    </div>
                               @endif
                              </div>
                            </div>
                          </div>

                       <!--  In Progress Assign MODAL -->
                          <div class="modal fade" id="myassign1" tabindex="-1" role="dialog" aria-labelledby="myassignLabel1" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myassignLabel1">Assign to Advisors or TL</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts1" name="frmProducts1" class="form-horizontal" novalidate="">
                                 <div class="form-group">
                                @if($dep != null || $emp->AJV_EMP_Lead === null) 
                                  <label for="inputDetail" class="col-sm-3 control-label">Assign To</label>
                                    <div class="col-sm-9">
           @if($dep != null)
            {!! Form::select('adviser', $LemployeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control','id' => 'adviser1']) !!}</br>
{!! Form::label('or') !!}</br> </br>
            {!! Form::select('adviser', $leads, 0, ['placeholder' => 'Select TL','class' => 'form-control','id' => 'adviser4']) !!}</br>
           @else
            @if($emp->AJV_DEP_ID === '1' || '9')
               {!! Form::select('adviser', $MemployeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control','id' => 'adviser1','required' => '']) !!} 
            @endif
           @endif            
                                        </div>
                                    </div>                                    
                                   </form>
                                  </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-assign1" value="add">Assign</button>
                                        <input type="hidden" id="assign1_id" name="assign1_id" value="0">
                                    </div>
                               @endif
                              </div>
                            </div>
                          </div>

                       <!--  Dropped Assign MODAL -->
                          <div class="modal fade" id="myassign2" tabindex="-1" role="dialog" aria-labelledby="myassignLabel2" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myassignLabel2">Assign to Advisors or TL</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts2" name="frmProducts2" class="form-horizontal" novalidate="">
                                 <div class="form-group">
                                @if($dep != null || $emp->AJV_EMP_Lead === null) 
                                  <label for="inputDetail" class="col-sm-3 control-label">Assign To</label>
                                    <div class="col-sm-9">
           @if($dep != null)
            {!! Form::select('adviser', $LemployeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control','id' => 'adviser2']) !!}</br>
{!! Form::label('or') !!}</br> </br>
            {!! Form::select('adviser', $leads, 0, ['placeholder' => 'Select TL','class' => 'form-control','id' => 'adviser5']) !!}</br> 
           @else
            @if($emp->AJV_DEP_ID === '1' || '9')
               {!! Form::select('adviser', $MemployeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control','id' => 'adviser2','required' => '']) !!} 
            @endif
           @endif            
                                        </div>
                                    </div>                                    
                                   </form>
                                  </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-assign2" value="add">Assign</button>
                                        <input type="hidden" id="assign2_id" name="assign2_id" value="0">
                                    </div>
                               @endif
                              </div>
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
