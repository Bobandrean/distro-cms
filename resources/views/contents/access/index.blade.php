@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/access.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="my-3">
                            <form action="" method="GET" enctype="multipart/form-data">
                                <div class="form-group">
                                    <select name="role_id" class="form-control">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" @if(isset($item->id) && $item->id == $role->id) selected @endif>{{ $role->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-warning">
                                    <i class="fa fa-fw fa-search"></i> @lang('global.filter_button_txt')
                                </button>
                            </form>
                            @if(isset($request->role_id) && !empty($request->role_id))
                                <div class="table-responsive">
                                    <form action="{{ route('access.update', $request->role_id) }}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="pb-3 text-right">
                                            <button type="submit" class="btn btn-sm btn-success"><i
                                                    class="fa fa-fw fa-save"></i> @lang('global.submit_button_txt')
                                            </button>
                                        </div>
                                        <table class="table table-bordered table-striped">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>@lang('pages/access.table.col_1')</th>
                                                <th class="text-center">@lang('pages/access.table.col_2')</th>
                                                <th class="text-center">@lang('pages/access.table.col_3')</th>
                                                <th class="text-center">@lang('pages/access.table.col_4')</th>
                                                <th class="text-center">@lang('pages/access.table.col_5')</th>
                                                <th class="text-center">@lang('pages/access.table.col_6')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th class="table-success" colspan="6">@lang('pages/access.table.divider.row_1')</th>
                                            </tr>
                                            @include('components.access-role.dashboard')

                                            <tr>
                                                <th class="table-success" colspan="6">@lang('pages/access.table.divider.row_2')</th>
                                            </tr>
                                            @include('components.access-role.supplier')
                                            @include('components.access-role.banner-gratia')
                                            @include('components.access-role.banner')
                                            @include('components.access-role.buyer-type')
                                            @include('components.access-role.product-category')

                                            <tr>
                                                <th class="table-success" colspan="6">@lang('pages/access.table.divider.row_3')</th>
                                            </tr>
                                            @include('components.access-role.price-catalogue')
                                            @include('components.access-role.product')
                                            @include('components.access-role.stock')

                                            <tr>
                                                <th class="table-success" colspan="6">@lang('pages/access.table.divider.row_4')</th>
                                            </tr>
                                            @include('components.access-role.purchase-order')
                                            @include('components.access-role.delivery-order')
                                            @include('components.access-role.delivery-order-history')
                                            @include('components.access-role.financing')

                                            <tr>
                                                <th class="table-success" colspan="6">@lang('pages/access.table.divider.row_5')</th>
                                            </tr>
                                            @include('components.access-role.customer')
                                            @include('components.access-role.new-customer')

                                            <tr>
                                                <th class="table-success" colspan="6">@lang('pages/access.table.divider.row_6')</th>
                                            </tr>
                                            @include('components.access-role.penetration-map')

                                            <tr>
                                                <th class="table-success" colspan="6">@lang('pages/access.table.divider.row_7')</th>
                                            </tr>
                                            @include('components.access-role.ticket')

                                            <tr>
                                                <th class="table-success" colspan="6">@lang('pages/access.table.divider.row_8')</th>
                                            </tr>
                                            @include('components.access-role.notification')

                                            <tr>
                                                <th class="table-success" colspan="6">@lang('pages/access.table.divider.row_9')</th>
                                            </tr>
                                            @include('components.access-role.disbursement')
                                            @include('components.access-role.pending-disbursement')
                                            @include('components.access-role.available-credit-line')
                                            @include('components.access-role.aging')

                                            <tr>
                                                <th class="table-success" colspan="6">@lang('pages/access.table.divider.row_10')</th>
                                            </tr>
                                            @include('components.access-role.log-activity')
                                            @include('components.access-role.log-login')

                                            <tr>
                                                <th class="table-success" colspan="6">@lang('pages/access.table.divider.row_11')</th>
                                            </tr>
                                            @include('components.access-role.access')
                                            @include('components.access-role.privacy-policy')
                                            @include('components.access-role.terms-condition')

                                            <tr>
                                                <th class="table-success" colspan="6">@lang('pages/access.table.divider.row_12')</th>
                                            </tr>
                                            @include('components.access-role.document')
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
