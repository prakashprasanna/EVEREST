@extends('layouts.master')
@section('page-title', 'Please login')
@section('page-content')
</br>
</br>
</br>
</br>
</br>


<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/empLogin.css') }}" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

  <div class="container">
 <div class="row"> 
  <div class="col-md-12">
    <div class="omb_login">
         <h2 class="omb_authTitle">&nbsp;&nbsp;&nbsp;<img src={{ asset("public/images/nz.PNG") }} alt="sing" style="height:100px;"></h2>
        <h2 class="omb_authTitle">&nbsp;&nbsp;<u>Employee Login</u></h2>
        <div class="row omb_row-sm-offset-3 omb_socialButtons">
            <div class="col-xs-6 col-sm-2">
                <a href="{{ action('App\Http\Controllers\Auth\LoginController@auth', ['provider' => 'google']) }}" class="btn btn-lg btn-block omb_btn-google">
                    <i class="fa fa-google-plus visible-xs"></i>
                    <span class="hidden-xs">Google+</span>
                </a>
            </div>  
            <div class="col-xs-6 col-sm-2">
                <a href="{{ action('App\Http\Controllers\Auth\LoginController@auth', ['provider' => 'facebook']) }}" class="btn btn-lg btn-block omb_btn-facebook">
                    <i class="fa fa-facebook visible-xs"></i>
                    <span class="hidden-xs">Facebook</span>
                </a>
            </div>            
        </div>          
    </div>
  </div>
</div>
</div>
@stop

