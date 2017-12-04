@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @extends('layouts.master')
                    @section('page-title', 'Home')
                    @section('page-content')
                    <div class="col-md-10">
                        <h3>Welcome to my awesome app!</h3>
                    </div>
                    @stop
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
