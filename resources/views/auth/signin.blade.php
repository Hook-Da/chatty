@extends('templates.default')
    	{!! Html::style('css/parsley.css') !!}
@section('content')
<h3>Sign In</h3>
<div class="row">

    <div class="col-md-8 col-md-offset-2">
    	{!!Form::open(['method'=>'post','class'=>'form-vertical','data-parsley-validate'=>''])!!}
		{{Form::label('email','Enter your email:')}}
		{{Form::email('email',null,['class'=>'form-control','data-parsley-type'=>"email",'required'=>''])}}
		@if($errors->has('email'))
			<span class="help-block">{{$errors->first('email')}}</span>
		@endif
		{{Form::label('password','Password:')}}
		{{Form::password('password',['class'=>'form-control','id'=>'password','required'=>'','data-parsley-minlength'=>"6"])}}
		@if($errors->has('password'))
			<span class="help-block">{{$errors->first('password')}}</span>
		@endif
		{{Form::checkbox('remember')}}
		{{Form::label('remember','Remember me',['class'=>'ts5'])}}
		
			{{Form::submit('Register',['class'=>'btn btn-block btn-success ts5'])}}
		{!!Form::close()!!}

		{{Html::script('js/jquery.js')}}
		{{Html::script('js/parsley.min.js')}}
@stop