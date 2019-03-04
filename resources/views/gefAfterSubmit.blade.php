<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title') - AJV Enquiry Form Response</title>

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

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  </head>
  <body> 
<section style="background:white;">
<div class="Container">
<h1><img src={{ asset("/public/images/ajv.jpg") }} alt="ajv" style="height:100px"; align="bottom">
Thank You :) <img src={{ asset("/public/images/see_u_soon.PNG") }} alt="ajv" style="height:150px"; align="bottom"></h1>

 <div class="row"> 
  <div class="col-md-1">
   <div class="list-inline pull-right">
   </div>
  </div>     
  <div class="col-md-10">
   <div class="list-inline pull-right">
     <p>Cool mate...you just took your first step towards New Zealand. Yayyy :) Now be patient as we wait to assess your info and revert with what to do next. If we don't respond within 2 working days, scream at us by emailing info@ajv.kiwi - and there is plenty of action at our Facebook Group and our YouTube Channel. </p>
   </div>
  </div>
 </div>  

 <div class="row"> 
  <div class="col-md-8">
   <div class="list-inline pull-right">

     <a href="https://www.facebook.com/groups/NZOptions/" target="_blank"><img border="0" alt="W3Schools" src={{ asset("/public/images/facebook.gif") }} width="200" height="150"></a> 
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.youtube.com/c/ArunJacobNZImmigrationAdviser" target="_blank"><img border="0" alt="youtube" src={{ 
     asset("/public/images/youtube.gif") }} width="200" height="130"></a>

    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thanks and see you in Kiwiland soon!! Team AJV.</p>

   </div>
  </div>
 </div>  

</div>
</section>
</body>
</html>
