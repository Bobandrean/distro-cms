@if(session()->get('permissions') && in_array('banner', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('banner.index') }}">
            <i class="fas fa-fw fa-file-image text-success"></i> @lang('menu.banner')
        </a>
    </li>
@endif
