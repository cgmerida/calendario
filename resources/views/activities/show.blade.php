@extends('admin.master')

@section('page-header')
	Actividad <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($activity, [
            'id' => 'main-form'
		])
	!!}

		@include('activities.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('admin.partials.disable')
@endsection