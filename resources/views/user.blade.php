
@extends('layouts.master')
@section('page-title', '')
@section('page-content')
<br>
<div class="Container">
<div class="col-md-6 form-line">
<h1>Global Enquiry Form</h1>

<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

{!! Form::open(array('route' => 'enquiry_store', 'class' => 'form-line')) !!}

<div class="form-group">
    {!! Form::label('First Name') !!}
    {!! Form::text('FN', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'First name')) !!}
</div>

<div class="form-group">
    {!! Form::label('Last Name') !!}
    {!! Form::text('LN', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Last name')) !!}
</div>

<div class="form-group">
    {!! Form::label('Phone') !!}
    {!! Form::text('phone', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Phone')) !!}
</div>

<div class="form-group">
   <!-- email input -->
{!! Form::label('email') !!}
{!! Form::email('email',null,array('class'=>'form-control', 
              'placeholder'=>'email@emailprovider.com')) !!}
</div>

<div class="form-group">
    {!! Form::label('Skype') !!}
    {!! Form::text('skype', null, 
        array('class'=>'form-control', 
              'placeholder'=>'skype')) !!}
</div>


<div class="form-group">
    {!! Form::Label('nationality', 'Nationality') !!}
    <?php
    $nationalityList = App\nationality::pluck('nationality', 'nationality_id')->all();
    ?>
   {!! Form::select('nationality', $nationalityList, 0, ['placeholder' => 'Select your Nationality','class' => 'form-control']) !!}	
</div>

<div class="form-group">
    {!! Form::label('Location') !!}
     <?php
    $countryList = App\country::pluck('country', 'country_id')->all();
    ?>
   {!! Form::select('country', $countryList, 0, [ 'placeholder' => 'where are you located', 'class' => 'form-control']) !!}	
</div>

</div>
</div>
<br>
<br>
<br>

<div class="col-md-6">
<div class="form-group">
    {!! Form::label('Destination') !!}
    <?php
    $destinationList = App\destination::pluck('AJV_destination', 'AJV_destination_id')->all();
    ?>
   {!! Form::select('destination', $destinationList, 0, [ 'placeholder' => 'Choose a destination', 'class' => 'form-control']) !!}	
</div>

<div class="form-group">
    {!! Form::label('Pathway') !!}
    <?php
    $pathwayList = App\pathway::pluck('AJV_destination_pathway_name', 'AJV_destination_pathway_id')->all();
    ?>
   {!! Form::select('pathway', $pathwayList, 0, [ 'placeholder' => 'Choose a pathway', 'class' => 'form-control']) !!}	
</div>

<div class="form-group">
    {!! Form::label('Enquiry Source') !!}
    {!! Form::text('source', null, 
        array('required',
        	  'class'=>'form-control', 
              'placeholder'=>'how did you know about AJV')) !!}
</div>

<div class="form-group">
    {!! Form::label('Attach CV') !!}
    {!! Form::file('pdf', null) !!}
</div>


<div class="form-group">
    {!! Form::label('Your Message') !!}
    {!! Form::textarea('message', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Your message')) !!}
</div>

<div class="form-group">
    {!! Form::submit('Send your Enquiry!', 
      array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!} 
</div>
</div>
@stop






















