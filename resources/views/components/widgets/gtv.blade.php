<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col mt-0">
                    <h5 class="card-title">@lang('pages/dashboard.widget.gtv_label')</h5>
                </div>

                <div class="col-auto">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-warning-light">
                            <i class="align-middle" data-feather="dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="display-5 mt-1 mb-3" style="font-size: 22px !important;">{{ number_format($totalGTV, 2, '.', ',') }}</h1>
            <div class="mb-0">
               @lang('pages/dashboard.widget.currency_label')
            </div>
        </div>
    </div>
</div>
