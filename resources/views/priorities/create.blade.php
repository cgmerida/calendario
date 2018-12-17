@extends('admin.master')

@section('page-header')
	Prioridad <small>({{ trans('app.add_new_item') }})</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'priorities.store',
			'autocomplete' => 'off'
		])
	!!}

		@include('priorities.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}

@stop