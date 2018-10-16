@extends('admin.master')

@section('page-header')
    Eventos <small>(Administración)</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route('events.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
            
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>
                            <a href="{{ route('events.edit', $event) }}">
                                {{ $event->title }}
                            </a>
                        </td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->start->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $event->end->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $event->status }}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route('events.edit', $event) }}"
                                    title="{{ trans('app.edit_title') }}"
                                    class="btn btn-outline-primary btn-sm">
                                        <span class="ti-pencil"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route('events.destroy', $event), 
                                        'method' => 'DELETE',
                                        ]) 
                                    !!}

                                        <button class="btn btn-outline-danger btn-sm"
                                        title="{{ trans('app.delete_title') }}">
                                            <i class="ti-trash"></i>
                                        </button>
                                        
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>

@endsection