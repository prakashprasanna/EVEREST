@extends('layouts.master')

@section('page-title', 'Sales')
@section('page-content')
<br>ts
<br>
<br>
<br>
@if(auth()->check())
<div class="container center_div">
<?php 
  $user = Auth::user();
  $emp_loggedin = App\employee::where('AJV_EMP_Email','=',$user->email)->first(); 
?> 
<link rel="stylesheet" type="text/css" href="{{ url('/public/css/user_tabs1.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/public/css/sales_user_tabs.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/public/css/comments.css') }}" />
<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
 <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
 <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
 <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>


              <div class="row">
               <table class=buttons>
                 <tr>
                  <td><a href="{{ url('dashboard') }}"><button type="button"><B>DASHBOARD</B></button></a>
                  <td><a href="{{ url('leadApprovals') }}"><button type="button"><B>APPROVALS</B></button></a>
                  <td><a href="https://docs.google.com/spreadsheets/d/14_5ZwJ9HLZEJ6PUxtHWWZoRvKT0OCjCmTGoRQ8Wqhag/edit" target="_blank"><button type="button"><B>KNOWLEDGE BASE</B></button>
                  <td><a href="{{ url('enquiry') }}" target="_blank"><button type="button"><B>ADD ENQUIRY</B></button></a>
                  <td><button type="button"><B>IMPROVE EVEREST</B></button>
                 </tr>
               </table>         
                <div class="board">
                    <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                    <div class="board-inner">
                    <ul class="nav nav-tabs" id="myTab">
                    <div class="liner_leadView"></div>
                   @if($gef->tab === null)
                     <li class="active">
                   @else
                     <li>
                   @endif
                     <a href="#Enquiry" data-toggle="tab" title="Lead Details">
                      <span class="round-tabs one">
                              <i class="glyphicon glyphicon-user"></i>
                      </span> 
                  </a></li>

                   @if($gef->tab != null)
                     <li class="active">
                   @else
                     <li>
                   @endif
                    <a href="#profile" data-toggle="tab" title="Sales Process">
                     <span class="round-tabs two">
                         <i class="glyphicon glyphicon-phone-alt"></i>
                     </span> 
                 </a>
                 </li>
                 <li><a href="#messages" data-toggle="tab" title="Service Process">
                     <span class="round-tabs three">
                          <i class="glyphicon glyphicon-plane"></i>
                     </span> </a>
                     </li>
                     
                     </ul>
                   </div>

                <div class="tab-content">
               @if($gef->tab === null)
                <div class="tab-pane fade in active" id="Enquiry">
               @else
                <div class="tab-pane fade" id="Enquiry">
               @endif
                <!-- Start of enquiry tab -->
                           <h1>Lead Details</h1>
<br>
@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif   

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif            
   
                <div class="Container center">
                   {!! Form::open(array( 'class' => 'form-line', 'files' => true)) !!}
                 <div class="center_b"> 
                  <div class="row"> 
                   <div class="col-md-10">
                    <div class="form-group">
                      {!! Form::label('First Name') !!}
                      {!! Form::label('FN', $gef->gef_f_name, 
                          array('class'=>'form-control')) !!}
                    </div>
                    </div>
                   </div>
 
                  <div class="row"> 
                   <div class="col-md-10">
                   <div class="form-group">
                      {!! Form::label('Last Name') !!}
                      {!! Form::label('LN', $gef->gef_l_name, 
                          array('class'=>'form-control')) !!}
                  </div>
                    </div>
                   </div> 

                  <div class="row"> 
                   <div class="col-md-10">
                    <div class="form-group">
                      {!! Form::label('Phone') !!}<br>
                      {!! Form::label('phone', $gef->gef_phone, 
                          array('class'=>'form-control', 'id'=>'phone5')) !!}
                    </div>
                   </div> 
                 </div> 

                  <div class="row"> 
                   <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('Alternate Phone') !!} <font color="red">(editable)</font><br>
                             <table>
                               <tbody id="_editable_table">
                                   <tr mChecks-id="{{ $gef->gef_phone }}">
                                 <div class="content">
                                   <td class="editable-col" contenteditable="true" id="td" col-index="0" oldVal ="{{ $gef->gef_altPhone }}">{{ $gef->gef_altPhone }}</td>
                                  </div>
                                   </tr>
                              </tbody>
                             </table> 
                    </div>
                   </div> 
                 </div> 


                  <div class="row"> 
                   <div class="col-md-10">
                    <div class="form-group">
                      {!! Form::label('Email-Id') !!}<br>
                      {!! Form::label('email', $gef->gef_email, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                  </div> 

                  <div class="row"> 
                   <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('Alternate Email-Id') !!} <font color="red">(editable)</font><br>
                      <table>
                       <tbody id="_editable_table">
                        <tr mChecks-id="{{ $gef->gef_phone }}">
                         <div class="content">
                         <td class="editable-col" contenteditable="true" id="td" col-index="1" oldVal ="{{ $gef->gef_altEmail }}">{{ $gef->gef_altEmail }} 
                         </td>
                        </div>
                     </tr>
                    </tbody>
                   </table> 
                    </div>
                   </div> 
                  </div> 

                  <div class="row"> 
                   <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('Skype-Id') !!} <font color="red">(editable)</font><br>
                   <table>
                    <tbody id="_editable_table">
                     <tr mChecks-id="{{ $gef->gef_phone }}">
                      <div class="content">
                       <td class="editable-col" contenteditable="true" id="td" col-index="2" oldVal ="{{ $gef->gef_skype }}">{{ $gef->gef_skype }} 
                       </td>
                      </div>
                     </tr>
                    </tbody>
                   </table>
                    </div>
                   </div> 
                  </div> 

                  <div class="row"> 
                   <div class="col-md-10">
                    <div class="form-group">
                      {!! Form::label('Nationality') !!}<br>
                      {!! Form::label('nationality', $gef->gef_nationality, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div>
                  </div>  

                  <div class="row"> 
                   <div class="col-md-10">
                    <div class="form-group">
                      {!! Form::label('Location') !!}<br>
                      {!! Form::label('location', $gef->gef_location, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                  </div>  

                  <div class="row"> 
                   <div class="col-md-10">
                    <div class="form-group">
                      {!! Form::label('Destination') !!}<br>
                      {!! Form::label('destination', $gef->gef_destination, 
                          array('class'=>'form-control')) !!}
                   </div>
                  </div>
                 </div>  

                  <div class="row"> 
                   <div class="col-md-10">
                    <div class="form-group">
                      {!! Form::label('Pathway') !!}<br>
                      {!! Form::label('pathway', $gef->gef_pathway, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                 </div> 

                  <div class="row"> 
                   <div class="col-md-10">
                    <div class="form-group">
                      {!! Form::label('Preferred Subject') !!}<br>
                     @if($gef->subject != null)  
                      {!! Form::label('subject', $gef->gef_subject, 
                          array('class'=>'form-control')) !!}
                     @else
                      {!! Form::label('subject', 'need help to decide', 
                          array('class'=>'form-control')) !!}
                     @endif
                    </div>
                   </div> 
                  </div> 

                  <div class="row"> 
                   <div class="col-md-10">
                    <div class="form-group">
                      {!! Form::label('Enquiry Source') !!}<br>
                      {!! Form::label('source', $gef->gef_source, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                  </div> 

                  <div class="row"> 
                   <div class="col-md-10">
                    <div class="form-group">
                      {!! Form::label('Click to view the CV') !!}<br>
                          @if(!empty ($gef->gef_cv))
                              <a href="{!! URL::to( '/public/docs/cv/' . $gef->gef_cv)  !!}"  target="_blank"
                              {!! Form::label('CV', $gef->gef_cv, 
                              array('class'=>'form-control')) !!}</a>
                          @else
                              {!! Form::label('CV', 'No Attachment', 
                              array('class'=>'form-control')) !!}</a>
                          @endif   
                    </div>
                   </div>
                  </div>  

                  <div class="row"> 
                   <div class="col-md-9">
                    <div class="form-group">
                      {!! Form::label('Enquirer Comments') !!}<br>
                      {!! Form::textarea('message', $gef->gef_comments, 
                              array('class'=>'form-control', 'rows'=>'4', 'cols'=>'10', 'readonly' => true)) !!}

                    </div>
                   </div> 
                  </div> 

                 @if($gef->gef_adviser_comments != null)
                  <div class="row"> 
                   <div class="col-md-9">
                    <div class="form-group">
                      {!! Form::label('Adviser Comments') !!}<br>
                      {!! Form::textarea('message', $gef->gef_adviser_comments, 
                              array('class'=>'form-control', 'rows'=>'4', 'cols'=>'10', 'readonly' => true)) !!}

                    </div>
                   </div> 
                  </div>
                 @endif 

                  {!! Form::close() !!}

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
    width: 100%;
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

<script type="text/javascript">
$(document).ready(function(){
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
  $('td.editable-col').on('focusout', function() {
    var mChecks =  "edit/gef/mChecks";
    var mChecks_id = $(this).parent('tr').attr('mChecks-id');
    var my_mChecks = mChecks;
    data = {
            val: $(this).text(),
            id: $(this).parent('tr').attr('mChecks-id'),
            index: $(this).attr('col-index'),}
      if($(this).attr('oldVal') === data['val'])
    return false;
    
    $.ajax({   
          
          type: "PATCH",  
          url: my_mChecks,  
          data: data,
          dataType: "json",       
          success: function(response)  
          {   

          }   
        });
  });
});

</script>
</div>


                 <?php 
                  $user = Auth::user();
                  $dep = App\sales_leads::where('sales_lead_email','=',$user->email)->first();    
                  $empLead = App\employee::where('AJV_EMP_email','=',$user->email)->first();
                  if($gef->gef_prev_status != 'Drop Pending'){
                     $comments2 = App\comments::where('comment_process_phone', '=', $gef->gef_phone)->orderBy('comment_id', 'DESC')->get(); 
                  }                     
                 ?>
              @if($dep === null) 
                @if($gef->gef_salesApproval === 'Dropped')
                 <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('This lead was dropped by') !!}
                      {!! Form::label('dropBy', $empLead->AJV_EMP_Fname . ' ' . $empLead->AJV_EMP_Lname, 
                          array('class'=>'form-control')) !!}
                   </div>
                  </div>
                 </div>

               @endif


                @if($gef->gef_salesApproval === 'Drop Pending')

                 <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('This lead was dropped by') !!}
                      {!! Form::label('dropBy', $empLead->AJV_EMP_Fname . ' ' . $empLead->AJV_EMP_Lname, 
                          array('class'=>'form-control')) !!}

                   </div>
                  </div>
                 </div>

               @endif     
         @endif     

                 @if($dep != null || $empLead->AJV_EMP_Lead === null) 
                   @if($gef->gef_assigned_to === null)
                    <div class="row"> 
                     <div class="col-md-8">
                      <div class="form-group">  
                        {!! Form::model($gef, ['method' => 'PATCH','route' => ['updateAssignTo', $gef->gef_id]]) !!}           
                         {!! Form::label('Comments') !!}
                         {!! Form::textarea('comments', null, 
                         array('required', 
                        'class'=>'form-control', 
                       'placeholder'=>'comments')) !!}
                      </div>
                    </div>
                   </div>
                  <div class="row"> 
                   <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('Assigned To') !!}
                   @if($gef->gef_assigned_to != null)
                    <?php 
                      $emp = App\employee::where('AJV_EMP_Email','=',$gef->gef_assigned_to)->first(); 
                    ?>   
                      {!! Form::label('ass', $emp->AJV_EMP_Fname . ' ' . $emp->AJV_EMP_Lname, 
                          array('class'=>'form-control')) !!}
                   @else
                      {!! Form::label('ass', 'Yet to assign', 
                          array('class'=>'form-control')) !!}
                   @endif    
                    </div>
                   </div>
                   </div>
                  <div class="row"> 
                   <div class="col-md-4">
                    <div class="form-group"> 
                        <?php 
                          if($dep->sales_lead_id != null){
                             $employeeList = App\employee::where('AJV_DEP_ID', '=', '1')->where('AJV_EMP_Lead', '=', $dep->sales_lead_id)->pluck('AJV_EMP_Fname', 'AJV_EMP_Email');
                          } else {
                             $employeeList = App\employee::where('AJV_DEP_ID', '=', '1')->pluck('AJV_EMP_Fname', 'AJV_EMP_Email');
                          } 

                         ?>
                        {!! Form::select('assignTo', $employeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control']) !!} 
                     </div>  
                    </div> 
                   <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::hidden('addedBy', $emp_loggedin->AJV_EMP_Fname . ' ' . $emp_loggedin->AJV_EMP_Lname . ', ' . $emp_loggedin->AJV_EMP_designation) !!}
                        {{ Form::submit('Assign or Re-Assign', ['class' => 'btn btn-warning']) }}
                   </div>
                  </div>  
                 </div>  

               {{ Form::close() }}


                 </br>
                 </br> 

                    <hr>
                    @if(!empty($comments2))
                     @foreach($comments2 as $comment)                    
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{$comment->comment_user}}</strong> {{$comment->comment_time}}</small>
                        </div>    
                        <p>{{$comment->comments}}</p>
                      </div>
                     @endforeach
                    @endif
                    </div>

               @else


                 <?php
                  if($gef->gef_prev_status != 'Drop Pending'){
                   $Comments = App\comments::where('comment_process_phone', '=', $gef->gef_phone)->orderBy('comment_id', 'DESC')->get();
                   $comments1 = App\comments::where('comment_process_id', '=', $gef->gef_id)->where('comment_process_name', '=', 'gef')->orderBy('comment_id', 'DESC')->get();
                  }
                   $user = Auth::user();
                   $dep1 = App\sales_leads::where('sales_lead_email','=',$user->email)->first();                          
                   $emp1 = App\employee::where('AJV_EMP_Email','=',$user->email)->first();                          
                 ?>
                @if($dep1 != null || $emp1->AJV_EMP_Lead === null) 
                  <div class="row">
                   {!! Form::label('&nbsp;&nbsp;&nbsp;&nbsp;Add any comments from your side prior to assigning to an adviser') !!}
                    </div>
                    <div class="row" id="addcomment">
                     {!! Form::open(array('route' => 'comments_store', 'files' => true)) !!}
                            <div class="row"> 
                              <div class="col-md-8">
                               <div class="form-group">                     
                                 {!! Form::textarea('comment', null, 
                                        array('required', 
                                        'class'=>'form-control', 
                                        'placeholder'=>'Write Comments')) !!}
                              </div>
                             </div>
                              <div class="col-md-1">
                               <div class="form-group">   
                                 <br>
                                 <br>
                                 <br>                           
                                 <input type="hidden" name="process_id" value="{{ $gef->gef_id }}">
                                 <input type="hidden" name="process_name" value="gef">
                                 <button class="btn btn-primary">Add Comment</button>
                               </div>
                              </div>                                
                            </div>                                                          
                     {!! Form::close() !!}
                    </div>
                   @endif

 
                  <div class="row">
                   <div class="col-md-4">
                    <div class="form-group"> 
                        {!! Form::model($gef, ['method' => 'PATCH','route' => ['updateAssignTo', $gef->gef_id]]) !!}

                        <?php 
                   $user = Auth::user();
                   $dep1 = App\sales_leads::where('sales_lead_email','=',$user->email)->first();                          
                   $emp1 = App\employee::where('AJV_EMP_Email','=',$user->email)->first();  
                          if($dep1 != null){
                             $employeeList = App\employee::where('AJV_DEP_ID', '=', '1')->where('AJV_EMP_Lead', '=', $dep1->sales_lead_id)->pluck('AJV_EMP_Fname', 'AJV_EMP_Email');
                          } else {
                             $employeeList = App\employee::where('AJV_DEP_ID', '=', '1')->pluck('AJV_EMP_Fname', 'AJV_EMP_Email');
                          } 
                         ?>
                        {!! Form::select('assignTo', $employeeList, 0, ['placeholder' => 'Select Advisor','class' => 'form-control', 'required' => '']) !!} 
                     </div>  
                    </div> 
                   <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::submit('Assign or Re-Assign', ['class' => 'btn btn-warning']) }}
                        {{ Form::close() }}                      
                   </div>
                  </div>  
                 </div>

                @if($gef->gef_salesApproval === 'Dropped')
                 <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('This lead was dropped by') !!}
                      {!! Form::label('dropBy', $empLead->AJV_EMP_Fname . ' ' . $empLead->AJV_EMP_Lname, 
                          array('class'=>'form-control')) !!}
                   </div>
                  </div>
                 </div>

               @endif


                @if($gef->gef_salesApproval === 'Drop Pending')

                {!! Form::model($gef, ['method' => 'PATCH','route' => ['updateStatus', $gef->gef_id]]) !!}
                 <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('Do you want to drop this lead?') !!}
                      {{ Form::select('status', [
                        'Drop Pending' => 'Yes'], null, ['placeholder' => 'Select', 'class' => 'form-control']
                      ) }}
                    </div>
                  </div>   
                  <div class="col-md-6">
                   <div class="form-group">
                    <br>
                    {{ Form::submit('Submit', ['class' => 'btn btn-danger']) }}
                   </div>
                  </div>
                 </div>
                {{ Form::close() }}                      


               @endif

                    <hr>
                    @if(!empty($comments))
                     @foreach($comments as $comment)                    
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{$comment->comment_user}}</strong> {{$comment->comment_time}}</small>
                        </div>    
                        <p>{{$comment->comments}}</p>
                      </div>
                     @endforeach
                    @endif
                    @if($outcome->outcome_comments != null)
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{ $outcome->added_by }}</strong> {{$outcome->updated_at}}</small>
                        </div>    
                        <p>{{$outcome->outcome_comments}}</p>
                      </div>
                    @endif
                    @if($finance->sales_fin_comments != null)
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{ $finance->added_by }}</strong> {{$finance->updated_at}}</small>
                        </div>    
                        <p>{{$finance->sales_fin_comments}}</p>
                      </div>
                    @endif
                    @if($work->work_gap_reason != null)
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{ $work->added_by }}</strong> {{$work->updated_at}}</small>
                        </div>    
                        <p>{{$work->work_gap_reason}}</p>
                      </div>
                    @endif
                    @if($academics->academics_gap_reason != null)
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{ $academics->added_by }}</strong> {{$academics->updated_at}}</small>
                        </div>    
                        <p>{{$academics->academics_gap_reason}}</p>
                      </div>
                    @endif
                    @if($english->english_comments != null)
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{ $english->added_by }}</strong> {{$english->updated_at}}</small>
                        </div>    
                        <p>{{$english->english_comments}}</p>
                      </div>
                    @endif
                    @if($gonogo->gonogo_comments != null)
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{ $gonogo->added_by }}</strong> {{$gonogo->updated_at}}</small>
                        </div>    
                        <p>{{$gonogo->gonogo_comments}}</p>
                      </div>
                    @endif
                    @if(!empty($comments1))
                     @foreach($comments1 as $comment1)                    
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{$comment1->comment_user}}</strong> {{$comment1->comment_time}}</small>
                        </div>    
                        <p>{{$comment1->comments}}</p>
                      </div>
                     @endforeach
                    @endif
                    @if($gef->gef_process_comments != null)
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{ $gef->added_by }}</strong> {{$gef->updated_at}}</small>
                        </div>    
                        <p>{{$gef->gef_process_comments}}</p>
                      </div>
                    @endif
                
              @endif    
             @endif        

                  
               </div>  
                                  
              </div>
                   <!-- Start of Sales tab -->
                     @if($gef->tab === null)
                      <div class="tab-pane fade" id="profile">
                     @else
                      <div class="tab-pane fade in active" id="profile">
                     @endif

                          <h1>Sales Process</h1>
        <div class="row">
         <div class="col-md-8">
          <div class="form-group">
           <div class="list-inline pull-right">
              Enquiry Name (opens in a new tab): <a href="/ajveverest/leadDetails/{{$gef->gef_id}}" target="_blank"> <b>{{$gef->gef_f_name}} {{$gef->gef_l_name}}</b>  </a>
           </div>
          </div>
         </div>
        </div>                   
   @if($gef->gef_assigned_to != null)
    <div class="container">
    <div class="row">
      <section>
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" id="salesTab">

                   @if($gef->tab === 'enquiryAssess' || $gef->tab === null)
                     <li class="active">
                   @else
                     <li>
                   @endif

                        <a href="#step1" data-toggle="tab" aria-controls="step1" id="enquiryAssessment" role="tab" title="Enquiry Assessment">
                            <span class="round-tab">
                                <i class="material-icons" style="font-size:30px">thumbs_up_down</i>
                            </span>
                        </a>

                    </li>

                   @if($gef->tab === 'gonogo')
                     <li class="active">
                   @else
                     <li>
                   @endif
                        <a href="#step2" data-toggle="tab" aria-controls="step2" id="followup" role="tab" title="Follow Up">
                            <span class="round-tab">
                                <i class="material-icons" style="font-size:30px">record_voice_over</i>
                            </span>
                        </a>
                    </li>
                   @if($gef->tab === 'finance')
                     <li class="active">
                   @else
                     <li>
                   @endif
                        <a href="#step6" data-toggle="tab" aria-controls="complete" id="coverNote" role="tab" title="Cover Note">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-thumbs-up"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

                <div class="tab-content">
                   @if($gef->tab === 'enquiryAssess' || $gef->tab === null)
                    <div class="tab-pane active" role="tabpanel" id="step1">
                   @else
                    <div class="tab-pane fade" role="tabpanel" id="step1">
                   @endif 
                         <div class="step_21 center_c">
                            <h4><u>Enquiry Assessment Sheet</u></h4>           
                            {!! Form::model($gef, ['method' => 'PATCH','route' => ['gonogo_store', $gef->gef_id]]) !!}
                            <div class="row">
                            <div class="col-md-10">
                              <div class="form-group">
                                <span class="required"></span>
                                  {!! Form::label('1. Which intake is the student planning for?') !!}
                                   {{ Form::select('intake', [
                                   'JFM-19' => 'JFM-19',
                                   'AMJ-19' => 'AMJ-19',
                                   'JAS-19' => 'JAS-19',
                                   'OND-19' => 'OND-19',
                                   'JFM-20' => 'JFM-20',
                                   'BEYOND' => 'BEYOND'], $gonogo->gonogo_intakePlan, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '']
                                ) }}
                              </div>
                             </div> 
                        </div>

                        <div class="row">
                             <div class="col-md-10">
                               <div class="form-group">
                                 <span class="required"></span>           
                                {!! Form::label('2. Age?') !!}
                                {{ Form::select('age', [
                                   '5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10',
                                   '11' => '11','12' => '12','13' => '13','14' => '14','15' => '15','16' => '16','17' => '17','18' => '18','19' => '19','20' => '20',
                                   '21' => '21','22' => '22','23' => '23','24' => '24','25' => '25','26' => '26','27' => '27','28' => '28','29' => '29','30' => '30',
                                   '31' => '31','32' => '32','33' => '33','34' => '34','35' => '35','36' => '36','37' => '37','38' => '38','39' => '39','40' => '40',
                                   '41' => '41','42' => '42','43' => '43','44' => '44','45' => '45','46' => '46','47' => '47','48' => '48','49' => '49','50' => '50',
                                   '51' => '51','52' => '52','53' => '53','54' => '54','55' => '55'], $gonogo->gonogo_dob, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '']
                                ) }}
                              </div>
                            </div>
                        </div>

                        <h4><u>English Proficiency</u></h4>

                        <div class="row">
                         <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span> 
                              {!! Form::label('3. Student’s English skills?') !!}
                                {{ Form::select('englishSkill', [
                                   'Excellent' => 'Excellent',
                                   'Average' => 'Average',
                                   'Poor' => 'Poor'], $gonogo->gonogo_spokenEnglish, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '']
                                ) }}
                            </div>
                         </div> 
                        </div>

                        <div class="row">
                         <div class="col-md-10">
                          <div class="form-group">
                            <span class="required"></span>           
                            {!! Form::label('4. Has the student appeared for IELTS/PTE Exams?') !!}
                                {{ Form::select('ieltspte', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], $english->english_testTaken, ['placeholder' => 'Select', 'id' => 'ieltspte', 'class' => 'form-control', 'required' => '']
                                ) }}
                          </div>
                         </div>       
                        </div>
                      @if($english->english_testTaken === null || 'No')
                       <div style='display:none; id='ielts' class='ielts'>
                      @endif  
                         {!! Form::label('IELTS Scores') !!}
                            <table class="tablesorter" id="keywords" cellspacing="0" cellpadding="0">
                              <thead>
                                <tr>
                                    <th><span>Listening<span></th>
                                    <th><span>Reading<span></th>
                                    <th><span>Writing<span></th>
                                    <th><span>Speaking<span></th>
                                    <th><span>Overall<span></th>
                                </tr>
                               </thead>
                               <tbody id="ielts-list" name="ielts-list">
                                  <tr id="ielts{{$english->gef_phone}}">
                                   <td>{{ $english->english_IELTS_listening }}</td>
                                   <td>{{ $english->english_IELTS_read }}</td>
                                   <td>{{ $english->english_IELTS_write }}</td>
                                   <td>{{ $english->english_IELTS_speaking }}</td>
                                   <td>{{ $english->english_IELTS_overall }}</td>

                                   <td>
                                    <button class="btn btn-warning btn-detail open_modal_ielts" value="{{$english->gef_phone}}">Edit</button>
                                    </td>
                                  </tr>
                              </tbody>
                              </table>    
                              {!! Form::label('PTE Scores') !!}
                            <table class="tablesorter" id="keywords" cellspacing="0" cellpadding="0">
                              <thead>
                                <tr>
                                    <th><span>Listening<span></th>
                                    <th><span>Reading<span></th>
                                    <th><span>Writing<span></th>
                                    <th><span>Speaking<span></th>
                                    <th><span>Overall<span></th>
                                </tr>
                               </thead>
                               <tbody id="pte-list" name="pte-list">
                                  <tr id="pte{{$english->gef_phone}}">
                                   <td>{{ $english->english_PTE_listening }}</td>
                                   <td>{{ $english->english_PTE_read }}</td>
                                   <td>{{ $english->english_PTE_write }}</td>
                                   <td>{{ $english->english_PTE_speaking }}</td>
                                   <td>{{ $english->english_PTE_overall }}</td>
                                   <td>
                                    <button class="btn btn-warning btn-detail open_modal_pte" value="{{$english->gef_phone}}">Edit</button>
                                    </td>
                                  </tr>
                              </tbody>
                              </table>
                    @if($english->english_testTaken === null || 'No')  
                     </div> 
                    @endif

                      @if($english->english_testTaken === null || 'Yes')
                       <div style='display:none; id='ieltsComments' class='ieltsComments'>
                      @endif
                        <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>          
                               {!! Form::label('Mention details below: (Test date or planned test date and any comments) ') !!}
                               {!! Form::textarea('ieltsComments', $academics->academics_anyGap, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}
                            </div>
                           </div>
                         </div>
                    @if($english->english_testTaken === null || 'Yes')  
                     </div> 
                    @endif


                        <h4><u>Qualifications completed</u></h4>

                            <table class="tablesorter" id="keywords" cellspacing="0" cellpadding="0">
                              <thead>
                                <tr>
                                    <th><span>Qualification<span></th>
                                    <th><span>Qualified Year<span></th>
                                    <th><span>University<span></th>
                                    <th><span>Country<span></th>
                                    <th><span>Final Result<span></th>
                                    <th><span>Marks%<span></th>
                                </tr>
                               </thead>
                               <tbody id="qualification1-list" name="qualification1-list">
                                  <tr id="qualification1{{$academics->gef_phone}}">
                                   <td>{{ 'PHD' }}</td>
                                   <td>{{ $academics->academics_yearOfPassing1 }}</td>
                                   <td>{{ $academics->academics_university1 }}</td>
                                   <td>{{ $academics->academics_uni_city1 }}</td>
                                   <td>{{ $academics->academics_final_result1 }}</td>
                                   <td>{{ $academics->academics_higestDegree1 }}</td>

                                   <td>
                                    <button class="btn btn-warning btn-detail open_modal_qualification1" value="{{$academics->gef_phone}}">Edit</button>
                                    </td>
                                  </tr>
                              </tbody>

                              <tbody id="qualification2-list" name="qualification2-list">
                                  <tr id="qualification2{{$academics->gef_phone}}">
                                   <td>{{ 'Masters Degree' }}</td>
                                   <td>{{ $academics->academics_yearOfPassing2 }}</td>
                                   <td>{{ $academics->academics_university2 }}</td>
                                   <td>{{ $academics->academics_uni_city2 }}</td>
                                   <td>{{ $academics->academics_final_result2 }}</td>
                                   <td>{{ $academics->academics_higestDegree2 }}</td>
                                   <td>
                                    <button class="btn btn-warning btn-detail open_modal_qualification2" value="{{$academics->gef_phone}}">Edit</button>
                                    </td>
                                  </tr>
                              </tbody>

                              <tbody id="qualification3-list" name="qualification3-list">
                                  <tr id="qualification3{{$academics->gef_phone}}">
                                   <td>{{ 'Bachelors Degree' }}</td>
                                   <td>{{ $academics->academics_yearOfPassing3 }}</td>
                                   <td>{{ $academics->academics_university3 }}</td>
                                   <td>{{ $academics->academics_uni_city3 }}</td>
                                   <td>{{ $academics->academics_final_result3 }}</td>
                                   <td>{{ $academics->academics_higestDegree3 }}</td>

                                   <td>
                                    <button class="btn btn-warning btn-detail open_modal_qualification3" value="{{$academics->gef_phone}}">Edit</button>
                                    </td>
                                  </tr>
                              </tbody>

                              <tbody id="qualification4-list" name="qualification4-list">
                                  <tr id="qualification4{{$academics->gef_phone}}">
                                   <td>{{ 'Diploma' }}</td>
                                   <td>{{ $academics->academics_yearOfPassing4 }}</td>
                                   <td>{{ $academics->academics_university4 }}</td>
                                   <td>{{ $academics->academics_uni_city4 }}</td>
                                   <td>{{ $academics->academics_final_result4 }}</td>
                                   <td>{{ $academics->academics_higestDegree4 }}</td>
                                   <td>
                                    <button class="btn btn-warning btn-detail open_modal_qualification4" value="{{$academics->gef_phone}}">Edit</button>
                                    </td>
                                  </tr>
                              </tbody>
                              </table>     

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('5. Any gaps in education or career for more than 1 year?') !!}
                                {{ Form::select('gaps', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], $academics->academics_anyGap, ['placeholder' => 'Select', 'id' => 'gaps', 'class' => 'form-control', 'required' => '']
                                ) }}                    
                          </div>
                         </div>
                       </div>

                      @if($academics->academics_anyGap === null || 'No')
                       <div style='display:none; id='gapComments' class='gapComments'> 
                      @endif  
                        <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>          
                               {!! Form::label('Specify Details') !!}
                               {!! Form::textarea('gapComments',  $academics->academics_gap_reason, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}
                          </div>
                         </div>
                       </div>
                      @if($academics->academics_anyGap === null || 'No')
                       </div>
                      @endif 

                        <h4><u>Work Experience</u></h4>


                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>   
                           {!! Form::label('6. How many years of total work experience?') !!}
                                {{ Form::select('workExp', [
                                   '0' => '0','1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10+' => '10+',], $work->work_totalExp, ['placeholder' => 'Select', 'id' => 'workExp', 'class' => 'form-control', 'required' => '']
                                ) }}
        
                          </div>
                         </div>
                       </div>

                     @if($work->work_gap_reason != null) 
                      @if($work->work_totalExp === null || '0')
                       <div style='display:none; id='workComments' class='workComments'> 
                      @endif
                        <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>          
                               {!! Form::label('Brief info regarding work experience: (specify any issues)') !!}
                               {!! Form::textarea('workComments', $work->work_gap_reason, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}
                          </div>
                         </div>
                       </div>
                      @if($work->work_totalExp === null || '0')
                       </div> 
                      @endif
                     @endif

                        <h4><u>Financial Ability</u></h4>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span> 
                           {!! Form::label('7. Can you afford a minimum of NZ$ 35,000 towards your fee and living to study in NZ?') !!}
                               {{ Form::select('afford', [
                                   'Yes' => 'Yes',
                                   'No' => 'No',
                                   'Not sure' => 'Not sure'], $finance->sales_fin_35To45k, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '']
                                ) }}
                      
                          </div>
                         </div>
                       </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>      
                               {!! Form::label('8. How do you plan to arrange these funds?') !!}
                                {{ Form::select('funds', [
                                   'Personal/Parents Savings' => 'Personal/Parents Savings',
                                   'Loan' => 'Loan','Savings + Loan' => 'Savings + Loan',
                                   'Not sure' => 'Not sure'], $finance->sales_fin_fundSource, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '']
                                ) }}
     
                          </div>
                         </div>
                       </div>

                        <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                               {!! Form::label('Explain if details available') !!}
                               {!! Form::textarea('fundsComments', $finance->sales_fin_comments, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}
                          </div>
                         </div>
                       </div>


                        <h4><u>Application details</u></h4>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">    
                            <span class="required"></span>   
                           {!! Form::label('9. Has the student already made any applications to an NZ institution through An Agent Or Self?') !!}
                                {{ Form::select('app', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], $gonogo->gonogo_prevInsAgentOrSelf, ['placeholder' => 'Select', 'id' => 'app', 'class' => 'form-control', 'required' => '']
                                ) }}
                 
                          </div>
                         </div>
                       </div>

                      @if($gonogo->gonogo_prevInsAgentOrSelf === null || 'No')
                       <div style='display:none; id='appComments' class='appComments'> 
                      @endif
                        <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>          
                               {!! Form::label('Provide application details: (Agent, course, college, offer status and intake)') !!}
                               {!! Form::textarea('appComments', $gonogo->gonogo_appComments, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}
                          </div>
                         </div>
                        </div>
                     @if($gonogo->gonogo_prevInsAgentOrSelf === null || 'No')
                       </div>
                     @endif

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>      
                               {!! Form::label('10. Has the student have any prior visa declines for any country including NZ for any type of visa including visitor or work visas?') !!}
                                {{ Form::select('decline', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], $gonogo->gonogo_priorVisaRejection, ['placeholder' => 'Select', 'id' => 'decline', 'class' => 'form-control', 'required' => '']
                                ) }}
     
                          </div>
                         </div>
                       </div>

                      @if($gonogo->gonogo_priorVisaRejection === null || 'No')
                       <div style='display:none; id='declineComments' class='declineComments'> 
                      @endif 
                        <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>          
                               {!! Form::label('Reason for decline') !!}
                               {!! Form::textarea('declineComments', $gonogo->gonogo_prevNzVisa, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}
                          </div>
                         </div>
                         </div>
                      @if($gonogo->gonogo_priorVisaRejection === null || 'No')
                       </div>
                      @endif        

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">    
                            <span class="required"></span>   
                           {!! Form::label('11. Does the student have criminal offences??') !!}
                                {{ Form::select('criminal', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], $gonogo->gonogo_characterIssue, ['placeholder' => 'Select', 'id' => 'criminal', 'class' => 'form-control', 'required' => '']
                                ) }}                 
                          </div>
                         </div>
                       </div>

                      @if($gonogo->gonogo_characterIssue === null || 'No')
                       <div style='display:none; id='criminalComments' class='criminalComments'> 
                      @endif 
                        <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>          
                               {!! Form::label('Specify details') !!}
                               {!! Form::textarea('criminalComments', $gonogo->gonogo_criminalComments, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}
                          </div>
                         </div>
                         </div>
                      @if($gonogo->gonogo_characterIssue === null || 'No')
                       </div>
                      @endif 

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>           
                               {!! Form::label('12. Does the student have an health issues?') !!}
                                {{ Form::select('health', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], $gonogo->gonogo_healthIssue, ['placeholder' => 'Select', 'id' => 'health', 'class' => 'form-control', 'required' => '']
                                ) }} 
                          </div>
                         </div>
                        </div> 

                      @if($gonogo->gonogo_healthIssue === null || 'No')
                       <div style='display:none; id='healthComments' class='healthComments'> 
                      @endif 
                        <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>          
                               {!! Form::label('Specify details') !!}
                               {!! Form::textarea('healthComments', $gonogo->gonogo_healthComments, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}
                          </div>
                         </div>
                         </div>
                      @if($gonogo->gonogo_healthIssue === null || 'No')
                       </div>
                      @endif 

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>   
                               {!! Form::label('13. Is the student planning to move with spouse and or child?') !!}
                                {{ Form::select('family', [
                                   'Yes' => 'Yes',
                                   'No' => 'No',
                                   'N/A' => 'N/A'], $gonogo->gonogo_family, ['placeholder' => 'Select', 'id' => 'family', 'class' => 'form-control', 'required' => '']
                                ) }}        
                          </div>
                         </div>
                       </div>

                      @if($gonogo->gonogo_family === null || 'No')
                       <div style='display:none; id='familyComments' class='familyComments'> 
                      @endif 
                        <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>          
                               {!! Form::label('Specify details') !!}
                               {!! Form::textarea('familyComments', $gonogo->gonogo_familyComments, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}
                          </div>
                         </div>
                         </div>
                      @if($gonogo->gonogo_family === null || 'No')
                       </div>
                      @endif

                       <div class="row">
                          <div class="col-md-12">
                           <div class="form-group"> 
                            <span class="required"></span>  
                             {!! Form::label('14. Is the student considering another country?') !!}
                               <br>
                               {{ Form::checkbox('No', 'No') }}
                               {!! Form::label('No') !!} 
                               {{ Form::checkbox('Australia', 'Australia') }}
                               {!! Form::label('Australia') !!}
                               {{ Form::checkbox('Canada', 'Canada') }}
                               {!! Form::label('Canada') !!}
                               {{ Form::checkbox('UK', 'UK') }}
                               {!! Form::label('UK') !!}
                               {{ Form::checkbox('USA', 'USA') }}
                               {!! Form::label('USA') !!}
                               {{ Form::checkbox('Ireland', 'Ireland') }}
                               {!! Form::label('Ireland') !!}
                               {{ Form::checkbox('Singapore', 'Singapore') }}
                               {!! Form::label('Singapore') !!}
                               {{ Form::checkbox('Dubai', 'Dubai') }}
                               {!! Form::label('Dubai') !!}
                               {{ Form::checkbox('Germany', 'Germany') }}
                               {!! Form::label('Germany') !!}
                               {{ Form::checkbox('Other', 'Other') }}
                               {!! Form::label('Other (specify the country in comments)') !!}                     
                          </div>
                         </div>
                       </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>   
                               {!! Form::label('15. Does the student hold a valid passport?') !!}
                                {{ Form::select('passport', [
                                   'Yes' => 'Yes',
                                   'No' => 'No',
                                   'Applied' => 'Applied'], $gonogo->gonogo_passport, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '']
                                ) }}        
                          </div>
                         </div>
                       </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>  
                             {!! Form::label('16. Has the student been added as FB friend and to AJV group?') !!}
                                {{ Form::select('fb', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], $gonogo->gonogo_friend, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '']
                                ) }}
                     
                          </div>
                         </div>
                       </div>


                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>   
                               {!! Form::label('17. Enter FB Profile Link (if not available write Not Applicable)') !!} 
	                     {!! Form::text('fbLink',  $gonogo->gonogo_group, 
	                            array('required', 
	                              'class'=>'form-control', 
	                           'placeholder'=>'FB Profile Link')) !!}      
                          </div>
                         </div>
                       </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>  
                             {!! Form::label('18. Is AJV fee applicable?') !!}
                                {{ Form::select('ajvFee', [
                                   'Yes' => 'Yes',
                                   'No' => 'No',
                                   'Waived by manager' => 'Waived by manager'],  $gonogo->gonogo_ajvFee, ['placeholder' => 'Select', 'id' => 'ajvFee', 'class' => 'form-control', 'required' => '']
                                ) }}
                     
                          </div>
                         </div>
                       </div>

                      @if($gonogo->gonogo_ajvFee === null || 'No' || 'Waived by manager')
                       <div style='display:none; id='feeComments' class='feeComments'> 
                      @endif 
                        <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>          
                               {!! Form::label('Specify details (type of fee and when applicable)') !!}
                               {!! Form::textarea('feeComments', $gonogo->gonogo_feeComments, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}
                          </div>
                         </div>
                         </div>
                      @if($gonogo->gonogo_ajvFee === null || 'No' || 'Waived by manager')
                       </div>
                      @endif  

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>   
                               {!! Form::label('19. Status') !!}
                                {{ Form::select('status', [
                                   'Docs Pending' => 'Docs Pending',
                                   'STA-JFM19' => 'STA-JFM19',
                                   'STA-AMJ19' => 'STA-AMJ19', 
                                   'STA-JAS19' => 'STA-JAS19',
                                   'STA-OND19' => 'STA-OND19',
                                   'STA-JFM20' => 'STA-JFM20',
                                   'BEYOND' => 'BEYOND',
                                   'Onshore Lead' => 'Onshore Lead',
                                   'Hot' => 'Hot'], $gonogo->gonogo_skilled, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '']
                                ) }}        
                          </div>
                         </div>
                       </div>

                          @if($gonogo->gonogo_comments === null)
                            <div class="row"> 
                              <div class="col-md-8">
                               <div class="form-group"> 
                                 <span class="required"></span>              
                               {!! Form::label('Comments') !!}
                                   {!! Form::textarea('comments', null, 
                                        array('required', 
                                        'class'=>'form-control', 
                                        'placeholder'=>'comments')) !!}
                              </div>
                             </div>
                           </div>
                          @endif

                       <div class="row">
                        <div class="col-md-2">
                         <div class="form-group">
                            {!! Form::hidden('addedBy', $emp_loggedin->AJV_EMP_Fname . ' ' . $emp_loggedin->AJV_EMP_Lname . ', ' . $emp_loggedin->AJV_EMP_designation) !!}
                            {!! Form::submit('Save & Continue', 
                              array('class'=>'btn btn-primary','id' => 'submit')) !!}
                         </div>
                        </div>

                            {!! Form::close() !!}

                     {!! Form::model($gef, ['method' => 'PATCH','route' => ['updateStatus', $gef->gef_id]]) !!}

                        <div class="col-md-1">
                         <div class="form-group">
                            <input name="status" value="Drop Pending" type="hidden">
                            {!! Form::submit('Drop Lead', 
                              array('class'=>'btn btn-danger','id' => 'submit')) !!}
                         </div>
                        </div>
                       </div> 

                      {!! Form::close() !!}


                 <?php
                  if($gef->gef_prev_status != 'Drop Pending'){
                   $comments = App\comments::where('comment_process_id', '=', $gonogo->gonogo_ID)->where('comment_process_name', '=', 'gonogo')->orderBy('comment_id', 'DESC')->get();
                  }
                 ?>
                 @if($gonogo->gonogo_comments != null)
                  <div class="row">
                  {!! Form::label('&nbsp;&nbsp;&nbsp;&nbsp;Comments (Writing Comments is mandatory)') !!}
                    </div>
                    <div class="row" id="addcomment">
                     {!! Form::open(array('route' => 'comments_store', 'files' => true)) !!}
                            <div class="row"> 
                              <div class="col-md-8">
                               <div class="form-group">                     
                                 {!! Form::textarea('comment', null, 
                                        array('required', 
                                        'class'=>'form-control', 
                                        'placeholder'=>'Write Comments')) !!}
                              </div>
                             </div>
                              <div class="col-md-1">
                               <div class="form-group">   
                                 <br>
                                 <br>
                                 <br>                           
                                 <input type="hidden" name="process_id" value="{{ $gonogo->gonogo_ID }}">
                                 <input type="hidden" name="process_name" value="gonogo">
                                 <input type="hidden" name="process_phone" value="{{ $gonogo->gef_phone }}">   
                                 <button class="btn btn-primary">Add Comment</button>
                               </div>
                              </div>                                
                            </div>  
                          </div>                                                          
                     {!! Form::close() !!}
                  
                    <hr>
                    @if(!empty($comments))
                     @foreach($comments as $comment)                    
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{$comment->comment_user}}</strong> {{$comment->comment_time}}</small>
                        </div>    
                        <p>{{$comment->comments}}</p>
                      </div>
                     @endforeach
                    @endif 
                @if($gonogo->gonogo_comments != null) 
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{$gonogo->added_by}}</strong> {{$gonogo->updated_at}}</small>
                        </div>    
                        <p>{{$gonogo->gonogo_comments}}</p>
                      </div>
                @endif 

              @endif



                    <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
                    </ul>

                    </div>
                  </div>


                         <script>

                          $(document).ready(function(){
                           $('#ieltspte').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.ielts').show();
                               $('.ieltsComments').hide();

                             }
                             else
                             { 
                               $('.ielts').hide();
                               $('.ieltsComments').show();
                             }
                           });
                           $('#gaps').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.gapComments').show();
                             }
                             else
                             { 
                               $('.gapComments').hide();
                             }
                           });
                           $('#decline').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.declineComments').show();
                             }
                             else
                             { 
                               $('.declineComments').hide();
                             }
                           });
                           $('#app').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.appComments').show();
                             }
                             else
                             { 
                               $('.appComments').hide();
                             }
                           });
                           $('#ajvFee').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.feeComments').show();
                             }
                             else
                             { 
                               $('.feeComments').hide();
                             }
                           });
                           $('#family').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.familyComments').show();
                             }
                             else
                             { 
                               $('.familyComments').hide();
                             }
                           });
                           $('#health').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.healthComments').show();
                             }
                             else
                             { 
                               $('.healthComments').hide();
                             }
                           });
                           $('#health').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.healthComments').show();
                             }
                             else
                             { 
                               $('.healthComments').hide();
                             }
                           });
                           $('#criminal').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.criminalComments').show();
                             }
                             else
                             { 
                               $('.criminalComments').hide();
                             }
                           });
                           $('#workExp').on('change', function() {
                             if ( this.value == null || this.value == '0')
                             {
                               $('.workComments').hide();
                             }
                             else
                             { 
                               $('.workComments').show();
                             }
                           });
                         });

                         </script> 

                           <!--  gonogo MODAL -->
                              <div class="modal fade" id="mygonogo" tabindex="-1" role="dialog" aria-labelledby="mygonogoLabel" aria-hidden="true">
                               
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="mygonogoLabel">Go No Go Details</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                 <div class="row"> 
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Date of Birth? </label>
                                       <div class="col-sm-6">
                                         <input type="text" name="gonogo_dob" id="gonogo_dob" readonly="readonly" class="form-control" value=""> 
                                        </div>
                                       </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">How Good Is The Spoken English?</label>
                                        <div class="col-sm-6">
                                       <input type="text" class="form-control" id="gonogo_spokenEnglish" name="gonogo_spokenEnglish" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Has The Lead Applied For Any Visa For NZ Earlier? </label>
                                        <div class="col-sm-6">
                                       <input type="text" class="form-control" id="gonogo_prevNzVisa" name="gonogo_prevNzVisa" placeholder="Yes/No" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Has The Lead Applied For Any Institute In NZ Through An Agent Or Self? </label>
                                        <div class="col-sm-6">
                                       <input type="text" name="gonogo_prevInsAgentOrSelf" id="gonogo_prevInsAgentOrSelf" placeholder="Yes/No" class="form-control" value="">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Which Intake Is The Lead Planning For? </label>
                                        <div class="col-sm-6">
                                       <input type="text" name="gonogo_intakePlan" id="gonogo_intakePlan"  class="form-control" placeholder="Yes/No" value="">
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Any Prior Visa Rejection? </label>
                                        <div class="col-sm-6">
                                       <input type="text" name="gonogo_priorVisaRejection" id="gonogo_priorVisaRejection" placeholder="Yes/No" class="form-control" value="">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Has The Lead Been Added As A Friend In FB? </label>
                                        <div class="col-sm-6">
                                       <input type="text" name="gonogo_friend" id="gonogo_friend" placeholder="Yes/No" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Has The Lead Been Added To NZOptions FB Group?</label>
                                        <div class="col-sm-6">
                                       <input type="text" class="form-control" id="gonogo_group" name="gonogo_group" placeholder="Yes/No" value="">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Has The Lead Choosen Subject In Skilled Shortage List?</label>
                                        <div class="col-sm-6">
                                       <input type="text" class="form-control" id="gonogo_skilled" name="gonogo_skilled" placeholder="Yes/No" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Is AJV fee applicable?</label>
                                        <div class="col-sm-6">
                                       <input type="text" class="form-control" id="gonogo_ajvFee" name="gonogo_ajvFee" placeholder="Yes/No" value="">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Is There Any Character Issues? </label>
                                        <div class="col-sm-6">
                                       <input type="text" class="form-control" id="gonogo_characterIssue" name="gonogo_characterIssue" placeholder="Yes/No" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Is There Any Health Issues? </label>
                                        <div class="col-sm-6">
                                       <input type="text" name="gonogo_healthIssue" id="gonogo_healthIssue" placeholder="Yes/No" class="form-control" value="">
                                        </div>
                                    </div>
                                  </div>
                                  </form>
                                  </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-gonogo1" value="add">Submit Details</button>
                                        <input type="hidden" id="gonogo1_id" name="gonogo1_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>
                  
 

                           <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Update Comments</h4>
                                </div>
                                <div class="modal-body">
                                <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Comments</label>
                                       <div class="col-sm-9">
                                        <textarea type="text" class="form-control has-error" id="gonogo_comments" name="gonogo_comments" value=""></textarea>
                                       </div>
                                       </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save" value="add">Save Comments</button>
                                        <input type="hidden" id="product_id" name="product_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>


<!--                 End of Step 1
                Start of Step2 -->
                   @if($gef->tab === 'gonogo')
                    <div class="tab-pane active" role="tabpanel" id="step2">
                   @else
                    <div class="tab-pane fade" role="tabpanel" id="step2">
                   @endif
                         <div class="step_21 center_c">
                            <h4><u>Follow Ups</u></h4>
                            </br>
                            </br> 
  

                            {!! Form::model($gef, ['route' => ['followup_store', $gef->gef_id]]) !!}
                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('1. Type of follow up?') !!}
                                {{ Form::select('followType', [
                                   'Call' => 'Call',
                                   'Email' => 'email',
                                   'Chat' => 'Chat',
                                   'Text' => 'Text',
                                   'Other' => 'Other'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'follow']
                                ) }}                    
                          </div>
                         </div>
                       </div>

    <div style='display:none; id='call' class='call'> 
     <div class="row">
      <div class="col-md-10">
       <div class="form-group"> 
       <span class="required"></span>
       {!! Form::label('Call Category (Mandatory)') !!}
{{ Form::select('callCat', [
       'Spoken' => 'Spoken',
       'Not Spoken' => 'Not Spoken'], null, ['placeholder' => 'Select', 'class' => 'form-control']
 ) }}
       </div>
      </div>  
     </div> 
    </div> 

     <script type="text/javascript">

     $('#follow').on('change', function() {
       if ( this.value == 'Call'){
         $('.call').show();
       } else {
         $('.call').hide();
       } 
      });

    </script>

                        <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>          
                               {!! Form::label('2. Notes ') !!}
                               {!! Form::textarea('notes', null, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}
                            </div>
                           </div>
                         </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>   
                               {!! Form::label('3. Status') !!}
                                {{ Form::select('status', [
                                   'Docs Pending' => 'Docs Pending',
                                   'STA-JFM19' => 'STA-JFM19',
                                   'STA-AMJ19' => 'STA-AMJ19', 
                                   'STA-JAS19' => 'STA-JAS19',
                                   'STA-OND19' => 'STA-OND19',
                                   'STA-JFM20' => 'STA-JFM20',
                                   'BEYOND' => 'BEYOND',
                                   'Onshore Lead' => 'Onshore Lead',
                                   'Hot' => 'Hot','Drop Pending' => 'Dropped'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'stat']
                                ) }}        
                          </div>
                         </div>
                       </div>

    <div style='display:none; id='dcat' class='dcat'> 
                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>   
                               {!! Form::label('Drop Category (Mandatory)') !!}
                                {{ Form::select('dropCat', [
                                   'No Fund' => 'No Fund',
                                   'No English/ No or Less IELTS' => 'No English/ No or Less IELTS', 
                                   'Only Work / PR VISA' => 'Only Work / PR VISA',
                                   'No Physical Office' => 'No Physical Office',
                                   'Changed mind' => 'Changed mind',
                                   'Change of Agent' => 'Change of Agent',
                                   'Loan Decline' => 'Loan Decline',
                                   'Parents keen on different country' => 'Parents keen on different country',
                                   'Spouse changed mind' => 'Spouse changed mind',
                                   'Sudden Marriage plans' => 'Sudden Marriage plans','Policy Change' => 'Policy Change','Non Responsive' => 'Non Responsive','Not Interested' => 'Not Interested','Not Enquired' => 'Not Enquired'], null, ['placeholder' => 'Select', 'class' => 'form-control']
                                ) }}        
                          </div>
                         </div>
                       </div>
     </div>  

     <script type="text/javascript">

     $('#stat').on('change', function() {
       if ( this.value == 'Drop Pending'){
         $('.dcat').show();
       } else {
         $('.dcat').hide();
       } 
      });

    </script>

	              <div class="row">
		       <div class="col-md-10">
                        {!! Form::label('Reminder date') !!}  
                        {!! Form::text('reminder', null,
                             array('required',
                                'class'=>'form-control clsDatePicker',
                                'readonly'=>'readonly',
                                'id'=>'reminder',
                                'name'=>'reminder')) !!}
                       </div>
                     </div> 
<br>
                       <div class="row">
                        <div class="col-md-1">
                         <div class="form-group">
                            {!! Form::hidden('addedBy', $emp_loggedin->AJV_EMP_Fname . ' ' . $emp_loggedin->AJV_EMP_Lname . ', ' . $emp_loggedin->AJV_EMP_designation) !!}
                            {!! Form::submit('Save', 
                              array('class'=>'btn btn-primary','id' => 'submit')) !!}
                         </div>
                        </div>

                            {!! Form::close() !!}


                    <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step">Create Application--></button></li>
                    </ul>
                  </div>

                       </br>
                       </br>
                            <b><u>History of follow ups</u></b>   
                            <table class="tablesorter" id="keywords" cellspacing="0" cellpadding="0">
                              <thead>
                                <tr>
                                    <th><span>Date<span></th>
                                    <th><span>Mobile No<span></th>
                                    <th><span>Type<span></th>
                                    <th><span>Notes<span></th>
                                    <th><span>Status<span></th>
                                    <th><span>Added By<span></th>
                                    <th><span><span></th>
                                </tr>
                               </thead>
                              <tbody id="followup-list" name="followup-list">
                                 @foreach ($followup as $notes)
                                  <tr>
                                   <td>{{ $notes->created_at }}</td>
                                   <td>{{ $notes->gef_phone }}</td>
                                   <td>{{ $notes->sales_followup_type   }}</td>
                                   <td>{{ $notes->sales_followup_notes  }}</td>
                                   <td>{{ $notes->sales_followup_status }}</td>
                                   <td>{{ $notes->added_by }}</td>
                                   <td></td>
                                  </tr>
                                  @endforeach
                              </tbody>
                              </table>     

                    </div>

                  </div>




                             <!--  IELTS SCORES MODAL -->

                  <div class="modal fade" id="myielts" tabindex="-1" role="dialog" aria-labelledby="myieltsLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myieltsLabel">IELTS Scores</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Listening</label>
                                       <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="english_IELTS_listening" name="english_IELTS_listening" placeholder="Type here" value="">
                                       </div>
                                       </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Reading</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="english_IELTS_read" name="english_IELTS_read" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Writing</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="english_IELTS_write" name="english_IELTS_write" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Speaking</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="english_IELTS_speaking" name="english_IELTS_speaking" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Overall Score</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="english_IELTS_overall" name="english_IELTS_overall" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-ielts" value="add">Submit Scores</button>
                                        <input type="hidden" id="ielts_id" name="ielts_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                             <!--  PTE SCORES MODAL -->
                              <div class="modal fade" id="mypte" tabindex="-1" role="dialog" aria-labelledby="mypteLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="mypteLabel">PTE Scores</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Listening</label>
                                       <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="english_PTE_listening" name="english_PTE_listening" placeholder="Type here" value="">
                                       </div>
                                       </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Reading</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="english_PTE_read" name="english_PTE_read" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Writing</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="english_PTE_write" name="english_PTE_write" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Speaking</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="english_PTE_speaking" name="english_PTE_speaking" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Overall Score</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="english_PTE_overall" name="english_PTE_overall" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-pte" value="add">Submit Scores</button>
                                        <input type="hidden" id="pte_id" name="pte_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                             <!--  Plan SCORES MODAL -->
                              <div class="modal fade" id="myplan" tabindex="-1" role="dialog" aria-labelledby="myplanLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myplanLabel">Planned English test date</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Date</label>
                                       <div class="col-sm-9">
                                        <input type="text" name="english_test_plan_dte" id="english_test_plan_dte" readonly="readonly" class="form-control clsDatePicker"> 
                                       </div>
                                       </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-plan" value="add">Submit</button>
                                        <input type="hidden" id="plan_id" name="plan_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                <div class="modal fade" id="myenglishcomments" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Update Comments</h4>
                                </div>
                                <div class="modal-body">
                                <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Comments</label>
                                       <div class="col-sm-9">
                                        <textarea type="text" class="form-control has-error" id="english_comments" name="english_comments" value=""></textarea>
                                       </div>
                                       </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-english-comments" value="add">Save Comments</button>
                                        <input type="hidden" id="english_comments_id" name="english_comments_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>
                  

                   <!--  Qualification1 MODAL -->
                              <div class="modal fade" id="myqualification1" tabindex="-1" role="dialog" aria-labelledby="myqualification1Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myqualification1Label">Qualification Details</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Qualified date</label>
                                        <div class="col-sm-9">
                                       <input type="text" name="academics_yearOfPassing1" id="academics_yearOfPassing1" readonly="readonly" class="form-control clsDatePicker"> 
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">University</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="academics_university1" name="academics_university1" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Country</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="academics_uni_city1" name="academics_uni_city1" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Final Result</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="academics_final_result1" name="academics_final_result1" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Marks%</label>
                                       <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="academics_higestDegree1" name="academics_higestDegree1" placeholder="Type here" value="">
                                       </div>
                                       </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-qualification1" value="add">Submit Scores</button>
                                        <input type="hidden" id="qualification1_id" name="qualification1_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                              <!--  Qualification2 MODAL -->
                              <div class="modal fade" id="myqualification2" tabindex="-1" role="dialog" aria-labelledby="myqualification2Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myqualification2Label">Qualification Details</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Qualified date</label>
                                        <div class="col-sm-9">
                                       <input type="text" name="academics_yearOfPassing2" id="academics_yearOfPassing2" readonly="readonly" class="form-control clsDatePicker">

                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">University</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="academics_university2" name="academics_university2" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Country</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="academics_uni_city2" name="academics_uni_city2" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Final Result</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="academics_final_result2" name="academics_final_result2" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Marks%</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="academics_higestDegree2" name="academics_higestDegree2" placeholder="Type here" value="">
                                       </div>
                                       </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-qualification2" value="add">Submit Scores</button>
                                        <input type="hidden" id="qualification2_id" name="qualification2_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>


                              <!--  Qualification3 MODAL -->
                              <div class="modal fade" id="myqualification3" tabindex="-1" role="dialog" aria-labelledby="myqualification3Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myqualification3Label">Qualification Details</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Qualified date</label>
                                        <div class="col-sm-9">
                                       <input type="text" name="academics_yearOfPassing3" id="academics_yearOfPassing3" readonly="readonly" class="form-control clsDatePicker">

                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">University</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="academics_university3" name="academics_university3" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Country</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="academics_uni_city3" name="academics_uni_city3" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Final Result</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="academics_final_result3" name="academics_final_result3" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Marks%</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="academics_higestDegree3" name="academics_higestDegree3" placeholder="Type here" value="">
                                       </div>
                                       </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-qualification3" value="add">Submit Scores</button>
                                        <input type="hidden" id="qualification3_id" name="qualification3_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                              <!--  Qualification4 MODAL -->
                              <div class="modal fade" id="myqualification4" tabindex="-1" role="dialog" aria-labelledby="myqualification4Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myqualification4Label">Qualification Details</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Qualified date</label>
                                        <div class="col-sm-9">
                                       <input type="text" name="academics_yearOfPassing4" id="academics_yearOfPassing4" readonly="readonly" class="form-control clsDatePicker">

                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">University</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="academics_university4" name="academics_university4" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Country</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="academics_uni_city4" name="academics_uni_city4" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Final Result</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="academics_final_result4" name="academics_final_result4" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Marks%</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="academics_higestDegree4" name="academics_higestDegree4" placeholder="Type here" value="">
                                       </div>
                                       </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-qualification4" value="add">Submit Scores</button>
                                        <input type="hidden" id="qualification4_id" name="qualification4_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                          <!--Academics Comments Modal-->    
                        <div class="modal fade" id="myacademicscomments" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Update Comments</h4>
                                </div>
                                <div class="modal-body">
                                <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Comments</label>
                                       <div class="col-sm-9">
                                        <textarea type="text" class="form-control has-error" id="academics_gap_reason" name="academics_gap_reason" value=""></textarea>
                                       </div>
                                       </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-academics-comments" value="add">Update Comments</button>
                                        <input type="hidden" id="academics_comments_id" name="academics_comments_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>      

                  <!-- END OF ACADEMICS TAB -->
                    <!--  Work1 MODAL -->
                              <div class="modal fade" id="mywork1" tabindex="-1" role="dialog" aria-labelledby="mywork1Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="mywork1Label">Work Details</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Company</label>
                                       <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="work_exp_company1" name="work_exp_company1" placeholder="Type here" value="">
                                       </div>
                                       </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Designation</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="work_exp_designation1" name="work_exp_designation1" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Employment period from</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="work_exp_employmentPeriod1" id="work_exp_employmentPeriod1" readonly="readonly" class="form-control clsDatePicker">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Employment period to</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="work_exp_employmentTo1" id="work_exp_employmentTo1" readonly="readonly" class="form-control clsDatePicker">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Country</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="work_exp_location1" name="work_exp_location1" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                    
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-work1" value="add">Submit Details</button>
                                        <input type="hidden" id="work1_id" name="work1_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                              <!--  Work2 MODAL -->
                              <div class="modal fade" id="mywork2" tabindex="-1" role="dialog" aria-labelledby="mywork2Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="mywork2Label">Work Details</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Company</label>
                                       <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="work_exp_company2" name="work_exp_company2" placeholder="Type here" value="">
                                       </div>
                                       </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Designation</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="work_exp_designation2" name="work_exp_designation2" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail2" class="col-sm-3 control-label">Employment Period from</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="work_exp_employmentPeriod2" id="work_exp_employmentPeriod2" readonly="readonly" class="form-control clsDatePicker">

                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail2" class="col-sm-3 control-label">Employment period to</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="work_exp_employmentTo2" id="work_exp_employmentTo2" readonly="readonly" class="form-control clsDatePicker">
                                        </div>
                                    </div>

                                     <div class="form-group">
                                     <label for="inputDetail2" class="col-sm-3 control-label">Country</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="work_exp_location2" name="work_exp_location2" placeholder="Type here" value="">
                                        </div>
                                    </div>
                                    
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-work2" value="add">Submit Details</button>
                                        <input type="hidden" id="work2_id" name="work2_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                <!--work Comments Modal-->    
                        <div class="modal fade" id="myworkcomments" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Update Comments</h4>
                                </div>
                                <div class="modal-body">
                                <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Comments</label>
                                       <div class="col-sm-9">
                                        <textarea type="text" class="form-control has-error" id="work_gap_reason" name="work_gap_reason" value=""></textarea>
                                       </div>
                                       </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-work-comments" value="add">Update Comments</button>
                                        <input type="hidden" id="work_comments_id" name="work_comments_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>      

                    <!-- End of Work Tab -->

                    <!--  finance MODAL -->
                              <div class="modal fade" id="myfinance" tabindex="-1" role="dialog" aria-labelledby="myfinanceLabel" aria-hidden="true">
                               
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myfinanceLabel">Finance Details</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                 <div class="row"> 
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Martial Status?</label>
                                       <div class="col-sm-6">
                                         <input type="text" name="sales_fin_maritalStatus" id="sales_fin_maritalStatus"  class="form-control" placeholder="Single/Married" value=""> 
                                        </div>
                                       </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Can you afford to spend between NZ$35000 to NZ$45000?</label>
                                        <div class="col-sm-6">
                                       <input type="text" class="form-control" id="sales_fin_35To45k" name="sales_fin_35To45k" placeholder="Yes/No" value="">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">How Will Be The Funds Arranged?</label>
                                        <div class="col-sm-6">
                                       <input type="text" class="form-control" id="sales_fin_fundSource" name="sales_fin_fundSource" placeholder="Bank/Personal/not decided" value="">
                                        </div>
                                    </div>
                                  </form>
                                  </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-finance" value="add">Submit Details</button>
                                        <input type="hidden" id="finance_id" name="finance_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>
                            </div>

                   @if($gef->tab === 'finance')
                    <div class="tab-pane active" role="tabpanel" id="step6">
                   @else
                    <div class="tab-pane fade" role="tabpanel" id="step6">
                   @endif
                        <div class="step2">
                         <h5><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cover Note to Service Team</strong><a href="{{ route('pdfview',['phone'=> $gef->gef_id,'download'=> 'pdf']) }}">&nbsp;(Download Cover Note as PDF to send to Service team)</a></h5>

                            <div class="step_21 center_c">

                  <div class="row"> 
                   <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('Link to the docs on the drive') !!} <font color="red">(editable)</font><br>
                             <table>
                               <tbody id="_editable_table">
                                   <tr mChecks-id="{{ $gef->gef_phone }}">
                                 <div class="content">
                                   <td class="editable-col" contenteditable="true" id="td" col-index="13" oldVal ="{{ $outcome->outcome_linktodoc }}">{{ $outcome->outcome_linktodoc }}</td>
                                  </div>
                                   </tr>
                              </tbody>
                             </table> 
                    </div>
                   </div> 
                 </div> 



                           {!! Form::label('Courses Finalized') !!}</br>
                                   (Use these links to finalize course
                                   <a href="{{ url('https://studyspy.ac.nz') }}" target="_blank"><b>STUDYSPY</b></a> &nbsp;&nbsp;&nbsp;
                                   <a href="{{ url('https://google.com') }}" target="_blank"><b>GOOGLE</b></a> &nbsp;&nbsp;&nbsp;
                                   <a href="{{ url('http://ajv.kiwi/education-v2/#Study-areas') }}" target="_blank"><b>AJV.KIWI</b></a> and ensure institution is from AJV
                              <a href="{{ url('https://docs.google.com/spreadsheets/d/14_5ZwJ9HLZEJ6PUxtHWWZoRvKT0OCjCmTGoRQ8Wqhag/edit#gid=0') }}" target="_blank"><b>approved institutions list</b></a>)
                            </br>
                            </br>  
                            <table class="tablesorter" id="keywords" cellspacing="0" cellpadding="0">
                              <thead>
                                <tr>
                                    <th><span>Institution<span></th>
                                    <th><span>Intake<span></th>
                                    <th><span>Campus<span></th>
                                    <th><span>Course<span></th>
                                    <th><span>Start Date<span></th>
                                    <th><span>Course Link <a href="{{ url('https://bitly.com/') }}" target="_blank"><b>(URL shortener)</b></a><span></th>
                                </tr>
                               </thead>
                               <tbody id="outcome1-list" name="outcome1-list">
                                  <tr id="outcome1{{$outcome->gef_phone}}">
                                   <td>{{ $outcome->outcome_inst1 }}</td>
                                   <td>{{ $outcome->outcome_inst1_intake }}</td>
                                   <td>{{ $outcome->outcome_inst1_campus }}</td>
                                   <td>{{ $outcome->outcome_course1 }}</td>
                                   <td>{{ $outcome->outcome_course1_startDate  }}</td>
                                   <td>{{ $outcome->outcome_course1_link  }}</td>
                                   <td>
                                    <button class="btn btn-warning btn-detail open_modal_outcome1" value="{{$outcome->gef_phone}}">Edit</button>
                                    </td>
                                  </tr>
                              </tbody>
                               <tbody id="outcome2-list" name="outcome2-list">
                                  <tr id="outcome2{{$outcome->gef_phone}}">
                                   <td>{{ $outcome->outcome_inst2 }}</td>
                                   <td>{{ $outcome->outcome_inst2_intake }}</td>
                                   <td>{{ $outcome->outcome_inst2_campus }}</td>
                                   <td>{{ $outcome->outcome_course2 }}</td>
                                   <td>{{ $outcome->outcome_course2_startDate  }}</td>
                                   <td>{{ $outcome->outcome_course2_link  }}</td>
                                   <td>
                                    <button class="btn btn-warning btn-detail open_modal_outcome2" value="{{$outcome->gef_phone}}">Edit</button>
                                    </td>
                                  </tr>
                              </tbody>
                               <tbody id="outcome3-list" name="outcome3-list">
                                  <tr id="outcome3{{$outcome->gef_phone}}">
                                   <td>{{ $outcome->outcome_inst3 }}</td>
                                   <td>{{ $outcome->outcome_inst3_intake }}</td>
                                   <td>{{ $outcome->outcome_inst3_campus }}</td>
                                   <td>{{ $outcome->outcome_course3 }}</td>
                                   <td>{{ $outcome->outcome_course3_startDate  }}</td>
                                   <td>{{ $outcome->outcome_course3_link  }}</td>
                                   <td>
                                    <button class="btn btn-warning btn-detail open_modal_outcome3" value="{{$outcome->gef_phone}}">Edit</button>
                                    </td>
                                  </tr>
                              </tbody>
                              </table>     


                            <table class="tablesorter" id="keywords" cellspacing="0" cellpadding="0">
                              <thead>
                                <tr>
                                    <th><span>Lists of mandatory Docs Submitted<span></th>
                                    <th><span>Provided by Adviser<span></th>
                                    <th><span>Type of document<span></th>
                                    <th><span>Accepted by case officer<span></th>
                                </tr>
                               </thead>
                            <?php
                              $user = Auth::user();
                              $employeep = App\employee::where('AJV_EMP_Email','=',$user->email)->first();
                            ?>
                               <tbody id="passport-list" name="passport-list">
                                   <tr id="passport{{$outcome->gef_phone}}">
                                   <td>{{ 'Passport' }}</td>
                                   <td><form class="passport-S-form" method="patch">
                                       <input type="hidden" name="passport_S_id" value="{{ $outcome->gef_phone }}">                   
                                        {{ Form::select('passport_PBA', [
                                          'Yes' => 'Yes',
                                          'No' => 'No'], $outcome->outcome_passport_PBA, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'passport_PBA','name'=>'passport_PBA']) }}</td>
                                   <td>{{ Form::select('passport_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], $outcome->outcome_passport_scan, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'passport_scan','name'=>'passport_scan']) }}</form><div class="form-status-passport"></div> </td>
                                   <td>{{ $outcome->outcome_passport_ACO }}</td>
                                   
                                   </tr>
                              </tbody> 
                               <tbody id="class10-list" name="class10-list">
                                   <tr id="class10{{$outcome->gef_phone}}">
                                   <td>{{ 'Class 10' }}</td>
                                   <td><form class="class10-S-form" method="patch">
                                       <input type="hidden" name="class10_S_id" value="{{ $outcome->gef_phone }}">                   
                                        {{ Form::select('class10_PBA', [
                                          'Yes' => 'Yes',
                                          'No' => 'No'], $outcome->outcome_class10_PBA, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'class10_PBA','name'=>'class10_PBA']) }}</td>
                                   <td>{{ Form::select('class10_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], $outcome->outcome_class10_scan, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'class10_scan','name'=>'class10_scan']) }}</form><div class="form-status-class10"></div> </td>
                                   <td>{{ $outcome->outcome_class10_ACO }}</td>
                                   
                                   </tr>
                              </tbody>

                               <tbody id="class12-list" name="class12-list">
                                   <tr id="class12{{$outcome->gef_phone}}">
                                   <td>{{ 'Class 12' }}</td>
                                   <td><form class="class12-S-form" method="patch">
                                       <input type="hidden" name="class12_S_id" value="{{ $outcome->gef_phone }}">                   
                                        {{ Form::select('class12_PBA', [
                                          'Yes' => 'Yes',
                                          'No' => 'No'], $outcome->outcome_class12_PBA, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'class12_PBA','name'=>'class12_PBA']) }}</td>
                                   <td>{{ Form::select('class12_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], $outcome->outcome_class12_scan, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'class12_scan','name'=>'class12_scan']) }}</form><div class="form-status-class12"></div> </td>
                                   <td>{{ $outcome->outcome_class12_ACO }}</td>
                                   
                                   </tr>
                              </tbody>

                               <tbody id="BC-list" name="BC-list">
                                   <tr id="BC{{$outcome->gef_phone}}">
                                   <td>{{ 'Bachelors - Consolidated' }}</td>
                                   <td><form class="BC-S-form" method="patch">
                                       <input type="hidden" name="BC_S_id" value="{{ $outcome->gef_phone }}">                   
                                        {{ Form::select('BC_PBA', [
                                          'Yes' => 'Yes',
                                          'No' => 'No'], $outcome->outcome_BC_PBA, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'BC_PBA','name'=>'BC_PBA']) }}</td>
                                   <td>{{ Form::select('BC_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], $outcome->outcome_BC_scan, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'BC_scan','name'=>'BC_scan']) }}</form><div class="form-status-BC"></div> </td>
                                   <td>{{ $outcome->outcome_BC_ACO }}</td>
                                   
                                   </tr>
                              </tbody>

                               <tbody id="BSWM-list" name="BSWM-list">
                                   <tr id="BSWM{{$outcome->gef_phone}}">
                                   <td>{{ 'Bachelors - Sem wise marks' }}</td>
                                   <td><form class="BSWM-S-form" method="patch">
                                       <input type="hidden" name="BSWM_S_id" value="{{ $outcome->gef_phone }}">                   
                                        {{ Form::select('BSWM_PBA', [
                                          'Yes' => 'Yes',
                                          'No' => 'No'], $outcome->outcome_BSWM_PBA, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'BSWM_PBA','name'=>'BSWM_PBA']) }}</td>
                                   <td>{{ Form::select('BSWM_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], $outcome->outcome_BSWM_scan, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'BSWM_scan','name'=>'BSWM_scan']) }}</form><div class="form-status-BSWM"></div> </td>
                                   <td>{{ $outcome->outcome_BSWM_ACO }}</td>

                                   </tr>
                              </tbody>


                               <tbody id="BPC-list" name="BPC-list">
                                   <tr id="BPC{{$outcome->gef_phone}}">
                                   <td>{{ 'Bachelors - Provisional Cert' }}</td>
                                   <td><form class="BPC-S-form" method="patch">
                                       <input type="hidden" name="BPC_S_id" value="{{ $outcome->gef_phone }}">                   
                                        {{ Form::select('BPC_PBA', [
                                          'Yes' => 'Yes',
                                          'No' => 'No'], $outcome->outcome_BPC_PBA, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'BPC_PBA','name'=>'BPC_PBA']) }}</td>
                                   <td>{{ Form::select('BPC_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], $outcome->outcome_BPC_scan, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'BPC_scan','name'=>'BPC_scan']) }}</form><div class="form-status-BPC"></div> </td>
                                   <td>{{ $outcome->outcome_BPC_ACO }}</td>

                                   </tr>
                              </tbody>

                               <tbody id="BDC-list" name="BDC-list">
                                   <tr id="BDC{{$outcome->gef_phone}}">
                                   <td>{{ 'Bachelors - Degree Cert' }}</td>
                                   <td><form class="BDC-S-form" method="patch">
                                       <input type="hidden" name="BDC_S_id" value="{{ $outcome->gef_phone }}">                   
                                        {{ Form::select('BDC_PBA', [
                                          'Yes' => 'Yes',
                                          'No' => 'No'], $outcome->outcome_BDC_PBA, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'BDC_PBA','name'=>'BDC_PBA']) }}</td>
                                   <td>{{ Form::select('BDC_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], $outcome->outcome_BDC_scan, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'BDC_scan','name'=>'BDC_scan']) }}</form><div class="form-status-BDC"></div> </td>
                                   <td>{{ $outcome->outcome_BDC_ACO }}</td>

                                   </tr>
                              </tbody>


                               <tbody id="CV-list" name="CV-list">
                                   <tr id="CV{{$outcome->gef_phone}}">
                                   <td>{{ 'CV' }}</td>
                                   <td><form class="CV-S-form" method="patch">
                                       <input type="hidden" name="CV_S_id" value="{{ $outcome->gef_phone }}">                   
                                        {{ Form::select('CV_PBA', [
                                          'Yes' => 'Yes',
                                          'No' => 'No'], $outcome->outcome_CV_PBA, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'CV_PBA','name'=>'CV_PBA']) }}</td>
                                   <td>{{ Form::select('CV_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], $outcome->outcome_CV_scan, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'CV_scan','name'=>'CV_scan']) }}</form><div class="form-status-CV"></div> </td>
                                   <td>{{ $outcome->outcome_CV_ACO }}</td>

                                   </tr>
                              </tbody>

        
                              </table>

                        <h4><u>Mandatory questions before sending it to service</u></h4>
<br>
@if (session('alert1'))
    <div class="alert alert-danger">
        {{ session('alert1') }}
    </div>
@endif
                            <table class="tablesorter" id="keywords" cellspacing="0" cellpadding="0">
                              <thead>
                                <tr>
                                    <th><span>Mandatory Checks<span></th>
                                    <th><span>Checked by Adviser<span></th>
                                    <th><span>Accepted by case officer<span></th>
                                    <th><span><span></th>
                                    <th><span><span></th>
                                    <th><span><span></th>
                                    <th><span><span></th>
                                </tr>
                               </thead>
                               <tbody id="mchecks-list" name="mchecks-list">
                                   <tr id="mchecks{{$outcome->gef_phone}}">
                                   <td>{{ 'Academics Requriements Met' }}</td>
                                   <td><form class="ARM-S-form" method="patch">
                                       <input type="hidden" name="ARM_S_id" value="{{ $outcome->gef_phone }}">                   
                                        {{ Form::select('ARM_CBA', [
                                          'Yes' => 'Yes',
                                          'No' => 'No'], $outcome->outcome_ARM_CBA, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'ARM_CBA','name'=>'ARM_CBA']) }}</form><div class="form-status-ARM-CBA"></div> </td> 
                                   <td>{{ $outcome->outcome_ARM_ACO }}</td>
                                   
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   </tr>
                              </tbody>


                               <tbody id="english1-list" name="english1-list">
                                   <tr id="english1{{$outcome->gef_phone}}">
                                   <td>{{ 'Ielts/pte Requirements Met' }}</td>
                                   <td><form class="ERM-S-form" method="patch">
                                       <input type="hidden" name="ERM_S_id" value="{{ $outcome->gef_phone }}">                   
                                        {{ Form::select('ERM_CBA', [
                                          'Yes' => 'Yes',
                                          'No' => 'No'], $outcome->outcome_ERM_CBA, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'ERM_CBA','name'=>'ERM_CBA']) }}</form><div class="form-status-ERM-CBA"></div> </td>              
                                   <td>{{ $outcome->outcome_ERM_ACO }}</td>
                                   
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   </tr>
                              </tbody>



                               <tbody id="files-list" name="files-list">
                                   <tr id="files{{$outcome->gef_phone}}">
                                   <td>{{ 'Files Named Correctly' }}</td>
                                   <td><form class="FNC-S-form" method="patch">
                                       <input type="hidden" name="FNC_S_id" value="{{ $outcome->gef_phone }}">                   
                                        {{ Form::select('FNC_CBA', [
                                          'Yes' => 'Yes',
                                          'No' => 'No'], $outcome->outcome_FNC_CBA, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'FNC_CBA','name'=>'FNC_CBA']) }}</form><div class="form-status-FNC-CBA"></div> </td> 
                                   <td>{{ $outcome->outcome_FNC_ACO }}</td>
                                   </tr>
                              </tbody>

                               <tbody id="scan-list" name="scan-list">
                                   <tr id="scan{{$outcome->gef_phone}}">
                                   <td>{{ 'Files Scanned Properly' }}</td>
                                   <td><form class="FSP-S-form" method="patch">
                                       <input type="hidden" name="FSP_S_id" value="{{ $outcome->gef_phone }}">                   
                                        {{ Form::select('FSP_CBA', [
                                          'Yes' => 'Yes',
                                          'No' => 'No'], $outcome->outcome_FSP_CBA, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'FSP_CBA','name'=>'FSP_CBA']) }}</form><div class="form-status-FSP-CBA"></div> </td>   
                                 <td>{{ $outcome->outcome_FSP_ACO }}</td>
                                   </tr>
                              </tbody>  
                             </table> 



@if($visa === null)

                            {!! Form::model($gef, ['route' => ['visa_store', $gef->gef_id]]) !!}


                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('1. Any previous visa rejections including New Zealand ?') !!}
                                {{ Form::select('rejection', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'],null, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'rejection']
                                ) }}        
                  
                          </div>
                         </div>
                       </div>

                      <div style='display:none; id='rejectComments' class='rejectComments'> 
                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('Rejection Comments!!!!') !!}
                               {!! Form::textarea('reject_notes', null, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}                   
                          </div>
                         </div>
                       </div>
                      </div>

                        <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>          
                               {!! Form::label('2. Is the student aware of any fees that applies to him (previous visa rejection fees or any other fees)') !!}
                                {{ Form::select('fees', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'fees']
                                ) }} 
                            </div>
                           </div>
                         </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('3. Why are you pursuing this particular course and what are your future plans in regards to it? ') !!}
                               {!! Form::textarea('course_notes', null, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}                   
                          </div>
                         </div>
                       </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('4. Is there any gap in your profile?') !!}
                                {{ Form::select('gap', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'gap']
                                ) }}                
                          </div>
                         </div>
                       </div>

                      <div style='display:none; id='gapComments' class='gapComments'> 
                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('Profile gap Comments!!!!') !!}
                               {!! Form::textarea('gap_notes', null, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}                   
                          </div>
                         </div>
                       </div>
                     </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('5. Marital Status?') !!}
                                {{ Form::select('marital', [
                                   'Married' => 'Married',
                                   'Single' => 'Single'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'marital']
                                ) }}                
                          </div>
                         </div>
                       </div>

                      <div style='display:none; id='maritalComments' class='maritalComments'> 
                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('Do you plan to take your spouse and children along with you?') !!}
                                {{ Form::select('spouse', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control','id' => 'spouse']
                                ) }}                   
                          </div>
                         </div>
                       </div>
                      </div>

                      <div style='display:none; id='spouseComments' class='spouseComments'> 
                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('Are you aware of spouse and kids visa fee?') !!}
                                {{ Form::select('family_fee', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control','id' => 'family_fee']
                                ) }}                
                          </div>
                         </div>
                       </div>
                      </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('6. Are you aware of living expenses?') !!}
                                {{ Form::select('expenses', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control','id' => 'stat']
                                ) }}                
                          </div>
                         </div>
                       </div>


@else
                        {!! Form::model($gef, ['method' => 'PATCH','route' => ['visa_update', $gef->gef_id]]) !!}           

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('1. Any previous visa rejections including New Zealand ?') !!}
                                {{ Form::select('rejection', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'],$visa->visa_rejection, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'rejection']
                                ) }}        
                  
                          </div>
                         </div>
                       </div>

                      @if($visa->visa_rejNotes)  
                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('Rejection Comments!!!!') !!}
                               {!! Form::textarea('reject_notes', $visa->visa_rejNotes, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}                   
                          </div>
                         </div>
                       </div>
                      @endif 

                        <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">
                            <span class="required"></span>          
                               {!! Form::label('2. Is the student aware of any fees that applies to him (previous visa rejection fees or any other fees)') !!}
                                {{ Form::select('fees', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], $visa->visa_fees, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'fees']
                                ) }} 
                            </div>
                           </div>
                         </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('3. Why are you pursuing this particular course and what are your future plans in regards to it? ') !!}
                               {!! Form::textarea('course_notes', $visa->visa_course, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}                   
                          </div>
                         </div>
                       </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('4. Is there any gap in your profile?') !!}
                                {{ Form::select('gap', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], $visa->visa_gap, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'gap']
                                ) }}                
                          </div>
                         </div>
                       </div>

                      @if($visa->visa_gapNotes)
                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('Profile gap Comments!!!!') !!}
                               {!! Form::textarea('gap_notes', $visa->visa_gapNotes, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'comments')) 
                               !!}                   
                          </div>
                         </div>
                       </div>
                      @endif

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('5. Marital Status?') !!}
                                {{ Form::select('marital', [
                                   'Married' => 'Married',
                                   'Single' => 'Single'], $visa->visa_martial, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'marital']
                                ) }}                
                          </div>
                         </div>
                       </div>

                      @if($visa->visa_spouse) 
                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('Do you plan to take your spouse and children along with you?') !!}
                                {{ Form::select('spouse', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], $visa->visa_spouse, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'spouse']
                                ) }}                   
                          </div>
                         </div>
                       </div>
                      @endif

                      @if($visa->visa_familyFee) 
                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('Are you aware of spouse and kids visa fee?') !!}
                                {{ Form::select('family_fee', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], $visa->visa_familyFee, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'family_fee']
                                ) }}                
                          </div>
                         </div>
                       </div>
                      @endif

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group"> 
                            <span class="required"></span>   
                           {!! Form::label('6. Are you aware of living expenses?') !!}
                                {{ Form::select('expenses', [
                                   'Yes' => 'Yes',
                                   'No' => 'No'], $admission->admission_expenses, ['placeholder' => 'Select', 'class' => 'form-control', 'required' => '','id' => 'stat']
                                ) }}                
                          </div>
                         </div>
                       </div>


@endif


                       <div class="row">
                        <div class="col-md-1">
                         <div class="form-group">
                            {!! Form::hidden('addedBy', $emp_loggedin->AJV_EMP_Fname . ' ' . $emp_loggedin->AJV_EMP_Lname . ', ' . $emp_loggedin->AJV_EMP_designation) !!}
                            {!! Form::submit('Covert to APP', 
                              array('class'=>'btn btn-primary','id' => 'submit')) !!}
                         </div>
                        </div>

                            {!! Form::close() !!}

                         <script>

                          $(document).ready(function(){
                           $('#passport').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.passportComments').show();

                             }
                             else
                             { 
                               $('.passportComments').hide();
                             }
                           });
                           $('#family_fee').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.familyComments').show();

                             }
                             else
                             { 
                               $('.familyComments').hide();
                             }
                           });
                           $('#spouse').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.spouseComments').show();

                             }
                             else
                             { 
                               $('.spouseComments').hide();
                             }
                           });
                           $('#marital').on('change', function() {
                             if ( this.value == 'Married')
                             {
                               $('.maritalComments').show();

                             }
                             else
                             { 
                               $('.maritalComments').hide();
                             }
                           });
                           $('#gap').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.gapComments').show();

                             }
                             else
                             { 
                               $('.gapComments').hide();
                             }
                           });
                           $('#rejection').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.rejectComments').show();

                             }
                             else
                             { 
                               $('.rejectComments').hide();
                             }
                           });
                           $('#country').on('change', function() {
                             if ( this.value == 'Yes')
                             {
                               $('.countryComments').show();

                             }
                             else
                             { 
                               $('.countryComments').hide();
                             }
                           });
                          });

                        </script>


                            
                          </div>
                            <div class="step-22">

                 <?php
                  if($gef->gef_prev_status != 'Drop Pending'){

                       $comments = App\comments::where('comment_process_id', '=', $outcome->outcome_ID)->where('comment_process_name', '=', 'outcome')->orderBy('comment_id', 'DESC')->get();
                  }
                 ?> 
                  <div class="row">
                     {!! Form::label('&nbsp;&nbsp;&nbsp;&nbsp;Comments (Writing Comments is mandatory)') !!}
                    </div>
                    <div class="row" id="addcomment">
                     {!! Form::open(array('route' => 'comments_store', 'files' => true)) !!}
                            <div class="row"> 
                              <div class="col-md-8">
                               <div class="form-group">                     
                                 {!! Form::textarea('comment', null, 
                                        array('required', 
                                        'class'=>'form-control', 
                                        'placeholder'=>'Write Comments')) !!}
                              </div>
                             </div>
                              <div class="col-md-1">
                               <div class="form-group">   
                                 <br>
                                 <br>
                                 <br>                           
                                 <input type="hidden" name="process_id" value="{{ $outcome->outcome_ID }}">
                                 <input type="hidden" name="process_name" value="outcome">
                                 <input type="hidden" name="process_phone" value="{{ $outcome->gef_phone }}">   
                                 <button class="btn btn-primary">Add Comment</button>
                               </div>
                              </div>                                
                            </div>                                                          
                     {!! Form::close() !!}
                    </div>
                    <hr>
                    @if(!empty($comments))
                     @foreach($comments as $comment)                    
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{$comment->comment_user}}</strong> {{$comment->comment_time}}</small>
                        </div>    
                        <p>{{$comment->comments}}</p>
                      </div>
                     @endforeach
                    @endif    
                @if($outcome->outcome_comments != null) 
                      <div class="row comment">
                        <div class="head">
                          <small><strong class='user'>{{$outcome->added_by}}</strong> {{$outcome->updated_at}}</small>
                        </div>    
                        <p>{{$outcome->outcome_comments}}</p>
                      </div>
                @endif 


                            
                            </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                        </ul>
                    </div>


                       <!--  outcome1 MODAL -->
                              <div class="modal fade" id="myoutcome1" tabindex="-1" role="dialog" aria-labelledby="myoutcome1Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myoutcome1Label">Institute and Course Details</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Institution</label>
                                       <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="outcome_inst1" name="outcome_inst1" placeholder="Institution" value="">
                                       </div>
                                       </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Intake</label>
                                        <div class="col-sm-9">
                                {{ Form::select('outcome_inst1_intake', [
                                   'JFM - This Year' => 'JFM - This year',
                                   'AMJ - This Year' => 'AMJ - This year',
                                   'JAS - This Year' => 'JAS - This year',
                                   'OND - This Year' => 'OND - This year',
                                   'JFM - Next Year' => 'JFM - Next year',
                                   'AMJ - Next Year' => 'AMJ - Next year',
                                   'JAS - Next Year' => 'JAS - Next year',
                                   'OND - Next Year' => 'OND - Next year'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_inst1_intake', 'required' => '']
                                ) }}
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Campus</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_inst1_campus" name="outcome_inst1_campus" placeholder="Campus" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Course</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" id="outcome_course1" name="outcome_course1" placeholder="Course" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Start Date</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="outcome_course1_startDate" id="outcome_course1_startDate" readonly="readonly" class="form-control clsDatePicker">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Course Link</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" name="outcome_course1_link" id="outcome_course1_link" placeholder="Link" value="">
                                        </div>
                                    </div>
                                    
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-outcome1" value="add">Submit Details</button>
                                        <input type="hidden" id="outcome1_id" name="outcome1_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>



                              <!--  outcome3 MODAL -->
                              <div class="modal fade" id="myoutcome3" tabindex="-1" role="dialog" aria-labelledby="myoutcome3Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myoutcome3Label">Institute and Course Details</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Institution</label>
                                       <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="outcome_inst3" name="outcome_inst3" placeholder="Institution" value="">
                                       </div>
                                       </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Intake</label>
                                        <div class="col-sm-9">
                                {{ Form::select('outcome_inst3_intake', [
                                   'JFM - This Year' => 'JFM - This year',
                                   'AMJ - This Year' => 'AMJ - This year',
                                   'JAS - This Year' => 'JAS - This year',
                                   'OND - This Year' => 'OND - This year',
                                   'JFM - Next Year' => 'JFM - Next year',
                                   'AMJ - Next Year' => 'AMJ - Next year',
                                   'JAS - Next Year' => 'JAS - Next year',
                                   'OND - Next Year' => 'OND - Next year'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_inst3_intake', 'required' => '']
                                ) }}
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Campus</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_inst3_campus" name="outcome_inst3_campus" placeholder="Campus" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Course</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="outcome_course3" name="outcome_course3" placeholder="Course" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Start Date</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="outcome_course3_startDate" id="outcome_course3_startDate" readonly="readonly" class="form-control clsDatePicker">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Course Link</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" name="outcome_course3_link" id="outcome_course3_link" placeholder="Link" value="">
                                        </div>
                                    </div>
                                    
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-outcome3" value="add">Submit Details</button>
                                        <input type="hidden" id="outcome3_id" name="outcome3_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>


                                  <!--  scan MODAL -->
                              <div class="modal fade" id="myscan" tabindex="-1" role="dialog" aria-labelledby="myscanLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myscanLabel">Files Scanned Properly</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Checked by Adviser</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_FSP_CBA', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_FSP_CBA', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by case officer</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_FSP_ACO" name="outcome_FSP_ACO" readonly="readonly" value="">
                                        </div>
                                    </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-scan" value="add">Submit Details</button>
                                        <input type="hidden" id="scan_id" name="scan_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  scan MODAL service -->
                              <div class="modal fade" id="myscanS" tabindex="-1" role="dialog" aria-labelledby="myscanSLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myscanSLabel">Files Scanned Properly</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Checked by Adviser</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_FSP_CBA" name="outcome_FSP_CBA" readonly="readonly" value="">
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by case officer</label>
                                        <div class="col-sm-9">
                                       {{ Form::select('outcome_FSP_ACO', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_FSP_ACO', 'required' => '']
                                        ) }}
                                        </div>
                                    </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-scanS" value="add">Submit Details</button>
                                        <input type="hidden" id="scanS_id" name="scanS_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  files MODAL -->
                              <div class="modal fade" id="myfiles" tabindex="-1" role="dialog" aria-labelledby="myfilesLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myfilesLabel">Files Named Correctly</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Checked by Adviser</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_FNC_CBA', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_FNC_CBA', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by case officer</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_FNC_ACO" name="outcome_FNC_ACO" readonly="readonly" value="">
                                        </div>
                                    </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-files" value="add">Submit Details</button>
                                        <input type="hidden" id="files_id" name="files_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  files MODAL service-->
                              <div class="modal fade" id="myfilesS" tabindex="-1" role="dialog" aria-labelledby="myfilesSLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myfilesSLabel">Files Named Correctly</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Checked by Adviser</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_FNC_CBA" name="outcome_FNC_CBA" readonly="readonly" value="">
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by case officer</label>
                                        <div class="col-sm-9">
                                       {{ Form::select('outcome_FNC_ACO', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_FNC_ACO', 'required' => '']
                                        ) }}
                                        </div>
                                    </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-filesS" value="add">Submit Details</button>
                                        <input type="hidden" id="filesS_id" name="filesS_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  english1 MODAL Sales -->
                              <div class="modal fade" id="myenglish1" tabindex="-1" role="dialog" aria-labelledby="myenglish1Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myenglish1Label">Ielts/pte Requirements Met</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Checked by Adviser</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_ERM_CBA', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_ERM_CBA', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by case officer</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_ERM_ACO" name="outcome_ERM_ACO" readonly="readonly" value="">

                                        </div>
                                    </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-english1" value="add">Submit Details</button>
                                        <input type="hidden" id="english1_id" name="english1_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  english1 MODAL Service -->
                              <div class="modal fade" id="myenglish1S" tabindex="-1" role="dialog" aria-labelledby="myenglish1SLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myenglish1SLabel">Ielts/pte Requirements Met</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Checked by Adviser</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_ERM_CBA" name="outcome_ERM_CBA" readonly="readonly" value="">
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by case officer</label>
                                        <div class="col-sm-9">
                                       {{ Form::select('outcome_ERM_ACO', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_ERM_ACO', 'required' => '']
                                        ) }}
                                        </div>
                                    </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-english1S" value="add">Submit Details</button>
                                        <input type="hidden" id="english1_idS" name="english1_idS" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>


                                  <!--  mchecks MODAL sales -->
                              <div class="modal fade" id="mymchecks" tabindex="-1" role="dialog" aria-labelledby="mymchecksLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="mymchecksLabel">Academic Requirements Met</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Checked by Adviser</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_ARM_CBA', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_ARM_CBA', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by case officer</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_ARM_ACO" name="outcome_ARM_ACO" readonly="readonly" value="">

                                        </div>
                                    </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-mchecks" value="add">Submit Details</button>
                                        <input type="hidden" id="mchecks_id" name="mchecks_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  mchecks MODAL service -->
                              <div class="modal fade" id="mymchecksS" tabindex="-1" role="dialog" aria-labelledby="mymchecksSLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="mymchecksSLabel">Academic Requirements Met</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Checked by Adviser</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_ARM_CBA" name="outcome_ARM_CBA" readonly="readonly" value="">
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by case officer</label>
                                        <div class="col-sm-9">
                                       {{ Form::select('outcome_ARM_ACO', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_ARM_ACO', 'required' => '']
                                        ) }}

                                        </div>
                                    </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-mchecksS" value="add">Submit Details</button>
                                        <input type="hidden" id="mchecksS_id" name="mchecksS_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  Passport MODAL Sales -->
                              <div class="modal fade" id="mypassport" tabindex="-1" role="dialog" aria-labelledby="mypassportLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="mypassportLabel">Passport</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_passport_PBA', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_passport_PBA', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       {{ Form::select('outcome_passport_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_passport_scan', 'required' => '']
                                        ) }}
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by Case Officer</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_passport_ACO" name="outcome_passport_ACO" readonly="readonly" value="">
                                        </div>
                                    </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-passport" value="add">Submit Details</button>
                                        <input type="hidden" id="passport_id" name="passport_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  Passport MODAL Service -->
                              <div class="modal fade" id="mypassportS" tabindex="-1" role="dialog" aria-labelledby="mypassportLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="mypassportLabel">Passport</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_passport_PBA" name="outcome_passport_PBA" readonly="readonly" placeholder="Campus" value="">
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_passport_scan" name="outcome_passport_scan" readonly="readonly" placeholder="Campus" value="">
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputName" class="col-sm-3 control-label">Approved by Case Officer</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_passport_ACO', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_passport_ACO', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-passportS" value="add">Submit Details</button>
                                        <input type="hidden" id="passportS_id" name="passportS_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  Class10 MODAL Sales -->
                              <div class="modal fade" id="myclass10" tabindex="-1" role="dialog" aria-labelledby="myclass10Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myclass10Label">Class 10</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_class10_PBA', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_class10_PBA', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       {{ Form::select('outcome_class10_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_class10_scan', 'required' => '']
                                        ) }}
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by Case Officer</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_class10_ACO" name="outcome_class10_ACO" readonly="readonly" value="">
                                        </div>
                                    </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-class10" value="add">Submit Details</button>
                                        <input type="hidden" id="class10_id" name="class10_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  Class10 MODAL Service -->
                              <div class="modal fade" id="myclass10S" tabindex="-1" role="dialog" aria-labelledby="myclass10Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myclass10Label">Class 10</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_class10_PBA" name="outcome_class10_PBA" readonly="readonly" placeholder="Campus" value="">
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_class10_scan" name="outcome_class10_scan" readonly="readonly" placeholder="Campus" value="">
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputName" class="col-sm-3 control-label">Approved by Case Officer</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_class10_ACO', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_class10_ACO', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-class10S" value="add">Submit Details</button>
                                        <input type="hidden" id="class10S_id" name="class10S_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  class12 MODAL Sales -->
                              <div class="modal fade" id="myclass12" tabindex="-1" role="dialog" aria-labelledby="myclass12Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myclass12Label">Class 12</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_class12_PBA', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_class12_PBA', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       {{ Form::select('outcome_class12_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_class12_scan', 'required' => '']
                                        ) }}
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by Case Officer</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_class12_ACO" name="outcome_class12_ACO" readonly="readonly" value="">
                                        </div>
                                    </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-class12" value="add">Submit Details</button>
                                        <input type="hidden" id="class12_id" name="class12_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  class12 MODAL Service -->
                              <div class="modal fade" id="myclass12S" tabindex="-1" role="dialog" aria-labelledby="myclass12Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myclass12Label">Class 12</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_class12_PBA" name="outcome_class12_PBA" readonly="readonly" placeholder="Campus" value="">
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_class12_scan" name="outcome_class12_scan" readonly="readonly" placeholder="Campus" value="">
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputName" class="col-sm-3 control-label">Approved by Case Officer</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_class12_ACO', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_class12_ACO', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-class12S" value="add">Submit Details</button>
                                        <input type="hidden" id="class12S_id" name="class12S_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  BC MODAL Sales -->
                              <div class="modal fade" id="myBC" tabindex="-1" role="dialog" aria-labelledby="myBCLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myBCLabel">Bachelors - Consolidated</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_BC_PBA', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_BC_PBA', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       {{ Form::select('outcome_BC_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_BC_scan', 'required' => '']
                                        ) }}
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by Case Officer</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_BC_ACO" name="outcome_BC_ACO" readonly="readonly" value="">
                                        </div>
                                    </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-BC" value="add">Submit Details</button>
                                        <input type="hidden" id="BC_id" name="BC_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  BC MODAL Service -->
                              <div class="modal fade" id="myBCS" tabindex="-1" role="dialog" aria-labelledby="myBCLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myBCLabel">Bachelors - Consolidated</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_BC_PBA" name="outcome_BC_PBA" readonly="readonly" placeholder="Campus" value="">
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_BC_scan" name="outcome_BC_scan" readonly="readonly" placeholder="Campus" value="">
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputName" class="col-sm-3 control-label">Approved by Case Officer</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_BC_ACO', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_BC_ACO', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-BCS" value="add">Submit Details</button>
                                        <input type="hidden" id="BCS_id" name="BCS_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  BSWM MODAL Sales -->
                              <div class="modal fade" id="myBSWM" tabindex="-1" role="dialog" aria-labelledby="myBSWMLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myBSWMLabel">Bachelors - Sem wise marks</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_BSWM_PBA', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_BSWM_PBA', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       {{ Form::select('outcome_BSWM_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_BSWM_scan', 'required' => '']
                                        ) }}
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by Case Officer</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_BSWM_ACO" name="outcome_BSWM_ACO" readonly="readonly" value="">
                                        </div>
                                    </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-BSWM" value="add">Submit Details</button>
                                        <input type="hidden" id="BSWM_id" name="BSWM_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  BSWM MODAL Service -->
                              <div class="modal fade" id="myBSWMS" tabindex="-1" role="dialog" aria-labelledby="myBSWMLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myBSWMLabel">Bachelors - Sem wise marks</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_BSWM_PBA" name="outcome_BSWM_PBA" readonly="readonly" placeholder="Campus" value="">
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_BSWM_scan" name="outcome_BSWM_scan" readonly="readonly" placeholder="Campus" value="">
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputName" class="col-sm-3 control-label">Approved by Case Officer</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_BSWM_ACO', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_BSWM_ACO', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-BSWMS" value="add">Submit Details</button>
                                        <input type="hidden" id="BSWMS_id" name="BSWMS_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  BPC MODAL Sales -->
                              <div class="modal fade" id="myBPC" tabindex="-1" role="dialog" aria-labelledby="myBPCLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myBPCLabel">Bachelors - Provisional Cert</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_BPC_PBA', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_BPC_PBA', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       {{ Form::select('outcome_BPC_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_BPC_scan', 'required' => '']
                                        ) }}
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by Case Officer</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_BPC_ACO" name="outcome_BPC_ACO" readonly="readonly" value="">
                                        </div>
                                    </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-BPC" value="add">Submit Details</button>
                                        <input type="hidden" id="BPC_id" name="BPC_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  BPC MODAL Service -->
                              <div class="modal fade" id="myBPCS" tabindex="-1" role="dialog" aria-labelledby="myBPCLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myBPCLabel">Bachelors - Provisional Cert</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_BPC_PBA" name="outcome_BPC_PBA" readonly="readonly" placeholder="Campus" value="">
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_BPC_scan" name="outcome_BPC_scan" readonly="readonly" placeholder="Campus" value="">
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputName" class="col-sm-3 control-label">Approved by Case Officer</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_BPC_ACO', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_BPC_ACO', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-BPCS" value="add">Submit Details</button>
                                        <input type="hidden" id="BPCS_id" name="BPCS_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  BDC MODAL Sales -->
                              <div class="modal fade" id="myBDC" tabindex="-1" role="dialog" aria-labelledby="myBDCLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myBDCLabel">Bachelors - Degree Cert</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_BDC_PBA', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_BDC_PBA', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       {{ Form::select('outcome_BDC_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_BDC_scan', 'required' => '']
                                        ) }}
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by Case Officer</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_BDC_ACO" name="outcome_BDC_ACO" readonly="readonly" value="">
                                        </div>
                                    </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-BDC" value="add">Submit Details</button>
                                        <input type="hidden" id="BDC_id" name="BDC_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  BDC MODAL Service -->
                              <div class="modal fade" id="myBDCS" tabindex="-1" role="dialog" aria-labelledby="myBDCLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myBDCLabel">Bachelors - Degree Cert</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_BDC_PBA" name="outcome_BDC_PBA" readonly="readonly" placeholder="Campus" value="">
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_BDC_scan" name="outcome_BDC_scan" readonly="readonly" placeholder="Campus" value="">
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputName" class="col-sm-3 control-label">Approved by Case Officer</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_BDC_ACO', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_BDC_ACO', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-BDCS" value="add">Submit Details</button>
                                        <input type="hidden" id="BDCS_id" name="BDCS_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  CV MODAL Sales -->
                              <div class="modal fade" id="myCV" tabindex="-1" role="dialog" aria-labelledby="myCVLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myCVLabel">CV</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_CV_PBA', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_CV_PBA', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       {{ Form::select('outcome_CV_scan', [
                                         'Orginal' => 'Orginal',
                                         'Copy' => 'Copy',
                                         'Notarized' => 'Notarized'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_CV_scan', 'required' => '']
                                        ) }}
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Accepted by Case Officer</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_CV_ACO" name="outcome_CV_ACO" readonly="readonly" value="">
                                        </div>
                                    </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-CV" value="add">Submit Details</button>
                                        <input type="hidden" id="CV_id" name="CV_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                  <!--  CV MODAL Service -->
                              <div class="modal fade" id="myCVS" tabindex="-1" role="dialog" aria-labelledby="myCVLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myCVLabel">CV</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Provided by Adviser</label>
                                       <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_CV_PBA" name="outcome_CV_PBA" readonly="readonly" placeholder="Campus" value="">
                                   </div>
                                 </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Type of document</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_CV_scan" name="outcome_CV_scan" readonly="readonly" placeholder="Campus" value="">
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputName" class="col-sm-3 control-label">Approved by Case Officer</label>
                                       <div class="col-sm-9">
                                       {{ Form::select('outcome_CV_ACO', [
                                         'Yes' => 'Yes',
                                         'No' => 'No'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_CV_ACO', 'required' => '']
                                        ) }}
                                   </div>
                                 </div>

                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-CVS" value="add">Submit Details</button>
                                        <input type="hidden" id="CVS_id" name="CVS_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>


                               <!--Outcome Comments Modal-->    
                        <div class="modal fade" id="myoutcomecomments" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Update Comments</h4>
                                </div>
                                <div class="modal-body">
                                <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Comments</label>
                                       <div class="col-sm-9">
                                        <textarea type="text" class="form-control has-error" id="outcome_comments" name="outcome_comments" value=""></textarea>
                                       </div>
                                       </div>
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-outcome-comments" value="add">Update Comments</button>
                                        <input type="hidden" id="outcome_comments_id" name="outcome_comments_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                 <!--  Outcome2 MODAL -->
                              <div class="modal fade" id="myoutcome2" tabindex="-1" role="dialog" aria-labelledby="myoutcome2Label" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myoutcome2Label">Institute and Course Details</h4>
                                </div>
                                <div class="modal-body">
                                 <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Institution</label>
                                       <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="outcome_inst2" name="outcome_inst2" placeholder="Institution" value="">
                                       </div>
                                       </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Intake</label>
                                        <div class="col-sm-9">
                                {{ Form::select('outcome_inst2_intake', [
                                   'JFM - This Year' => 'JFM - This year',
                                   'AMJ - This Year' => 'AMJ - This year',
                                   'JAS - This Year' => 'JAS - This year',
                                   'OND - This Year' => 'OND - This year',
                                   'JFM - Next Year' => 'JFM - Next year',
                                   'AMJ - Next Year' => 'AMJ - Next year',
                                   'JAS - Next Year' => 'JAS - Next year',
                                   'OND - Next Year' => 'OND - Next year'], null, ['placeholder' => 'Select', 'class' => 'form-control', 'id' => 'outcome_inst2_intake', 'required' => '']
                                ) }}
                                        </div>
                                    </div>
                                       <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Campus</label>
                                        <div class="col-sm-9">
                                       <input type="text" class="form-control" id="outcome_inst2_campus" name="outcome_inst2_campus" placeholder="Campus" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Course</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="outcome_course2" name="outcome_course2" placeholder="Course" value="">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Start Date</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="outcome_course2_startDate" id="outcome_course2_startDate" readonly="readonly" class="form-control clsDatePicker">
                                    </div>
                                     <div class="form-group">
                                     <label for="inputDetail1" class="col-sm-3 control-label">Course Link</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" name="outcome_course2_link" id="outcome_course2_link" placeholder="Link" value="">
                                        </div>
                                    </div>
                                    
                                       </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save-outcome2" value="add">Submit Details</button>
                                        <input type="hidden" id="outcome2_id" name="outcome2_id" value="0">
                                        </div>
                                    </div>
                                  </div>
                              </div>
      

                    <!-- End of Outcome Tab -->

                    <div class="clearfix"></div>
                </div>
            </form>
        </div>

        <meta name="_token" content="{!! csrf_token() !!}" />
<script src="{{asset('/public/js/sales_gonogo.js')}}"></script>

<meta name="_tokenenglish" content="{!! csrf_token() !!}" />
<script src="{{asset('/public/js/sales_english.js')}}"></script>
<script src="{{asset('/public/js/sales_english_pte.js')}}"></script>
<script src="{{asset('/public/js/sales_english_plan.js')}}"></script>
<script src="{{asset('/public/js/sales_english_comments.js')}}"></script>
<script src="{{asset('/public/js/sales_academics_qualification1.js')}}"></script>
<script src="{{asset('/public/js/sales_academics_qualification2.js')}}"></script>
<script src="{{asset('/public/js/sales_academics_qualification3.js')}}"></script>
<script src="{{asset('/public/js/sales_academics_qualification4.js')}}"></script>
<script src="{{asset('/public/js/sales_academics_comments.js')}}"></script>
<script src="{{asset('/public/js/sales_work_work1.js')}}"></script>
<script src="{{asset('/public/js/sales_work_work2.js')}}"></script>
<script src="{{asset('/public/js/sales_work_comments.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_outcome1.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_outcome2.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_outcome3.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_comments.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_english1.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_english1S.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_mchecks.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_mchecksS.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_files.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_scan.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_filesS.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_scanS.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_passport.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_passportS.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_class10.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_class10S.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_class12.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_class12S.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_BC.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_BCS.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_BSWM.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_BSWMS.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_BPC.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_BPCS.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_BDC.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_BDCS.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_CV.js')}}"></script>
<script src="{{asset('/public/js/sales_outcome_CVS.js')}}"></script>
<script src="{{asset('/public/js/sales_gonogo1.js')}}"></script>
<script src="{{asset('/public/js/sales_finance.js')}}"></script>



<script type="text/javascript"> 

   $('#dob-60').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: "-60y",
     yearRange: "-60:-10",
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

  $('#gonogo_dob').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: "-60y",
     yearRange: "-60:-10",
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });
 
 $('#visa_ajvProcessDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

 $('#visa_appExpectDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

$('#visa_aipDeadlineDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });


$('#visa_aipUploadDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

 $('#visa_visaAppliedDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

$('#visa_evisaDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

 $('#onshore_bookedOn').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

 $('#pcc_appliedDate').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

 $('#med_appliedDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#english_test_plan_dte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#academics_yearOfPassing1').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: "-60y",
     yearRange: "-60:+10",
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#academics_yearOfPassing2').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '-60y',
     yearRange: "-60:+10",
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#academics_yearOfPassing3').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: "-60y",
     yearRange: "-60:+10",
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#academics_yearOfPassing4').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '-60y',
     yearRange: "-60:+10",
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#work_exp_employmentPeriod1').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: "-60y",
     yearRange: "-60:-10",
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#work_exp_employmentPeriod2').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: "-60y",
     yearRange: "-60:-10",
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#work_exp_employmentTo1').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: "-60y",
     yearRange: "-60:-10",
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#work_exp_employmentTo2').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: "-60y",
     yearRange: "-60:-10",
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#outcome_course1_startDate').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#outcome_course2_startDate').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#outcome_course3_startDate').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#admission_appliedDate1').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#admission_appliedDate2').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#admission_appliedDate3').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#admission_insStartDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#admission_insExtDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#admission_insBkpDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

  $('#reminder').datepicker({
     dateFormat: 'yy-mm-dd',
     minDate: "-6y",
     yearRange: "-0:+2",
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

    </section>

  </div>
</div>
@else

 <div class="row">
   <div class="col-md-7">    
      <ul class="list-inline pull-right">
          <img src={{ asset("/public/images/noAccess.jpg") }} alt="ajv" style="height:280px;">
      </ul>                          
   </div> 
 </div>  
     
<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The enquiry is yet to be assigned to an advisor<h3>

@endif

                 </div>
                  
                  <!--  End of Sales tab
                      Start of Service tab -->
            <div class="tab-pane fade" id="messages">
            <div class="text-center">
              <i class="img-intro icon-checkmark-circle"></i>
          </div>
          <h1>Service Process</h1>

   @if($outcome->outcome_status === 'Approved') 
    <div class="container">
</div>

</div>


<meta name="_tokenenglish" content="{!! csrf_token() !!}" />
<script src="{{asset('/public/js/service_admission_admission1.js')}}"></script>
<script src="{{asset('/public/js/service_admission_admission2.js')}}"></script>
<script src="{{asset('/public/js/service_admission_admission3.js')}}"></script>
<script src="{{asset('/public/js/service_admission_finalIns.js')}}"></script>
<script src="{{asset('/public/js/service_admission_insDates.js')}}"></script>
<script src="{{asset('/public/js/service_admission_comments.js')}}"></script>
<script src="{{asset('/public/js/service_funds_courseFee.js')}}"></script>
<script src="{{asset('/public/js/service_funds_comments.js')}}"></script>
<script src="{{asset('/public/js/service_pcc.js')}}"></script>
<script src="{{asset('/public/js/service_pcc_comments.js')}}"></script>

<script src="{{asset('/public/js/service_med.js')}}"></script>
<script src="{{asset('/public/js/service_med_comments.js')}}"></script>

<script src="{{asset('/public/js/service_visa.js')}}"></script>

<script src="{{asset('/public/js/service_onshore.js')}}"></script>
<script src="{{asset('/public/js/service_onshore_comments.js')}}"></script>

<script type="text/javascript"> 

 
 $('#visa_ajvProcessDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

 $('#visa_appExpectDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

$('#visa_aipDeadlineDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });


$('#visa_aipUploadDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

 $('#visa_visaAppliedDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

$('#visa_evisaDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

 $('#onshore_bookedOn').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

 $('#pcc_appliedDate').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

 $('#med_appliedDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#english_test_plan_dte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#work_exp_employmentPeriod1').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#work_exp_employmentPeriod2').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#outcome_course1_startDate').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#outcome_course2_startDate').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#outcome_course3_startDate').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#admission_appliedDate1').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#admission_appliedDate2').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#admission_appliedDate3').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#admission_insStartDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#admission_insExtDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altFormat: "yy-mm-dd"
 });

   $('#admission_insBkpDte').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
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


</section>
</div>
@else

 <div class="row">
   <div class="col-md-7">    
      <ul class="list-inline pull-right">
          <img src={{ asset("/public/images/noAccess.jpg") }} alt="ajv" style="height:280px;">
      </ul>                          
   </div> 
 </div>  
     
<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The application is still with sales team and yet to be approved by sales manager<h3>

@endif
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


