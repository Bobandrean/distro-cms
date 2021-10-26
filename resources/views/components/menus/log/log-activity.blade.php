@if(session()->get('permissions') && in_array('log_activity', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('log-activity.index') }}">
            <i class="fas fa-fw fa-chart-bar text-success"></i> @lang('menu.activity_log')
        </a>
    </li>
@endif
