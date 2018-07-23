@extends('templates.default')

@section('content')
 <div class="row">
 	<div class="col-md-8">
 		{!!Form::model($id,['route'=>['profile.postEdit',$id->id],'method'=>'PUT'])!!}

 		{{Form::label('first_name','First name:')}}
 		{{Form::text('first_name',$id->first_name,['class'=>'form-control'])}}

 		{{Form::label('last_name','Last name:')}}
 		{{Form::text('last_name',$id->last_name,['class'=>'form-control'])}}

 		{{Form::label('location','Location:')}}
 		{{Form::text('location',$id->location,['class'=>'form-control'])}}

 		{{Form::submit('Update',['class'=>'btn btn-success btn-block ts10'])}}

 		{!!Form::close()!!}
 	</div>
 </div>
@stop