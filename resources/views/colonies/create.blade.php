@extends('admin.master')

@section('page-header')
	Colonia <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('css')
	@include('colonies.partials.map-style')
@endsection

@section('content')
	{!! Form::open([
			'route' => 'colonies.store',
		])
	!!}

		@include('colonies.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('colonies/partials/map-js')
@endsection
