@extends('admin.master')

@section('page-header')
	Prioridad <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($priority, [
			'route' => ['priorities.update', $priority],
			'method' => 'put',
			'autocomplete' => 'off'
		])
	!!}

		@include('priorities.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop