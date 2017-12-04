
@extends('layouts.master')
@section('page-title', 'Dashboard')
@section('page-content')
@if(Auth::check())
<br>
<br>
<div class="col-md-10">
    <h3>This is the dashboard</h3>
</div>
 @else
<br>
<br> 
<div class="col-md-10">
    <h3>You have logged out</h3>
</div>
@endif
@stop