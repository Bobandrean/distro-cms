@if(session()->get('permissions') && in_array('access', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('access.index') }}">
            <i class="fas fa-fw fa-user-lock text-success"></i> @lang('menu.access')
        </a>
    </li>
@endif
