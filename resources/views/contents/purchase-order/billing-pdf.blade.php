<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/invoice.css') }}" rel="stylesheet">
    <title></title>
</head>
<body>
<div class="container">
    <h2>PURCHASE ORDER</h2>
    <hr width="100%">
    <table><br>
        <tr>
            <td>
                No. Invoice
            </td>
            <td>
                :
            </td>
            <td>
                {{ $item->kode_po }}
            </td>
        </tr>
        <tr>
            <td>
                Tanggal
            </td>
            <td>
                :
            </td>
            <td>
                {{ $item->tanggal }}
            </td>
        </tr>
        <tr>
            <td>
                Nama Pembeli
            </td>
            <td>
                :
            </td>
            <td>
                {{ $item->pembeli->nama_usaha}}
            </td>
        </tr>
        <tr>
            <td>
                No. Telepon
            </td>
            <td>
                :
            </td>
            <td>
                {{ $item->pemasok->msisdn }}
            </td>
        </tr>
        <tr>
            <td>
                Alamat
            </td>
            <td>
                :
            </td>
            <td>
                {{ $item->pemasok->alamat }}
            </td>
        </tr>
        <tr>
            <td>
                Pemasok
            </td>
            <td>
                :
            </td>
            <td>
                {{ $item->pemasok->nama_pic }}
            </td>
        </tr>
    </table>
    <hr width="100%">
    <table width="100%" cellpadding='3' cellspacing='3'>
        <thead>
        <tr style="text-align: left;">
            <th style="width:150px;height:30px;" align="left">Nama Produk</th>
            <th style="width:150px" align="left">Harga Produk</th>
            <th style="width:150px" align="left">Jumlah Produk</th>
            <th style="width:150px" align="left">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($item->po_barang as $product)
            <tr>
                <td>{{ $product->produk->kode }} - {{ $product->produk->nama }}</td>
                <td class="text-right">Rp{{ number_format($product->harga,2,".",",") }}</td>
                <td class="text-center">{{ number_format($product->jumlah) }}</td>
                <td class="text-right">Rp{{ number_format($product->total,2,".",",") }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td align="left"><b>Subtotal:</b></td>
            <td align="left"><b>Rp{{ number_format($item->subtotal,2,".",",") }}</b></td>
        </tr>
        {{--            <tr>--}}
        {{--                <td colspan="3" align="right"><b>Biaya Admin : </b></td>--}}
        {{--                <td align="right">Rp{{ number_format($item->biaya_layanan,2,".",",") }}</td>--}}
        {{--            </tr> --}}
        {{--            <tr>--}}
        {{--                <td colspan="3" align="right" style="height:30px;"><b>Biaya Pengiriman ({{ $item->pemasok->nama_pic }}) : </b></td>--}}
        {{--                <td align="right">Rp{{number_format($item->biaya_pengiriman,2,".",",")}}</td>--}}
        {{--            </tr>--}}
        {{--             <tr>--}}
        {{--                <td colspan="3" align="right"><b>Biaya Bunga : </b></td>--}}
        {{--                <td align="right">Rp{{ number_format($item->biaya_bunga,2,".",",") }}</td>--}}
        {{--            </tr> --}}
        {{--            <tr>--}}
        {{--                <td colspan="3" align="right" style="height:30px;"><b>Total : </b></td>--}}
        {{--                <td align="right">Rp{{ number_format($item->total,2,".",",") }}</td>--}}
        {{--            </tr>--}}
        </tfoot>
    </table>

    <!-- <p><b>REKENING</b><br>
        Account : 566 80 000 9518<br>
        A.N PT. MITRA GROSIR NUSANTARA<br>
        BANK OCBC NISP
    </p>
    <p>Dokumen ini sah<br>
       Telah ditandatangani secara elektronik
    </p> -->
</body>
</html>
