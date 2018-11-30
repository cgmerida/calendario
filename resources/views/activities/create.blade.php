@extends('admin.master')

@section('page-header')
	Actividad <small>({{ trans('app.add_new_item') }})</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'activities.store',
			'autocomplete' => 'off'
		])
	!!}

		@include('activities.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}

@stop