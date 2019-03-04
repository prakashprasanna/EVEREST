@extends('layouts.master')
@section('page-title', 'Select Process')
@section('page-content')
</br>
</br>
</br>
</br>
</br>
<style>
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 10px 5px;
  cursor: pointer;
}
.button {width: 100%;}
</style>

<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ url('/public/css/empLogin.css') }}" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
 <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
 <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">

</br>
</br>
</br>
</br>
</br>
</br>
</br>
  <div class="container">
       <div class="row"> 
  <div class="col-md-5">
  </div>      
  <div class="col-md-2">
    <h2 class="omb_authTitle">&nbsp;&nbsp;&nbsp;<img src={{ asset("public/images/AJV.png") }} alt="sing" style="height:100px;"></h2>        
  </div>      
  <div class="col-md-5">
  </div>      

 <div class="row"> 
  <div class="col-md-12">
    <div class="row">
            <div class="col-md-6">
             <a href="{{ url('dashboard') }}" class="button" target="_blank">SALES <i class="glyphicon glyphicon-phone-alt"></i></a>
            </div>  
            <div class="col-md-6">
             <a href="{{ url('servicedashboard') }}" class="button" target="_blank">SERVICE <i class="glyphicon glyphicon-plane"></i></a>
            </div>            
    </div>
  </div>
</div>
</div>
@stop