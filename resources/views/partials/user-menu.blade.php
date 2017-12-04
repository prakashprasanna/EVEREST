
<li class="dropdown">	
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">logged as {{ auth()->user()->name }} <span class="caret"></span><IMG SRC={{ auth()->user()->avatar }} style="width:60px;height:70px;"> </a>
    <ul class="dropdown-menu">
        <li><a href="{{ action('App\Http\Controllers\Auth\LoginController@showDashBoard') }}">Dashboard</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="{{ action('App\Http\Controllers\Auth\LoginController@logout') }}">Sign out</a></li>
    </ul>
</li>