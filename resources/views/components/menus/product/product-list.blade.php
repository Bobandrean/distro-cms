@if(session()->get('permissions') && in_array('product', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('product.index') }}">
            <i class="fas fa-fw fa-cube text-success"></i> @lang('menu.product_list')
        </a>
    </li>
@endif
