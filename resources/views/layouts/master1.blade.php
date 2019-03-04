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
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/modal.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/intlTelInput.css') }}" />
      <script src="{{asset('/public/js/sales.js')}}"></script>


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
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">  


  </head>
  <body> 

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11';
      fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
        <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
        </div>

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"> 
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                 @if(auth()->check())
                        @include('partials.user-menu')
                 @else
                       <li>
                        <a href='{!! url('/enquiry'); !!}'>
                        GEF <i class="fa fa-sign-in"></i>
                        <a href='{!! url('/destinations'); !!}'>
                        Employee Sign In <i class="fa fa-sign-in"></i>
                       </a></a>
                       </li>
                 @endif   
            </ul>
        </div>
      </div>
    </nav>
    <div class="container">
        @yield('page-content')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


  </body>
</html>