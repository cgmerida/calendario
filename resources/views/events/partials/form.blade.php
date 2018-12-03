<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
            {!! Form::mySelect('unity_id', 'Unidad ejecutora', $unities) !!}
            
            {!! Form::mySelect('activity_id', 'Actividad', $activities) !!}

            {!! Form::mySelect('zone', 'Zona', $zones) !!}

            {!! Form::mySelect('colony_id', 'Colonia', $colonies) !!}
            
            {!! Form::myTextArea('address', 'Dirección') !!}
            
            {!! Form::myTextArea('description', 'Descripción') !!}

            {!! Form::datePicker('start', 'Fecha Inicio', ['id' => 'start']) !!}

            {!! Form::datePicker('end', 'Fecha Fin', ['id' => 'end']) !!}
            
            {{-- {!! Form::myInput('color', 'color', 'Color') !!} --}}
            
		</div>  
	</div>
</div>