@extends('admin.master')

@section('css')
    @include('admin.partials.datatables')
@endsection

@section('page-header')
    Actividades <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route('activities.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Requerimientos</th>
                    <th>Unidad Ejecutora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Requerimientos</th>
                    <th>Unidad Ejecutora</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection

@section('js')
    <script>
        $('#dataTable').DataTable({
            ajax: '/api/activities',
            columns: [
                {data: 'name'},
                {data: 'require'},
                {data: 'unity.name'},
                {data: 'actions'}
            ]
        });
    </script>
@endsection