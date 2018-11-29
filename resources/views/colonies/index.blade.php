@extends('admin.master')

@section('css')
    @include('admin.partials.datatables')
@endsection

@section('page-header')
    Colonias <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

    @can('colonies.create')
        <div class="mB-20">
            <a href="{{ route('colonies.create') }}" class="btn btn-info">
                {{ trans('app.add_button') }}
            </a>
        </div>
    @endcan

    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Colonia</th>
                    <th>Zona</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tfoot>
                <th>Colonia</th>
                <th>Zona</th>
                <th>Acciones</th>
                </tr>
            </tfoot>
        
        </table>
    </div>

@endsection

@section('js')
    <script>
        $('#dataTable').DataTable({
            ajax: '/api/colonies',
            columns: [
                {data: 'colony'},
                {data: 'zone'},
                {data: 'actions'}
            ]
        });
    </script>
@endsection