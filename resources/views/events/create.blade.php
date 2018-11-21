@extends('admin.master')

@section('page-header')
	Evento <small>({{ trans('app.add_new_item') }})</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'events.store',
			'autocomplete' => 'off'
		])
	!!}

		@include('events.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
		@include('admin.partials.back')
		
	{!! Form::close() !!}

@stop

@section('js')
	<script>
		$(function(){
			
				let currentDate = new Date();
				currentDate.setDate(currentDate.getDate() + 5);
				$('#start').datetimepicker({
					minDate: currentDate
				});

				$('#end').datetimepicker({
					minDate: currentDate
				});
				
				$("#start").on("dp.change", function (e) {
					$('#end').data("DateTimePicker").minDate(e.date);
				});
				$("#end").on("dp.change", function (e) {
					$('#start').data("DateTimePicker").maxDate(e.date);
				});
			});
	</script>
@endsection