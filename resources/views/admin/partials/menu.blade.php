<li class="nav-item">
    <a class='sidebar-link' href="{{ route('admin.dash') }}">
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="title">Dashboard</span>
    </a>
</li>


@can('users.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('users.index') }}">
        <span class="icon-holder">
            <i class="c-red-500 ti-user"></i>
        </span>
        <span class="title">Usuarios</span>
    </a>
</li>
@endcan

@can('roles.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('roles.index') }}">
        <span class="icon-holder">
            <i class="c-purple-500 ti-id-badge"></i>
        </span>
        <span class="title">Roles</span>
    </a>
</li>
@endcan

@can('contingencies.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('contingencies.index') }}">
        <span class="icon-holder">
            <i class="c-brown-700 ti-alert"></i>
        </span>
        <span class="title">Contingencias</span>
    </a>
</li>
@endcan

@can('priorities.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('priorities.index') }}">
        <span class="icon-holder">
            <i class="c-indigo-700 ti-list"></i>
        </span>
        <span class="title">Prioridades</span>
    </a>
</li>
@endcan

@can('unities.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('unities.index') }}">
        <span class="icon-holder">
            <i class="c-pink-900 ti-face-smile"></i>
        </span>
        <span class="title">Unidades</span>
    </a>
</li>
@endcan

@can('activities.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('activities.index') }}">
        <span class="icon-holder">
            <i class="c-red-900 ti-agenda"></i>
        </span>
        <span class="title">Actividades</span>
    </a>
</li>
@endcan

@can('colonies.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('colonies.index') }}">
        <span class="icon-holder">
            <i class="c-blue-900 ti-pin"></i>
        </span>
        <span class="title">Colonias</span>
    </a>
</li>
@endcan

@can('events.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('events.index') }}">
        <span class="icon-holder">
            <i class="c-white-500 ti-bookmark"></i>
        </span>
        <span class="title">Eventos</span>
    </a>
</li>
@endcan

@can('events.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('calendar') }}">
        <span class="icon-holder">
            <i class="c-green-500 ti-calendar"></i>
        </span>
        <span class="title">Calendario</span>
    </a>
</li>
@endcan

@can('calendar.show')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('calendar.show') }}">
        <span class="icon-holder">
            <i class="c-green-900 ti-calendar"></i>
        </span>
        <span class="title">Calendario</span>
    </a>
</li>
@endcan