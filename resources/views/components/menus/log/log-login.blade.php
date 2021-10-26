@if(session()->get('permissions') && in_array('log_login', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('log-login.index') }}">
            <i class="fas fa-fw fa-sign-in-alt text-success"></i> @lang('menu.login_log')
        </a>
    </li>
@endif
