<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'title', 'Titulo') !!}
            
            {!! Form::myTextArea('description', 'Descripcion') !!}

            {{ Form::label('start', 'Fecha Inicio') }}
            {{ Form::date('start', \Carbon\Carbon::now(), ['class' => 'form-control']) }}

            
		</div>  
	</div>
</div>