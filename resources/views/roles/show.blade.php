@extends('admin.master')

@section('page-header')
	Rol <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($role, [
            'id' => 'main-form'
		])
	!!}

		@include('roles.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@include('admin.partials.disable')