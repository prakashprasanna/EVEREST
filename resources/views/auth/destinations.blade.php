@extends('layouts.master')
@section('page-title', 'Destinations Login')
@section('page-content')
</br>
</br>
</br>
</br>


    <div class="row">
        
        <div class="col-md-2 col-md-offset-1">
           <a href="#"><img src={{ asset("public/images/Aus.PNG") }} alt="aus" style="height:100px;"></a>
           <br>
           <br>
           <br>
           <br>
           <a href="#"><img src={{ asset("public/images/Ireland.PNG") }} alt="sing" style="height:100px;"></a>
           <br>
           <br>
           <br>
           <br>
           <a href="#"><img src={{ asset("public/images/Dubai.PNG") }} alt="sing" style="height:100px;"></a>
        </div>
        <div class="col-md-2 col-md-offset-1">
           <a href="#"><img src={{ asset("public/images/Canada.PNG") }} alt="aus" style="height:100px;"></a>
           <br>
           <br>
           <br>
           <br>
           <a href="{{ action('App\Http\Controllers\Auth\LoginController@showLoginPage') }}"><img src={{ asset("public/images/nz.PNG") }} alt="sing" style="height:100px;"></a>
           <br>
           <br>
           <br>
           <br>
           <a href="#"><img src={{ asset("public/images/uk.PNG") }} alt="sing" style="height:100px;"></a>
        </div>
        <div class="col-md-2 col-md-offset-1">
           <a href="#"><img src={{ asset("public/images/germany.PNG") }} alt="canada" style="height:100px;"></a>
           <br>
           <br>
           <br>
           <br>
           <a href="#"><img src={{ asset("public/images/Sing.PNG") }} alt="ireland" style="height:100px;"></a>
           <br>
           <br>
           <br>
           <br>
           <a href="#"><img src={{ asset("public/images/usa.PNG") }} alt="ireland" style="height:100px;"></a>
     
       </div>
      </div>

     
@stop