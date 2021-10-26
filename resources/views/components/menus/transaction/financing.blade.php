@if(session()->get('permissions') && in_array('financing', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('financing.index') }}">
            <i class="fas fa-fw fa-dollar-sign text-success"></i> @lang('menu.financing')
        </a>
    </li>
@endif
