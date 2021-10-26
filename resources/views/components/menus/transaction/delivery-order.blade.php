@if(session()->get('permissions') && in_array('delivery_order', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('delivery-order.index') }}">
            <i class="fas fa-fw fa-truck text-success"></i> @lang('menu.delivery_order')
        </a>
    </li>
@endif
