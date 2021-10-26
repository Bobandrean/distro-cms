@if(session()->get('permissions') && in_array('purchase_order', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('purchase-order.index') }}">
            <i class="fas fa-fw fa-shopping-cart text-success"></i> @lang('menu.purchase_order')
        </a>
    </li>
@endif
