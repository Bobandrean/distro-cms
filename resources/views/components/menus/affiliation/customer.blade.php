@if(session()->get('permissions') && in_array('customer', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('customer.index') }}">
            <i class="fas fa-fw fa-user text-success"></i> @lang('menu.customer')
        </a>
    </li>
@endif
