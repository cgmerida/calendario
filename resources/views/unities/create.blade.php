@extends('admin.master')

@section('page-header')
	Unidad Ejecutora <small>({{ trans('app.add_new_item') }})</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'unities.store',
			'autocomplete' => 'off'
		])
	!!}

		@include('unities.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}

@stop