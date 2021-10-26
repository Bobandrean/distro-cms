@if(session()->get('permissions') && in_array('notification', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('notification.index') }}">
           <i class="fas fa-fw fa-bell text-success"></i> @lang('menu.notification')
        </a>
    </li>
@endif
