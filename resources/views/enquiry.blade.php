<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title') - AJV Enquiry Form</title>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/intlTelInput.css') }}" />
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

{!! Form::open(array('route' => 'enquiry_store', 'class' => 'form-line', 'files' => true)) !!}
<input name="apitoken" type="hidden" value="95b2c553179c50a1">
	<div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
        <span class="required"></span>
          {!! Form::label('Name') !!}
          {!! Form::text('firstname', old('firstname'), 
            array('class'=>'form-control', 
                  'placeholder'=>'Name')) !!}
	    <span class="text-danger">{{ $errors->first('firstname') }}</span>
       </div>

    <?php
      $user = Auth::user();
      $emp = null; 
     if($user != null){
        $emp = App\employee::where('AJV_EMP_Email','=',$user->email)->first(); 
      }      
    ?>

     @if($emp != null)
	<div class="form-group {{ $errors->has('gef_phone') ? 'has-error' : '' }}">
         <span class="required"></span>
         {!! Form::label('Phone or FB ID or Email') !!}
         {!! Form::text('gef_phone',null,array('class'=>'form-control', 
              'placeholder'=>'Enter Phone or FB ID')) !!}
           @if($errors->first('gef_phone'))  
	    <span class="text-danger">{{ 'There is already an enquiry with the Phone or FB ID or Email entered' }}</span>
           @endif
        </div>
     @else
 
	<div class="form-group {{ $errors->has('gef_phone') ? 'has-error' : '' }}">
        <span class="required"></span>

         {!! Form::label('Phone') !!}<br>
         {!! Form::text('gef_phone', old('gef_phone'), 
              array('id'=>'phone',
              'class'=>'form-control','placeholder'=>'Mobile No')) !!}
	    <span class="text-danger">{{ $errors->first('gef_phone') }}</span>
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
   @endif

      <div class="form-group {{ $errors->has('gef_email') ? 'has-error' : '' }}">
         <span class="required"></span>
         {!! Form::label('email') !!}
         {!! Form::email('gef_email',old('gef_email'),array('class'=>'form-control', 
              'placeholder'=>'email@emailprovider.com')) !!}
	    <span class="text-danger">{{ $errors->first('gef_email') }}</span>
      </div>

   <div class="form-group">
    {!! Form::label('Skype') !!}
    {!! Form::text('skype', null, 
        array('class'=>'form-control', 
              'placeholder'=>'skype')) !!}
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

      <div class="form-group {{ $errors->has('destination') ? 'has-error' : '' }}">
       <span class="required"></span>
       {!! Form::label('destination', 'Destination') !!}
       <?php
       $destinationList = App\destination::pluck('AJV_destination', 'AJV_destination_id')->all();
       ?>
        {!! Form::select('destination', $destinationList, 0, ['placeholder' => 'Choose a destination', 'class' => 'form-control']) !!}
	    <span class="text-danger">{{ $errors->first('destination') }}</span>
     </div>


      <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
       <span class="required"></span>
       {!! Form::label('Pathway') !!}
       <?php
       $pathwayList = App\pathway::pluck('AJV_destination_pathway_name', 'AJV_destination_pathway_id')->all();
       ?>
       {!! Form::select('pathway', $pathwayList, 0, ['placeholder' => 'Choose a pathway', 'class' => 'form-control', 'id' => 'pathway']) !!}
            <input type="hidden" name="pathway1" id="pathway1"> 
	    <span class="text-danger">{{ $errors->first('subject') }}</span>
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

    <?php
      $user = Auth::user();
      $dep = null;
     if($user != null){
        $emp = App\employee::where('AJV_EMP_Email','=',$user->email)->first(); 
        if($emp != null){ 
           $dep = App\sales_leads::where('sales_lead_id','=',$emp->AJV_EMP_Lead)->first(); 
        }
      }      
    ?>

   <div class="form-group">
     @if($user != null) 
        <input name="adviser" value={{ $user->email }} type="hidden">
     @else
        <input name="adviser" value=null type="hidden">
     @endif
     @if($dep != null) 
        <input name="leader" value={{ $dep->sales_lead_email }} type="hidden">
     @else
        <input name="leader" value=null type="hidden">
     @endif
    {!! Form::submit('Send your Enquiry!', 
      array('class'=>'btn btn-primary','id' => 'submit', 'value' => 'Reset')) !!}


   </div>

{!! Form::close() !!}

</div>
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  </body>
</html>