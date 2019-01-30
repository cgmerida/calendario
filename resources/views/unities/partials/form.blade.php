<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'Nombre de la unidad ejecutora') !!}
			
            {!! Form::mySelect('priority_id', 'Pioridad', $priorities) !!}
		</div>  
	</div>
</div>