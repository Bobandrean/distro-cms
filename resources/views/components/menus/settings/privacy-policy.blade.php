@if(session()->get('permissions') && in_array('privacy_policy', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('privacy-policy.index') }}">
            <i class="fas fa-fw fa-user-secret text-success"></i> @lang('menu.privacy_policy')
        </a>
    </li>
@endif
