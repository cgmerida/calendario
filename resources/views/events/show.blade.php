@extends('admin.master')

@section('page-header')
	Evento <small>Vista</small>
@stop

@section('content')
	{!! Form::model($event, [
            'id' => 'main-form'
		])
	!!}

		@include('events.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('admin.partials.disable')
@endsection