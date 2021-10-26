<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
<div class="container">
    <h2>INVOICE PENGIRIMAN PRODUK</h2>
    <hr width="100%">
    <table>
    <tr>
        <td>
            No. Invoice
        </td>
        <td>
            :
        </td>
        <td>
            {{ $item->po->kode_po }}
        </td>
    </tr>
    <tr>
        <td>
            No. Pengiriman
        </td>
        <td>
            :
        </td>
        <td>
            {{ $item->kode_do }}
        </td>
    </tr>
    <tr>
        <td>
            Tanggal Pengiriman
        </td>
        <td>
            :
        </td>
        <td>
            {{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}
        </td>
    </tr>
    <tr>
        <td>
            Nama Pemasok
        </td>
        <td>
            :
        </td>
        <td>
            {{ $item->po->pemasok->nama_perusahaan }} ({{ $item->po->pemasok->nama_pic }})
        </td>
    </tr>
    <tr>
        <td>
            Nama Pengirim
        </td>
        <td>
            :
        </td>
        <td>
            {{ $item->po->tipe_pengiriman->nama }}
        </td>
    </tr>
     <tr>
        <td>
            Nama Penerima
        </td>
        <td>
            :
        </td>
        <td>
            {{ $item->po->po_billing->nama_usaha }} {{ $item->po->po_billing->nama_depan }} {{ $item->po->po_billing->nama_belakang }}
        </td>
    </tr>
    <tr>
        <td>
            Alamat Penerima
        </td>
        <td>
            :
        </td>
        <td>
            {{ $item->po->po_billing->alamat }}, {{ $item->po->po_billing->provinsi }}, {{ $item->po->po_billing->kota }}, {{ $item->po->po_billing->kecamatan }}, {{ $item->po->po_billing->kelurahan }}, {{ $item->po->po_billing->kode_pos }}
        </td>
    </tr>
    <tr>
        <td>
            Nomor Telepon
        </td>
        <td>
            :
        </td>
        <td>
            {{ $item->po->po_billing->msisdn }}
        </td>
    </tr>
    </table>
    <hr width="100%">
    <table width="100%" cellpadding='0' cellspacing='0'>
        <thead>
            <tr style="text-align: center;">
                <th style="width:150px" style="height:30px;">Nama Produk</th>
                <th style="width:150px">Berat</th>
                <th style="width:150px">Jumlah Barang</th>
                <th style="width:150px">Total Berat</th>
            </tr>
        </thead>
        <tbody>
        @foreach($item->po->po_barang as $product)
            <tr>
            <td style="text-align: center;">{{ $product->produk->kode }} - {{ $product->produk->nama }}</td>
            <td style="text-align: center;">{{ number_format($product->produk->berat) }} kg</td>
            <td style="text-align: center;">{{ number_format($product->jumlah) }}</td>
            <td style="text-align: center;">{{ number_format($product->jumlah * $product->produk->berat) }} kg</td>
            </tr>
            @endforeach
        </tbody>
{{--        <tfoot>--}}
{{--            <tr>--}}
{{--                <td colspan="2" align="right">--}}
{{--                <br>--}}
{{--                <br>--}}
{{--                <br>--}}
{{--                <b>Total : </b></td>--}}
{{--                <td align="center" style="height:30px;">--}}
{{--                <br>--}}
{{--                <br>--}}
{{--                <br>--}}
{{--                {{  $item->po->total  }}</td>--}}
{{--            </tr>--}}
{{--        </tfoot>--}}
    </table> <br /><br />

    <table>
        <thead>
            <tr style="text-align: center;">
                <th>Disiapkan Oleh</th>
                <th>Dikirim Oleh</th>
                <th>Diterima Oleh</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding:60px;border:1px solid;">
                </td>
                <td style="padding:60px;border:1px solid;">
                </td>
                <td style="padding:60px;border:1px solid;">
                </td>
            </tr>
        </tbody>
    </table>

    <!-- <p><b>REKENING</b><br>
        Account : 566 80 000 9518<br>
        A.N PT. MITRA GROSIR NUSANTARA<br>
        BANK OCBC NISP
    </p>
    <p>Dokumen ini sah<br>
       Telah ditandatangani secara elektronik
    </p> -->
</div>
</body>
</html>
