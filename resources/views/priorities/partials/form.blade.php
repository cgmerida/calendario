<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			@php
				$textColors = [
					null => 'Color de texto',
					'#fff' => 'Blanco',
					'#000' => 'Negro'
				];
			@endphp
			
			{!! Form::myInput('text', 'name', 'Nombre la prioridad') !!}
			
			{!! Form::myInput('color', 'color', 'Color') !!}
			
			{!! Form::mySelect('textColor', 'Color del texto', $textColors) !!}
		</div>  
	</div>
</div>