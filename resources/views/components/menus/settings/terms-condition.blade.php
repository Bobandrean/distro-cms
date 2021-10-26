@if(session()->get('permissions') && in_array('terms_condition', session()->get('permissions')['show']))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('terms-condition.index') }}">
            <i class="fas fa-fw fa-check-square text-success"></i> @lang('menu.terms_condition')
        </a>
    </li>
@endif
