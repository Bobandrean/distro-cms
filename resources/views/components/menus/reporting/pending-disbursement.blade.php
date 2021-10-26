@if(session()->get('permissions') && in_array('pending_disbursement', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('pending-disbursement.index') }}">
            <i class="fas fa-fw fa-book text-success"></i> @lang('menu.pending_disbursement_report')
        </a>
    </li>
@endif
