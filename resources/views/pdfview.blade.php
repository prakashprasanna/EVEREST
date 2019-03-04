<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php 
  $gef = App\enquiry::where('gef_phone','=',$outcome->gef_phone)->first(); 
?>
    <title>@yield('page-title') - Cover Sheet to Service PDF Download - Name : {{ $gef->gef_f_name }}</title>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/search.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/summary.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/intlTelInput.css') }}" />
      <script src="{{asset('/public/js/sales.js')}}"></script>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
          <style>
        body {
            padding-top: 73px;
        }
        .social-button {
            text-align: center;
        }
        ul {
            list-style-type: none;
        }
        li {
            margin-bottom: 3px;
        }
    </style>
    <style>
    .required:after{ 
        content:'*'; 
        color:red; 
        padding-left:5px;
    }

</style>
<style>
.buttons { 
  width: 100%;
  table-layout: fixed;
  border-collapse: collapse;
  background-color: red; 
}
.buttons button { 
  width: 100%;
  background-color: pink;
}
</style>

<style>
	.blink{
		width:100px;
		height: 25px;
	    background-color: green;
		padding: 10px;	
		text-align: center;
		line-height: 0px;
	}
	.blink1{
		width:100px;
		height: 25px;
	    background-color: maroon;
		padding: 10px;	
		text-align: center;
		line-height: 0px;
	}
	span1{
		font-size: 10px;
		font-family: cursive;
		color: white;
		animation: blink 1s linear infinite;
	}
@keyframes blink{
0%{opacity: 0;}
50%{opacity: .5;}
100%{opacity: 1;}
}

</style>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  </head>
  <body> 
  <div class="row"> 
    <div class="col-md-6">
     <div class="form-group">
      <div class="list-inline pull-right">
        <h1><img src={{ asset("public/images/ajvglobal.JPG") }} alt="ajv" style="height:50px;"> AJV Global</h1>
      </div>
     </div>
   </div>
  </div> 

                <div class="Container">
                   {!! Form::open(array( 'class' => 'form-line', 'files' => true)) !!}
                  <div class="row"> 
                   <div class="col-md-5">
                    <div class="form-group">
                      {!! Form::label('First Name') !!}
                      {!! Form::label('FN', $gef->gef_f_name, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                  <div class="col-md-5">
                   <div class="form-group">
                      {!! Form::label('Last Name') !!}
                      {!! Form::label('LN', $gef->gef_l_name, 
                          array('class'=>'form-control')) !!}
                   </div>
                  </div>
                 </div> 

                  <div class="row"> 
                   <div class="col-md-5">
                    <div class="form-group">
                      {!! Form::label('Phone') !!}<br>
                      {!! Form::label('phone', $gef->gef_phone, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                   <div class="col-md-5">
                    <div class="form-group">
                      {!! Form::label('Email-Id') !!}<br>
                      {!! Form::label('email', $gef->gef_email, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                  </div> 

                  <div class="row"> 
                   <div class="col-md-10">
                    <div class="form-group">
                      {!! Form::label('Google doc link') !!}<br>
                      {!! Form::label('link', $outcome->outcome_linktodoc, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                  </div> 

                  {!! Form::close() !!}

                            <table class="tablesorter" id="keywords" cellspacing="0" cellpadding="0">
                              <thead>
                                <tr>
                                    <th><span>Institution<span></th>
                                    <th><span>Intake<span></th>
                                    <th><span>Campus<span></th>
                                    <th><span>Course<span></th>
                                    <th><span>Start Date<span></th>
                                    <th><span>Course Link </th>
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
                                  </tr>
                              </tbody>
                              </table>     

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
                                   <td>{{ $outcome->outcome_ARM_CBA }}</td>
                                   <td>{{ $outcome->outcome_ARM_ACO }}</td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   </tr>
                              </tbody>


                               <tbody id="english1-list" name="english1-list">
                                   <tr id="english1{{$outcome->gef_phone}}">
                                   <td>{{ 'Ielts/pte Requirements Met' }}</td>
                                   <td>{{ $outcome->outcome_ERM_CBA }}</td>
                                   <td>{{ $outcome->outcome_ERM_ACO }}</td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   </tr>
                              </tbody>



                               <tbody id="files-list" name="files-list">
                                   <tr id="files{{$outcome->gef_phone}}">
                                   <td>{{ 'Files Named Correctly' }}</td>
                                   <td>{{ $outcome->outcome_FNC_CBA }}</td>
                                   <td>{{ $outcome->outcome_FNC_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>

                               <tbody id="scan-list" name="scan-list">
                                   <tr id="scan{{$outcome->gef_phone}}">
                                   <td>{{ 'Files Scanned Properly' }}</td>
                                   <td>{{ $outcome->outcome_FSP_CBA }}</td>
                                   <td>{{ $outcome->outcome_FSP_ACO }}</td>
                                   <td></td>
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
                            @if($employeep->AJV_DEP_ID === '1')
                               <tbody id="passport-list" name="passport-list">
                                   <tr id="passport{{$outcome->gef_phone}}">
                                   <td>{{ 'Passport' }}</td>
                                   <td>{{ $outcome->outcome_passport_PBA }}</td>
                                   <td>{{ $outcome->outcome_passport_scan }}</td>
                                   <td>{{ $outcome->outcome_passport_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody> 
                            @else
                               <tbody id="passportS-list" name="passportS-list">
                                   <tr id="passportS{{$outcome->gef_phone}}">
                                   <td>{{ 'Passport' }}</td>
                                   <td>{{ $outcome->outcome_passport_PBA }}</td>
                                   <td>{{ $outcome->outcome_passport_scan }}</td>
                                   <td>{{ $outcome->outcome_passport_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                            @endif
                            @if($employeep->AJV_DEP_ID === '1')  
                               <tbody id="class10-list" name="class10-list">
                                   <tr id="class10{{$outcome->gef_phone}}">
                                   <td>{{ 'Class 10' }}</td>
                                   <td>{{ $outcome->outcome_class10_PBA }}</td>
                                   <td>{{ $outcome->outcome_class10_scan }}</td>
                                   <td>{{ $outcome->outcome_class10_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                            @else
                               <tbody id="class10S-list" name="class10S-list">
                                   <tr id="class10S{{$outcome->gef_phone}}">
                                   <td>{{ 'Class 10' }}</td>
                                   <td>{{ $outcome->outcome_class10_PBA }}</td>
                                   <td>{{ $outcome->outcome_class10_scan }}</td>
                                   <td>{{ $outcome->outcome_class10_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                            @endif
                            @if($employeep->AJV_DEP_ID === '1')
                               <tbody id="class12-list" name="class12-list">
                                   <tr id="class12{{$outcome->gef_phone}}">
                                   <td>{{ 'Class 12' }}</td>
                                   <td>{{ $outcome->outcome_class12_PBA }}</td>
                                   <td>{{ $outcome->outcome_class12_scan }}</td>
                                   <td>{{ $outcome->outcome_class12_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                            @else
                               <tbody id="class12S-list" name="class12S-list">
                                   <tr id="class12S{{$outcome->gef_phone}}">
                                   <td>{{ 'Class 12' }}</td>
                                   <td>{{ $outcome->outcome_class12_PBA }}</td>
                                   <td>{{ $outcome->outcome_class12_scan }}</td>
                                   <td>{{ $outcome->outcome_class12_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                            @endif
                            @if($employeep->AJV_DEP_ID === '1')
                               <tbody id="BC-list" name="BC-list">
                                   <tr id="BC{{$outcome->gef_phone}}">
                                   <td>{{ 'Bachelors - Consolidated' }}</td>
                                   <td>{{ $outcome->outcome_BC_PBA }}</td>
                                   <td>{{ $outcome->outcome_BC_scan }}</td>
                                   <td>{{ $outcome->outcome_BC_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                           @else
                               <tbody id="BCS-list" name="BCS-list">
                                   <tr id="BCS{{$outcome->gef_phone}}">
                                   <td>{{ 'Bachelors - Consolidated' }}</td>
                                   <td>{{ $outcome->outcome_BC_PBA }}</td>
                                   <td>{{ $outcome->outcome_BC_scan }}</td>
                                   <td>{{ $outcome->outcome_BC_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                            @endif
                            @if($employeep->AJV_DEP_ID === '1')
                               <tbody id="BSWM-list" name="BSWM-list">
                                   <tr id="BSWM{{$outcome->gef_phone}}">
                                   <td>{{ 'Bachelors - Sem wise marks' }}</td>
                                   <td>{{ $outcome->outcome_BSWM_PBA }}</td>
                                   <td>{{ $outcome->outcome_BSWM_scan }}</td>
                                   <td>{{ $outcome->outcome_BSWM_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                            @else
                               <tbody id="BSWMS-list" name="BSWMS-list">
                                   <tr id="BSWMS{{$outcome->gef_phone}}">
                                   <td>{{ 'Bachelors - Sem wise marks' }}</td>
                                   <td>{{ $outcome->outcome_BSWM_PBA }}</td>
                                   <td>{{ $outcome->outcome_BSWM_scan }}</td>
                                   <td>{{ $outcome->outcome_BSWM_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                            @endif

                            @if($employeep->AJV_DEP_ID === '1')
                               <tbody id="BPC-list" name="BPC-list">
                                   <tr id="BPC{{$outcome->gef_phone}}">
                                   <td>{{ 'Bachelors - Provisional Cert' }}</td>
                                   <td>{{ $outcome->outcome_BPC_PBA }}</td>
                                   <td>{{ $outcome->outcome_BPC_scan }}</td>
                                   <td>{{ $outcome->outcome_BPC_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                           @else
                               <tbody id="BPCS-list" name="BPCS-list">
                                   <tr id="BPCS{{$outcome->gef_phone}}">
                                   <td>{{ 'Bachelors - Provisional Cert' }}</td>
                                   <td>{{ $outcome->outcome_BPC_PBA }}</td>
                                   <td>{{ $outcome->outcome_BPC_scan }}</td>
                                   <td>{{ $outcome->outcome_BPC_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                           @endif      

                            @if($employeep->AJV_DEP_ID === '1')
                               <tbody id="BDC-list" name="BDC-list">
                                   <tr id="BDC{{$outcome->gef_phone}}">
                                   <td>{{ 'Bachelors - Degree Cert' }}</td>
                                   <td>{{ $outcome->outcome_BDC_PBA }}</td>
                                   <td>{{ $outcome->outcome_BDC_scan }}</td>
                                   <td>{{ $outcome->outcome_BDC_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                           @else
                               <tbody id="BDCS-list" name="BDCS-list">
                                   <tr id="BDCS{{$outcome->gef_phone}}">
                                   <td>{{ 'Bachelors - Degree Cert' }}</td>
                                   <td>{{ $outcome->outcome_BDC_PBA }}</td>
                                   <td>{{ $outcome->outcome_BDC_scan }}</td>
                                   <td>{{ $outcome->outcome_BDC_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                           @endif

                            @if($employeep->AJV_DEP_ID === '1')
                               <tbody id="CV-list" name="CV-list">
                                   <tr id="CV{{$outcome->gef_phone}}">
                                   <td>{{ 'CV' }}</td>
                                   <td>{{ $outcome->outcome_CV_PBA }}</td>
                                   <td>{{ $outcome->outcome_CV_scan }}</td>
                                   <td>{{ $outcome->outcome_CV_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                            @else 
                               <tbody id="CVS-list" name="CVS-list">
                                   <tr id="CVS{{$outcome->gef_phone}}">
                                   <td>{{ 'CV' }}</td>
                                   <td>{{ $outcome->outcome_CV_PBA }}</td>
                                   <td>{{ $outcome->outcome_CV_scan }}</td>
                                   <td>{{ $outcome->outcome_CV_ACO }}</td>
                                   <td></td>
                                   </tr>
                              </tbody>
                           @endif
        
                              </table>

                        <h4><u>AJV Fee details</u></h4>

                  <div class="row"> 
                   <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('Fee agreed') !!}
                      {!! Form::label('agreed', $outcome->outcome_feeAgreed, 
                               array('class'=>'form-control')) !!} 
                    </div>
                   </div> 
                 </div>


                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">    
                            <span class="required"></span>   
                           {!! Form::label('AJV fee applicable?') !!}
                           {!! Form::label('fee', $outcome->outcome_ajvFeeApp, 
                               array('class'=>'form-control')) !!}                 
                          </div>
                         </div>
                       </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">    
                            <span class="required"></span>   
                           {!! Form::label('Fee applicable?') !!}
                           {!! Form::label('feeapp', $outcome->outcome_feeApp, 
                               array('class'=>'form-control')) !!} 
                          </div>
                         </div>
                       </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">    
                           {!! Form::label('To be paid when?') !!}
                           {!! Form::label('paid', $outcome->outcome_paidWhen, 
                               array('class'=>'form-control')) !!} 
                 
                          </div>
                         </div>
                       </div>
<?php 
  $emp = App\employee::where('AJV_EMP_Email','=',$gef->gef_assigned_to)->first(); 
  $lead = App\employee::where('AJV_EMP_Email','=',$gef->assigned_lead)->first();
?>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">    
                            <span class="required"></span>   
                           {!! Form::label('Sales Advisor') !!}
                           {!! Form::label('advisor', $emp->AJV_EMP_Fname . ' ' . $emp->AJV_EMP_Lname, 
                               array('class'=>'form-control')) !!} 
                          </div>
                         </div>
                       </div>

                       <div class="row">
                          <div class="col-md-10">
                           <div class="form-group">    
                           {!! Form::label('Approved by') !!}
                           {!! Form::label('tl', $lead->AJV_EMP_Fname . ' ' . $lead->AJV_EMP_Lname, 
                               array('class'=>'form-control')) !!} 
                 
                          </div>
                         </div>
                       </div>


      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  </body>
</html>