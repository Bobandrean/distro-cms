<nav class="navbar navbar-expand navbar-theme">
    <a class="sidebar-toggle d-flex mr-2">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-toggle="dropdown">
                    <i class="align-middle fas fa-fw fa-cog"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#"><i class="align-middle mr-1 fas fa-fw fa-user"></i> @lang('menu.profile')</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('login.destroy') }}"><i class="align-middle mr-1 fas fa-fw fa-arrow-alt-circle-right"></i> @lang('menu.logout')</a>
                </div>
            </li>
        </ul>
    </div>

</nav>
