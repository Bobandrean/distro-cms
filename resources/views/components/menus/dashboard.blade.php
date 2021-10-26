@if(session()->get('permissions') && in_array('dashboard', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('dashboard.index') }}">
           <i class="fas fa-fw fa-home text-success"></i> @lang('menu.dashboard')
        </a>
    </li>
@endif
