@extends('admin.master')

@section('page-header')
	Unidad Ejecutora <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($unity, [
            'id' => 'main-form'
		])
	!!}

		@include('unities.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('admin.partials.disable')
@endsection