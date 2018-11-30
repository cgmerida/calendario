@extends('admin.master')

@section('page-header')
	Unidad Ejecutora <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($unity, [
			'route' => ['unities.update', $unity],
			'method' => 'put',
			'autocomplete' => 'off'
		])
	!!}

		@include('unities.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop