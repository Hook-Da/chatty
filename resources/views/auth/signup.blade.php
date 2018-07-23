@extends('templates.default')
    	{!! Html::style('css/parsley.css') !!}
@section('content')
<h3>Sign Up</h3>
<div class="row">

    <div class="col-md-8 col-md-offset-2">
    	{!!Form::open(['method'=>'post','class'=>'form-vertical','data-parsley-validate'=>''])!!}
		{{Form::label('email','Enter your email:')}}
		{{Form::email('email',null,['class'=>'form-control','data-parsley-type'=>"email"])}}

		{{Form::label('username','Username:')}}
		{{Form::text('username',null,['class'=>'form-control','required'=>'unique:users|alpha_dash|min:3|max:20'])}}

		{{Form::label('password','Password:')}}
		{{Form::password('password',['class'=>'form-control','id'=>'password','required'=>'','data-parsley-minlength'=>"6"])}}
		
		{{Form::label('password_confirmation','Please repeat your password:')}}
		{{Form::password('password_confirmation',['class'=>'form-control','required'=>'','data-parsley-equalto'=>'#password'])}}

		{{Form::submit('Register',['class'=>'btn btn-block btn-success ts10'])}}
		{!!Form::close()!!}

		{{Html::script('js/jquery.js')}}
		{{Html::script('js/parsley.min.js')}}
@stop