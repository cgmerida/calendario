<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'Nombre de la actividad') !!}

			{!! Form::myInput('text', 'require', 'Requerimientos') !!}

			{!! Form::mySelect('unity_id', 'Unidad a la que pertenece', $unities) !!}
		</div>  
	</div>
</div>