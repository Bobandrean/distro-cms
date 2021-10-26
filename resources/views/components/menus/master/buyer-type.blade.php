@if(session()->get('permissions') && in_array('buyer_type', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('buyer-type.index') }}">
            <i class="fas fa-fw fa-user-cog text-success"></i> @lang('menu.buyer_type')
        </a>
    </li>
@endif
