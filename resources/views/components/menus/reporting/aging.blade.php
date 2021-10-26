@if(session()->get('permissions') && in_array('aging', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('aging.index') }}">
            <i class="fas fa-fw fa-book text-success"></i> @lang('menu.aging_report')
        </a>
    </li>
@endif
