@extends('admin.master')

@section('page-header')
	Prioridad <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($priority, [
            'id' => 'main-form'
		])
	!!}

		@include('priorities.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('admin.partials.disable')
@endsection