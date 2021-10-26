@if(session()->get('permissions') && in_array('stock', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('stock.index') }}">
            <i class="fas fa-fw fa-warehouse text-success"></i> @lang('menu.stock')
        </a>
    </li>
@endif
