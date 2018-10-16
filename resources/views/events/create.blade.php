@extends('admin.master')

@section('page-header')
	Evento <small>({{ trans('app.add_new_item') }})</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'events.store'
		])
	!!}

		@include('events.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}

@stop

@section('js')
	<script>
			$(function(){
				$('#start').datetimepicker({
					useCurrent: false,
					format: 'YYYY-MM-DD HH:mm',
					locale: 'es',
					sideBySide: true,
					daysOfWeekDisabled: [1]
				});

				$('#end').datetimepicker({
					useCurrent: false,
					format: 'YYYY-MM-DD HH:mm',
					locale: 'es',
					sideBySide: true,
					daysOfWeekDisabled: [1]
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
