@extends('admin.master')

@section('page-header')
	Colonia <small>{{ trans('app.update_item') }}</small>
@stop

@section('css')
	@include('colonies.partials.map-style')
@endsection

@section('content')
	{!! Form::model($colony, [
			'route' => ['colonies.update', $colony],
			'method' => 'put',
		])
	!!}

		@include('colonies.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('colonies/partials/map-js')

	<script defer>
		$(window).on('load', function() {
			const latitude = document.getElementById('lat').value;
			const longitude = document.getElementById('lng').value;
			
			createMarker(new google.maps.LatLng(latitude, longitude));
		});
	</script>
@endsection
