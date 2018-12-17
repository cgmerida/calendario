@extends('admin.master')

@section('css')
    @include('admin.partials.datatables')
@endsection

@section('page-header')
    Unidades Ejecutoras <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

    @can('users.create')
        <div class="mB-20">
            <a href="{{ route('unities.create') }}" class="btn btn-info">
                {{ trans('app.add_button') }}
            </a>
        </div>
    @endcan


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection

@section('js')
    <script>
        $('#dataTable').DataTable({
            ajax: '/api/unities',
            columns: [
                {data: 'name'},
                {data: 'actions'}
            ]
        });
    </script>
@endsection