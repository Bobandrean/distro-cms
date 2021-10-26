@if(session()->get('permissions') && in_array('product_category', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('product-category.index') }}">
            <i class="fas fa-fw fa-th-list text-success"></i> @lang('menu.product_category')
        </a>
    </li>
@endif
