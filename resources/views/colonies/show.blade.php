@extends('admin.master')

@section('page-header')
	Colonia <small>{{ trans('app.update_item') }}</small>
@stop

@section('css')
	@include('colonies.partials.map-style')
@endsection

@section('content')
	{!! Form::model($colony, [
            'id' => 'main-form'
		])
	!!}

		@include('colonies.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('admin.partials.disable')
	@include('colonies.partials.map-js')

	<script defer>
		$(window).on('load', function() {
			const latitude = document.getElementById('lat').value;
			const longitude = document.getElementById('lng').value;
			
			createMarker(new google.maps.LatLng(latitude, longitude));
		});
	</script>
@endsection
