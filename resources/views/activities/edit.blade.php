@extends('admin.master')

@section('page-header')
	Actividad <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($activity, [
			'route' => ['activities.update', $activity],
			'method' => 'put',
			'autocomplete' => 'off'
		])
	!!}

		@include('activities.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop