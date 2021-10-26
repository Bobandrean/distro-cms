@if(session()->get('permissions') && in_array('document', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('document.index', session()->get('department')['id']) }}">
           <i class="fas fa-fw fa-file text-success"></i> @lang('menu.document')
        </a>
    </li>
@endif
