@extends('admin.master')

@section('page-header')
	Contingencia <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($contingency, [
			'route' => ['contingencies.update', $contingency],
			'method' => 'put',
		])
	!!}

		@include('contingencies.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
