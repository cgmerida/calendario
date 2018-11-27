@extends('admin.master')

@section('page-header')
	Contingencias <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'contingencies.store',
		])
	!!}

		@include('contingencies.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
