<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'title', 'Titulo') !!}
            
            {!! Form::myTextArea('description', 'Descripcion') !!}

            {!! Form::datePicker('start', 'Fecha Inicio', ['id' => 'start']) !!}

            {!! Form::datePicker('end', 'Fecha Fin', ['id' => 'end']) !!}
            
            {{-- {!! Form::myInput('color', 'color', 'Color') !!} --}}
            
		</div>  
	</div>
</div>