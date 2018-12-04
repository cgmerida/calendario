@extends('admin.master')

@section('content')

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


    <div id="calendar" class="pT-20"></div>
@endsection
 
@section('js')
    @include('calendar.partials.js')
    @include('events.partials.selects')
@endsection