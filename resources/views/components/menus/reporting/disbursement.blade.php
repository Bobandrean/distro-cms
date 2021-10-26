@if(session()->get('permissions') && in_array('disbursement', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('disbursement.index') }}">
            <i class="fas fa-fw fa-book text-success"></i> @lang('menu.disbursement_report')
        </a>
    </li>
@endif
