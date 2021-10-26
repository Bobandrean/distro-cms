@if(session()->get('permissions') && in_array('supplier', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('supplier.index') }}">
            <i class="fas fa-fw fa-building text-success"></i> @lang('menu.supplier')
        </a>
    </li>
@endif
