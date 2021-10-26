<div class="tab-content">
    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
        <div class="my-3">
            <div class="table-responsive">
                <form action="" method="GET" enctype="multipart/form-data">
                    <table class="table table-bordered table-striped">
                    <caption>{{ $poDueDates->withQueryString()->links() }}</caption>
                    <thead class="thead-light">
                    <tr>
                        <th>OutDate</th>
                        <th>PO Number</th>
                        <th>Distributor</th>
                        <th>Supplier</th>
                        <th>P2P</th>
                        <th>TOP</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment Status</th>
                        
                    </tr>
                    <tr>
                        <th>
                           
                        </th>

                        <th>
                        
                        </th>
                        <th>

                        </th>
                        <th>

                        </th>
                        <th>

                        </th>
                        <th>

                        </th>
                        <th>

                        </th>
                        <th>

                        </th>
                        <th>
                        
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($poDueDates as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->po_detail->jatuh_tempo)->format('Y-m-d') }}</td>
                                                        <td><a href="{{ route('purchase-order.view', $item->id) }}"
                                                               target="_blank">{{ $item->kode_po }}</a></td>
                                                        <td>{{ $item->pembeli->nama_usaha }}
                                                            {{--                                                            <br>--}}
                                                            {{--                                                            ({{ $item->pembeli->nama_depan }} {{ $item->pembeli->nama_belakang }} )--}}
                                                        </td>
                                                        <td>{{ $item->pemasok->nama_perusahaan }}
                                                            {{--                                                                <br>--}}
                                                            {{--                                                                ({{ $item->pemasok->nama_pic }})--}}
                                                        </td>
                                                        <td>{{ $item->tipe_pembayaran->nama }}</td>
                                                        <td>{{ $item->po_detail->lama_pinjaman }} hari</td>
                                                        <td>
                                                            Rp{{ number_format($item->subtotal, 2, '.', ',') }}</td>
                                                        <td>
                                                            <b @if($item->status_po == 'Menunggu') class="text-dark"
                                                               @elseif($item->status_po == 'Dibatalkan') class="text-danger"
                                                               @elseif($item->status_po == 'Diterima_Pemasok') class="text-warning"
                                                               @elseif($item->status_po == 'Diterima_Gudang') class="text-success" @endif>
                                                                {{ $item->status_po }}
                                                            </b>
                                                        </td>
                                                        <td>
                                                            @if($item->po_detail->status_pelunasan == 'Belum Lunas')
                                                                <p class="text-danger">Belum Lunas</p>
                                                            @elseif($item->po_detail->status_pelunasan == 'Lunas')
                                                                <p class="text-success">Lunas</p>
                                                            @endif

                                                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
</div>