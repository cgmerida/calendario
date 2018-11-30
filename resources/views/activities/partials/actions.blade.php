
<ul class="list-inline">
    @can('activities.show')
        <li class="list-inline-item">
            <a href="{{ route('activities.show', $id) }}"
            title="Ver" class="btn btn-sm btn-outline-secondary">
                <span class="ti-eye"></span>
            </a>
        </li>
    @endcan
    
    @can('activities.edit')
        <li class="list-inline-item">
            <a href="{{ route('activities.edit', $id) }}" 
            title="{{ trans('app.edit_title') }}" class="btn btn-outline-primary btn-sm">
                <span class="ti-pencil"></span>
            </a>
        </li>
    @endcan

    @can('activities.destroy')
        <li class="list-inline-item">
            {!! Form::open([
                'class'=>'delete',
                'route'  => ['activities.destroy', $id], 
                'method' => 'DELETE',
                ]) 
            !!}

                <button class="btn btn-outline-danger btn-sm" title="{{ trans('app.delete_title') }}">
                    <i class="ti-trash"></i>
                </button>
                
            {!! Form::close() !!}
        </li>
    @endcan
</ul>