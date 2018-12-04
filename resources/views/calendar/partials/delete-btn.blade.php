
@if (Auth::user()->id === $event->user->id)
    @can('events.destroy')

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
    @endcan
@endif