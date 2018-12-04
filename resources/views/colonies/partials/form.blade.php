<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'Nombre de la colonia', ['required']) !!}

			{!! Form::myInput('number', 'zone', 'Zona', ['required', 'min' => 1, 'max' => 25]) !!}

			<div class="form-group">
				<label for="map">Mapa</label>
				<div class="map-location-search-wrapper">
					<div class="map-location-search">
						<i class="ti-search"></i>
						<input type="text" class="form-control" id="map-location-search" placeholder="Buscar un lugar..." autocomplete="off">
					</div>
				</div>
				
				<div id="google-map" style="height:65vh;"></div>
			</div>
			
			{!! Form::myInput('text', 'lat', 'Latitud', ['readonly' => true, 'required']) !!}
			
			{!! Form::myInput('text', 'lng', 'Longitud', ['readonly' => true, 'required']) !!}
		</div>	
	</div>
</div>