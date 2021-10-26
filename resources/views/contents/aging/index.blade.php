@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/aging.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-inline" action="" method="GET" enctype="multipart/form-data">
                            <div class="form-group">
                                <select name="year" class="form-control form-control-sm">
                                    @for($i = 0; $i <= \Carbon\Carbon::now()->format('Y') - 2019; $i++)
                                        <option value="{{ \Carbon\Carbon::now()->format('Y') - $i }}"
                                                @if($request->year == \Carbon\Carbon::now()->format('Y') - $i) selected @endif>
                                            {{ \Carbon\Carbon::now()->format('Y') - $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-warning ml-2"><i
                                        class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')</button>
                                <a href="{{ route('aging.index') }}" class="btn btn-sm btn-danger ml-2"><i
                                        class="fas fa-fw fa-times"></i> @lang('global.reset_button_txt')
                                </a>
                            </div>
                        </form>
                        <div class="my-3">
                            <div class="table-responsive">
                                <form action="" method="GET" enctype="multipart/form-data">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                        <tr class="text-center">
                                            <th>@lang('pages/aging.table.col_1')</th>
                                            <th>@lang('pages/aging.table.col_2')</th>
                                            <th>@lang('pages/aging.table.col_3')</th>
                                            <th>@lang('pages/aging.table.col_4')</th>
                                            <th>@lang('pages/aging.table.col_5')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td><a target="_blank" href="{{ route('aging-view.index', ['year' => $year, 'month' => $item['number']]) }}">{{ $item['period']}}</a></td>
                                                @if($item['total_margin'] == NULL)
                                                    <td class="text-right">Rp0</td>
                                                @else
                                                    <td class="text-right">Rp{{ number_format($item['total_margin'],2,".",",")}}</td>
                                                @endif

                                                <td class="text-center">{{ $item['po']}}</td>

                                                @if( $item['gtv'] == NULL)
                                                    <td class="text-right">Rp0</td>
                                                @else
                                                    <td class="text-right">Rp{{ number_format($item['gtv'],2,".",",")}}</td>
                                                @endif

                                                @if($item['pencairan'] == NULL)

                                                    <td class="text-right">Rp0</td>
                                                @else
                                                    <td class="text-right">Rp{{ number_format($item['pencairan'],2,".",",")}}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
