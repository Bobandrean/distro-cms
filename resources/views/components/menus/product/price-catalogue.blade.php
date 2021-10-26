@if(session()->get('permissions') && in_array('price_catalogue', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('price-catalogue.index') }}">
            <i class="fas fa-fw fa-file-invoice-dollar text-success"></i> @lang('menu.price_catalogue')
        </a>
    </li>
@endif
