
{!! Form::open([
    'id' => 'calendar-form',
    'method' => 'put',
    ])
!!}
    
    {!! Form::mySelect('unity_id', 'Unidad ejecutora', $unities) !!}
            
    {!! Form::mySelect('activity_id', 'Actividad', $activities) !!}

    {!! Form::mySelect('zone', 'Zona', $zones) !!}

    {!! Form::mySelect('colony_id', 'Colonia', $colonies) !!}
    
    {!! Form::myTextArea('address', 'Dirección') !!}
    
    {!! Form::myTextArea('description', 'Descripción') !!}
    
    {!! Form::myInput('text', 'date', 'Fecha', ['readonly' => 'true']) !!}
    
    {!! Form::myInput('time', 'start', 'Hora Inicio') !!}

    {!! Form::myInput('time', 'end', 'Hora Finalización') !!}
    
{!! Form::close() !!}