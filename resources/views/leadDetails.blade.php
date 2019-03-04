<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title') - Lead Details</title>

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

                <div class="Container">
                   {!! Form::open(array( 'class' => 'form-line', 'files' => true)) !!}
                  <div class="row"> 
                   <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('First Name') !!}
                      {!! Form::label('FN', $gef->gef_f_name, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                  <div class="col-md-6">
                   <div class="form-group">
                      {!! Form::label('Last Name') !!}
                      {!! Form::label('LN', $gef->gef_l_name, 
                          array('class'=>'form-control')) !!}
                   </div>
                  </div>
                 </div> 

                  <div class="row"> 
                   <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('Phone') !!}<br>
                      {!! Form::label('phone', $gef->gef_phone, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                   <div class="col-md-6">
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
                      {!! Form::label('Skype-Id') !!}<br>
                      {!! Form::label('skype', $gef->gef_skype, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                   <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('Nationality') !!}<br>
                      {!! Form::label('nationality', $gef->gef_nationality, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div>
                  </div>  

                  <div class="row"> 
                   <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('Location') !!}<br>
                      {!! Form::label('location', $gef->gef_country, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                   <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('Destination') !!}<br>
                      {!! Form::label('destination', $gef->gef_destination, 
                          array('class'=>'form-control')) !!}
                   </div>
                  </div>
                 </div>  

                  <div class="row"> 
                   <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('Pathway') !!}<br>
                      {!! Form::label('pathway', $gef->gef_pathway, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                   <div class="col-md-6">
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
                   <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('Enquiry Source') !!}<br>
                      {!! Form::label('source', $gef->gef_source, 
                          array('class'=>'form-control')) !!}
                    </div>
                   </div> 
                   <div class="col-md-6">
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
                      {!! Form::label('Any message from enquirer') !!}<br>
                      {!! Form::textarea('message', $gef->gef_comments, 
                              array('class'=>'form-control', 'rows'=>'4', 'cols'=>'10', 'readonly' => true)) !!}

                    </div>
                   </div> 
                  </div> 

                  {!! Form::close() !!}
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  </body>
</html>