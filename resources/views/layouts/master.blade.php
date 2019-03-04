<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>@yield('page-title') - AJV EVEREST</title>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/search.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/summary.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/intlTelInput.css') }}" />
      <script src="{{asset('/public/js/sales.js')}}"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('/public/js/assign_checkbox.js')}}"></script>
    <script src="{{asset('/public/js/assign1_checkbox.js')}}"></script>
    <script src="{{asset('/public/js/dropped_checkbox.js')}}"></script>


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
.nav-tabs .badge{
    position: absolute;
    top: -10px;
    right: -10px;
    background: red;
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

  </head>
  <body> 

    
        <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
          <li> </li> 
          <li>
           <a class="navbar-brand" href="/" target="_blank"><h3><img src={{ asset("public/images/AJV.png") }} alt="ajv" style="height:50px;"> 
@if(auth()->check())
  <img src={{ asset("public/images/nz.PNG") }} alt="ajv" style="height:50px;">
@else
  <img src={{ asset("public/images/global.png") }} alt="ajv" style="height:50px;">
@endif
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<img src={{ asset("public/images/EVEREST.png") }} alt="ajv" style="height:50px;"><h3> </a>
          </li>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                 @if(auth()->check())
                        @include('partials.user-menu')
                 @else
                       <li>
                        <a href='{!! url('/destinations'); !!}'>
                         Employee Sign In <i class="fa fa-sign-in"></i>
                        </a>
                       </li>  
                 @endif   
            </ul>
        </div>
    </nav>
    <div class="container">
        @yield('page-content')
    </div>
  </body>
</html>