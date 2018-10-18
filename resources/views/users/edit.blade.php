@extends('admin.master')

@section('page-header')
	User <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($item, [
			'route' => ['users.update', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('users.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
