@if(session()->get('permissions') && in_array('banner_gratia', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('banner-gratia.index') }}">
            <i class="fas fa-fw fa-file-image text-success"></i> @lang('menu.banner_gratia')
        </a>
    </li>
@endif
