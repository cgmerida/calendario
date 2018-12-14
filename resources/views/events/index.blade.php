@extends('admin.master')

@section('css')
    @include('admin.partials.datatables')
@endsection

@section('page-header')
    Eventos <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')
    <!-- Modal -->
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
                        @include('events.partials.close-form')
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" onclick="$('#close-event').submit();">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="mB-20">
        <a href="{{ route('events.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Dirección</th>
                    <th>Descripción</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Actividad</th>
                    <th>Dirección</th>
                    <th>Descripción</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection

@section('js')
    <script>
        $('#dataTable').DataTable({
            ajax: '/api/events',
            columns: [
                {data: 'activity.name'},
                {data: 'full_address'},
                {data: 'description'},
                {data: 'start'},
                {data: 'end'},
                {data: 'status'},
                {data: 'actions'}
            ]
        });

        $(function() {
            $('#close-modal').on("show.bs.modal", function (e) {
                $("#close-event").attr("action", "events/"+ $(e.relatedTarget).data('id') +"/close");
            });
        });
    </script>
@endsection