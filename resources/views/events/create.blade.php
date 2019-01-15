@extends('admin.master')

@section('page-header')
	Evento <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'events.store',
			'autocomplete' => 'off'
		])
	!!}

		@include('events.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}

@stop

@section('js')
	<script>
		$(function(){
			let currentDate = new Date();
			currentDate.setDate(currentDate.getDate() + 15);
			currentDate.setHours(0,0,0,0);
			
			$('#start').datetimepicker({
				minDate: currentDate,
				defaultDate: currentDate
			});

			$('#end').datetimepicker();
			
			$("#start").on("dp.change", function (e) {
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