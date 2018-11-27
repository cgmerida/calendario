@extends('admin.master')

@section('page-header')
	Contingencia <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($contingency, [
            'id' => 'main-form'
		])
	!!}

		@include('contingencies.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@include('admin.partials.disable')