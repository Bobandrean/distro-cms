@if(session()->get('permissions') && in_array('available_credit_line', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('available-credit-line.index') }}">
            <i class="fas fa-fw fa-credit-card text-success"></i> @lang('menu.available_credit_line_report')
        </a>
    </li>
@endif
