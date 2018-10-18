
{!! Form::open([
        'id' => 'calendar-form'
    ])
!!}
    @method('PUT')

    {!! Form::myInput('text', 'title', 'Titulo') !!}
                
    {!! Form::myTextArea('description', 'Descripcion') !!}
    
    {!! Form::myInput('text', 'date', 'Fecha', ['readonly' => 'true']) !!}
    
    {!! Form::myInput('time', 'start', 'Hora Inicio') !!}

    {!! Form::myInput('time', 'end', 'Hora Finalización') !!}
    
{!! Form::close() !!}