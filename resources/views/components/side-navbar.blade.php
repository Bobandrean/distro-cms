<nav id="sidebar" class="sidebar">
    <a class="sidebar-brand" href="{{ route('dashboard.index') }}">
        <img src="{{ asset('asset/logo/logo-white.png') }}" width="132" alt="">
    </a>
    <div class="sidebar-content">
        <div class="sidebar-user">
            <img src="{{ asset('asset/image/corporate-user.jpg') }}" class="img-fluid rounded-circle mb-2"/>
            <div class="font-weight-bold">{{ session()->get('user')->username }}</div>
            @if (session()->get('user')->tipe_akun->slug != 'pembeli')
                <small>{{ session()->get('user')->tipe_akun->nama }}</small>
            @endif
        </div>

        <ul class="sidebar-nav">
            @include('components.menus.dashboard')

            @if(session()->get('permissions') && in_array('supplier', session()->get('permissions')['show']) ||
                session()->get('permissions') && in_array('banner', session()->get('permissions')['show']) ||
                session()->get('permissions') && in_array('banner_gratia', session()->get('permissions')['show']) ||
                session()->get('permissions') && in_array('buyer_type', session()->get('permissions')['show']) ||
                session()->get('permissions') && in_array('product_category', session()->get('permissions')['show']))
                <li class="sidebar-item">
                    <a href="#master" data-toggle="collapse" class="sidebar-link collapsed">
                        <span class="align-middle"><i class="fas fa-fw fa-folder-open text-success"></i> @lang('menu.master')</span>
                    </a>
                    <ul id="master" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        @include('components.menus.master.supplier')
                        @include('components.menus.master.banner-gratia')
                        @include('components.menus.master.banner')
                        @include('components.menus.master.buyer-type')
                        @include('components.menus.master.product-category')
                    </ul>
                </li>
            @endif

            @if(session()->get('permissions') && in_array('price_catalogue', session()->get('permissions')['show']) ||
                session()->get('permissions') && in_array('product', session()->get('permissions')['show']) ||
                session()->get('permissions') && in_array('stock', session()->get('permissions')['show']))
                <li class="sidebar-item">
                    <a href="#product" data-toggle="collapse" class="sidebar-link collapsed">
                        <span class="align-middle"><i class="fas fa-fw fa-cubes text-success"></i> @lang('menu.product')</span>
                    </a>
                    <ul id="product" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        @include('components.menus.product.product-list')
                        @include('components.menus.product.price-catalogue')
                        @include('components.menus.product.stock')
                    </ul>
                </li>
            @endif

            @if(session()->get('permissions') && in_array('purchase_order', session()->get('permissions')['show']) ||
                session()->get('permissions') && in_array('delivery_order', session()->get('permissions')['show']) ||
                session()->get('permissions') && in_array('delivery_order_history', session()->get('permissions')['show']) ||
                session()->get('permissions') && in_array('financing', session()->get('permissions')['show']))
                <li class="sidebar-item">
                    <a href="#transaction" data-toggle="collapse" class="sidebar-link collapsed">
                        <span class="align-middle"><i class="fas fa-fw fa-file-invoice text-success"></i> @lang('menu.transaction')</span>
                    </a>
                    <ul id="transaction" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        @include('components.menus.transaction.purchase-order')
                        @include('components.menus.transaction.delivery-order')
                        @include('components.menus.transaction.delivery-order-history')
                        @include('components.menus.transaction.financing')
                    </ul>
                </li>
            @endif

            @if(session()->get('permissions') && in_array('customer', session()->get('permissions')['show']) ||
               session()->get('permissions') && in_array('new_customer', session()->get('permissions')['show']))
                <li class="sidebar-item">
                    <a href="#user" data-toggle="collapse" class="sidebar-link collapsed">
                        <span class="align-middle"><i
                                class="fas fa-fw fa-users text-success"></i> @lang('menu.user')</span>
                    </a>
                    <ul id="user" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        @include('components.menus.affiliation.customer')
                        @include('components.menus.affiliation.new-customer')
                        @include('components.menus.affiliation.reject')
                    </ul>
                </li>
            @endif

            @include('components.menus.map')

            @include('components.menus.ticket')

            @include('components.menus.notification')

            @if(session()->get('permissions') && in_array('disbursement', session()->get('permissions')['show']) ||
                session()->get('permissions') && in_array('pending_disbursement', session()->get('permissions')['show']) ||
                session()->get('permissions') && in_array('available_credit_line', session()->get('permissions')['show']) ||
                session()->get('permissions') && in_array('aging', session()->get('permissions')['show']))
                <li class="sidebar-item">
                    <a href="#reporting" data-toggle="collapse" class="sidebar-link collapsed">
                        <span class="align-middle"><i class="fas fa-fw fa-file-invoice text-success"></i> @lang('menu.reporting')</span>
                    </a>
                    <ul id="reporting" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        @include('components.menus.reporting.disbursement')
                        @include('components.menus.reporting.pending-disbursement')
                        @include('components.menus.reporting.available-credit-line')
                        @include('components.menus.reporting.aging')
                    </ul>
                </li>
            @endif

            @if(session()->get('permissions') && in_array('log_activity', session()->get('permissions')['show']) ||
               session()->get('permissions') && in_array('log_login', session()->get('permissions')['show']))
                <li class="sidebar-item">
                    <a href="#log" data-toggle="collapse" class="sidebar-link collapsed">
                        <span class="align-middle"><i class="fas fa-fw fa-terminal text-success"></i> @lang('menu.log')</span>
                    </a>
                    <ul id="log" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        @include('components.menus.log.log-activity')
                        @include('components.menus.log.log-login')
                    </ul>
                </li>
            @endif

            @if(session()->get('permissions') && in_array('access', session()->get('permissions')['show']) ||
               session()->get('permissions') && in_array('privacy_policy', session()->get('permissions')['show']) ||
               session()->get('permissions') && in_array('terms_condition', session()->get('permissions')['show']))
                <li class="sidebar-item">
                    <a href="#setting" data-toggle="collapse" class="sidebar-link collapsed">
                        <span class="align-middle"><i class="fas fa-fw fa-cogs text-success"></i> @lang('menu.setting')</span>
                    </a>
                    <ul id="setting" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        @include('components.menus.settings.access')
                        @include('components.menus.settings.privacy-policy')
                        @include('components.menus.settings.terms-condition')
                    </ul>
                </li>
            @endif

            @if(session()->get('permissions') && in_array('document', session()->get('permissions')['show']))
                @include('components.menus.document')
            @endif
        </ul>
    </div>
</nav>
