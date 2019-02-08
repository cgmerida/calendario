@extends('admin.master')

@section('content')
    {{-- Modal para crear y editar eventos --}}
    <div class="modal" tabindex="-1" role="dialog" id="calendar-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title c-grey-900"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="c-grey-800 text-center" id="event-title"></h5>
                    @include('calendar.partials.form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <div id="deletable" class="m-0"></div>
                    <button type="button" class="btn btn-primary" id="guardar"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para cerrar -->
    <div class="modal fade" id="close-modal" tabindex="-1" role="dialog" aria-labelledby="close-modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success c-white">
                    <h5 class="modal-title" id="close-modalLabel">Cerrar Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open([
                            'id' => 'close-event',
                        ]) 
                    !!}
                        <input type="hidden" id="event-close-id">
                        @include('events.partials.close-form')
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" onclick="eventClose()">Guardar</button>
                </div>
            </div>
        </div>
    </div>



    <div id="calendar" class="pT-10 mT-nv-40"></div>
@endsection
 
@section('js')
    @include('calendar.partials.js')
    @include('events.partials.selects')
@endsection