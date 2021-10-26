@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/ongoing-transaction.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">@lang('global.tab_all_txt') <span class="badge badge-secondary"></span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="my-3">
                                    <div class="table-responsive">
                                        <form action="" method="GET" enctype="multipart/form-data">
                                            <table class="table table-bordered table-striped">
                                                <caption>{{ $items->withQueryString()->links() }}</caption>
                                                <thead class="thead-light">
                                                <tr class="text-center">
                                                <th>Nama Usaha</th>
                                                <th>No telepon</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                </tr>
                                               
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($items as $item)
                                                    <tr>
                                                        <td>{{ $item->nama_usaha }}</td>
                                                        <td>{{ $item->msisdn }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->alamat }}</td>

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
        </div>
    </div>
@endsection
