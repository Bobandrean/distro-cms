@if(session()->get('permissions') && in_array('penetration_map', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('map.index') }}">
            <span class="align-middle"><i class="fas fa-fw fa-map-marker-alt text-success"></i> @lang('menu.map')</span>
        </a>
    </li>
@endif
