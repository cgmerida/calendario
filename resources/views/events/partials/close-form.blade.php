
{!! Form::mySelect('status', 'Estado', $statuses) !!}

{!! Form::myTextArea('response', 'Respuesta') !!}

{!! Form::myInput('number', 'attendance', 'Asistencia') !!}

<h3>Lista de Contingencias</h3>
<div class="form-group">
    <ul class="list-unstyled">
        @foreach ($contingencies as $contingency)
            <li>
                {!! Form::myCheckbox('contingencies[]', 'contingency'.$contingency->id, $contingency->name, $contingency->id, null) !!}
            </li>
        @endforeach
    </ul>
</div>