@if(session()->get('permissions') && in_array('ticket', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('ticket.index') }}">
            <span class="align-middle"><i class="fas fa-fw fa-comments text-success"></i> @lang('menu.ticket')</span>
        </a>
    </li>
@endif
