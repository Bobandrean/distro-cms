@if(session()->get('permissions') && in_array('delivery_order_history', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('delivery-order-history.index') }}">
            <i class="fas fa-fw fa-truck-loading text-success"></i> @lang('menu.delivery_order_history')
        </a>
    </li>
@endif
