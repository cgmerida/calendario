
@if (Auth::user()->hasRole('admin') || Auth::user()->id === $event->user->id)

    {!! Form::open([
        'url'  => route('calendar.events.destroy', $event), 
        'method' => 'DELETE',
        ]) 
    !!}

        <button class="btn btn-danger" onclick="deleteEvent(this, {{ $event->id }});"
        type="button" title="{{ trans('app.delete_title') }}">
            Eliminar
        </button>
        
    {!! Form::close() !!}
@endif