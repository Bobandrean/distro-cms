@if(session()->get('permissions') && in_array('new_customer', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('new-customer.index') }}">
            <i class="fas fa-fw fa-user-plus text-success"></i> @lang('menu.new_customer')
        </a>
    </li>
@endif
