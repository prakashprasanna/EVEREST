<?php
$user = Auth::user();  
$emp = App\employee::where('AJV_EMP_Email','=',$user->email)->first(); 
?> 
<li class="dropdown">	
<br>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $emp->AJV_EMP_shortName }} {{','}} 
{{$emp->AJV_EMP_designation}}
<IMG SRC={{ auth()->user()->avatar }} style="width:50px;height:50px;"></a>
    
    <ul class="dropdown-menu">
        <li><a href="{!! url('/dashboard'); !!}">Dashboard</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="{!! url('/leadApprovals'); !!}">Approvals</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="{!! url('/empDetails'); !!}">Your Details></li>
        <li role="separator" class="divider"></li>
      @if($emp->AJV_EMP_Lead === null)
        <li><a href="{!! url('/export'); !!}">Export Leads</a></li>
        <li role="separator" class="divider"></li>
      @endif
        <li><a href="{{ action('App\Http\Controllers\Auth\LoginController@logout') }}">Sign out</a></li>
    </ul>
</li>