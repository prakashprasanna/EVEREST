<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title') - AJV Enquiry Form</title>

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

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
 <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
 <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">

      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/intlTelInput.css') }}" />


  </head>
  <body> 

  <div class="row"> 
    <div class="col-md-7">
     <div class="form-group">
      <div class="list-inline pull-right">
        <h1><img src={{ asset("public/images/ajv.jpg") }} alt="ajv" style="height:50px;"> AJV Enquiry Form</h1>
      </div>
     </div>
   </div>
  </div> 

<div class="container">

@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif

{!! Form::open(array('route' => 'storeOnshore', 'class' => 'form-line', 'files' => true)) !!}

	<div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
        <span class="required"></span>
          {!! Form::label('First Name') !!}
          {!! Form::text('firstname', old('firstname'), 
            array('class'=>'form-control', 
                  'placeholder'=>'First name')) !!}
	    <span class="text-danger">{{ $errors->first('firstname') }}</span>
       </div>

        {!! Form::label('Last Name') !!}
        {!! Form::text('lastname', old('lastname'), 
            array('class'=>'form-control', 
                  'placeholder'=>'Last name')) !!}

 
	<div class="form-group {{ $errors->has('onshore_phone') ? 'has-error' : '' }}">
        <span class="required"></span>

         {!! Form::label('Phone') !!}<br>
         {!! Form::text('onshore_phone', old('onshore_phone'), 
              array('id'=>'phone',
              'class'=>'form-control','placeholder'=>'Mobile No')) !!}
	    <span class="text-danger">{{ $errors->first('onshore_phone') }}</span>
     <span id="valid-msg" class="hide"><font color="green">✓ Valid</font></span>
</br>
     <span id="error-msg" class="hide"><font color="red">Invalid number (Ensure number matches country code)</font></span> 


     <script src="public/js/intlTelInput.js"></script>
        <script>

          $("#phone").intlTelInput({
          initialCountry: "auto",
          geoIpLookup: function(callback) {
            $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
              var countryCode = (resp && resp.country) ? resp.country : "";
              callback(countryCode);
            });
          },
          utilsScript: "public/js/utils.js" // just for formatting/placeholders etc
        });


        var telInput = $("#phone"),
          errorMsg = $("#error-msg"),
          validMsg = $("#valid-msg");

        // initialise plugin
        telInput.intlTelInput({
          utilsScript: "public/js/utils.js"
        });

        var reset = function() {
          telInput.removeClass("error");
          errorMsg.addClass("hide");
          validMsg.addClass("hide");
        };

        // on blur: validate
        telInput.blur(function() {
          reset();
          if ($.trim(telInput.val())) {
            if (telInput.intlTelInput("isValidNumber")) {
              validMsg.removeClass("hide");
            } else {
              telInput.addClass("error");
              errorMsg.removeClass("hide");
            }
          }
        });

        // on keyup / change flag: reset
        telInput.on("keyup change", reset);
        </script>
    </div>
   

      <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
         <span class="required"></span>
         {!! Form::label('email') !!}
         {!! Form::email('email',old('email'),array('class'=>'form-control', 
              'placeholder'=>'email@emailprovider.com')) !!}
	    <span class="text-danger">{{ $errors->first('email') }}</span>
      </div>

      <div class="form-group {{ $errors->has('nationality') ? 'has-error' : '' }}">
       <span class="required"></span>
        {!! Form::Label('nationality', 'Nationality') !!}
        <?php
        $nationalityList = App\nationality::pluck('nationality', 'nationality_id')->all();
        ?>
        {!! Form::select('nationality', $nationalityList, 0, ['placeholder' => 'Select your Nationality','class' => 'form-control']) !!} 
	    <span class="text-danger">{{ $errors->first('nationality') }}</span>
      </div>

      <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
       <span class="required"></span>
       {!! Form::label('City', 'City') !!}
         {!! Form::text('city',old('city'),array('class'=>'form-control', 
              'placeholder'=>'city')) !!}
	    <span class="text-danger">{{ $errors->first('city') }}</span>
     </div>

      <div class="form-group {{ $errors->has('course') ? 'has-error' : '' }}">
       <span class="required"></span>
       {!! Form::label('Course Completed', 'Course') !!}
         {!! Form::text('course',old('course'),array('class'=>'form-control', 
              'placeholder'=>'course')) !!}
	    <span class="text-danger">{{ $errors->first('course') }}</span>
     </div>


      <div class="form-group {{ $errors->has('college') ? 'has-error' : '' }}">
       <span class="required"></span>
       {!! Form::label('College') !!}
         {!! Form::text('college',old('college'),array('class'=>'form-control', 
              'placeholder'=>'college')) !!}
	    <span class="text-danger">{{ $errors->first('college') }}</span>
      </div>


      <div class="form-group {{ $errors->has('expDate') ? 'has-error' : '' }}">
        <span class="required"></span>
                   {!! Form::label('Visa Expiry Date') !!}  
                   {!! Form::text('expDate', null,
                           array('required',
                                'class'=>'form-control clsDatePicker',
                                'readonly'=>'readonly',
                                'id'=>'expDate',
                                'name'=>'expDate')) !!}
	    <span class="text-danger">{{ $errors->first('expDate') }}</span>
     </div>

      <div class="form-group {{ $errors->has('source') ? 'has-error' : '' }}">
        <span class="required"></span>
        {!! Form::label('Enquiry Source') !!}
        <?php
         $sourceList = App\source::pluck('source_name', 'source_id')->all();
        ?>
        {!! Form::select('source', $sourceList, 0, ['placeholder'=>'Choose a Source', 'class' => 'form-control']) !!}  
	    <span class="text-danger">{{ $errors->first('source') }}</span>
     </div>

   <div class="form-group">
    {!! Form::label('Any specific info that may affect your visa process. Eg: Health problems, finance issues, legal matters, etc.') !!}
    {!! Form::textarea('message', null, 
        array('class'=>'form-control', 
              'placeholder'=>'Your message')) !!}
   </div>

   <div class="form-group">
    {!! Form::submit('Send your Enquiry!', 
      array('class'=>'btn btn-primary','id' => 'submit', 'value' => 'Reset')) !!}


   </div>

{!! Form::close() !!}

<script type="text/javascript"> 

   $('#expDate').datepicker({
     dateFormat: 'yy-mm-dd',
     minDate: "-6y",
     yearRange: "-3:+3",
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

</div>
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  </body>
</html>