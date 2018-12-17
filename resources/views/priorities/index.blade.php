@extends('admin.master')

@section('css')
    @include('admin.partials.datatables')

    <style>
        .color-div {
            width: 100%;
            height: 20px;
            border: 1px solid rgba(0, 0, 0, .2);
        }
    </style>
@endsection

@section('page-header')
    Prioridades <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

    @can('users.create')
        <div class="mB-20">
            <a href="{{ route('priorities.create') }}" class="btn btn-info">
                {{ trans('app.add_button') }}
            </a>
        </div>
    @endcan

    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Color del texto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Color del texto</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection

@section('js')
    <script>
        $('#dataTable').DataTable({
            ajax: '/api/priorities',
            columns: [
                {data: 'name'},
                {data: 'color', orderable: false},
                {data: 'textColor', orderable: false},
                {data: 'actions', orderable: false}
            ]
        });
    </script>
@endsection