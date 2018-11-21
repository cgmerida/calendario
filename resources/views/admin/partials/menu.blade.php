<li class="nav-item mT-30 active">
    <a class='sidebar-link' href="{{ route('admin.dash') }}" default>
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="title">Dashboard</span>
    </a>
</li>

@can('user.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('users.index') }}">
        <span class="icon-holder">
            <i class="c-red-500 ti-user"></i>
        </span>
        <span class="title">Usuarios</span>
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

<li class="nav-item">
    <a class='sidebar-link' href="{{ route('calendar') }}">
        <span class="icon-holder">
            <i class="c-green-500 ti-calendar"></i>
        </span>
        <span class="title">Calendario</span>
    </a>
</li>