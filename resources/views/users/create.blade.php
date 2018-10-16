@extends('admin.master')

@section('page-header')
	User <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'action' => ['UserController@store'],
			'files' => true
		])
	!!}

		@include('users.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
