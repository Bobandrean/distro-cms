<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h4>@lang('pages/dashboard.widget.top_product_categories.title')</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                        <tr class="text-center">
                            <th>@lang('pages/dashboard.widget.top_product_categories.table.col_1')</th>
                            <th>@lang('pages/dashboard.widget.top_product_categories.table.col_2')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topProductCategories as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td class="text-right">Rp{{ number_format($item->total, 2, '.', ',') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
