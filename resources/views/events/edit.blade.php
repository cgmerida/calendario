@extends('admin.master')

@section('page-header')
	Evento <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($event, [
			'route' => ['events.update', $event],
			'method' => 'put',
			'autocomplete' => 'off'
		])
	!!}

		@include('events.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
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
				minDate: $('#start').data("DateTimePicker").date(),
				maxDate: $('#start').data("DateTimePicker").date().format('YYYY-MM-DD') + ' 23:59:59'
			});
			
			$("#start").on("dp.change", function (e) {
				// $('#start').data("DateTimePicker").minDate(currentDate);
				$('#end').data("DateTimePicker").minDate(e.date);
				$('#end').data("DateTimePicker").maxDate(e.date.format('YYYY-MM-DD') + ' 23:59:59');
			});

			$("#end").on("dp.change", function (e) {
				$('#start').data("DateTimePicker").maxDate(e.date);
			});
		});
	</script>

	@include('events.partials.selects')
@endsection