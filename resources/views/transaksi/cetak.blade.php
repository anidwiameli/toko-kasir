<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktur Pembayaran</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .invoice {
            width: 70mm;
        }

        table {
            width: 100%;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        hr {
            border-top: 1px solid #8c8b8b;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="invoice">
        <h3 class="center">{{ config('app.name') }}</h3>
        <p class="center">
            Jl. Raya Padaherang km.1, Desa Padaherang <br>
            Kec.Padaherang - Kab.Panagndaran
        </p>
        <hr>
        <p>
            Kode Transaksi : {{ $penjualan->nomor_transaksi }} <br> <!-- Mengubah $penjualan->kode menjadi $penjualan->nomor_transaksi -->
            Tanggal : {{ date('d/m/Y H:i:s', strtotime($penjualan->tanggal)) }} <br>
            Pelanggan : {{ $penjualan->pelanggan ? $penjualan->pelanggan->nama : 'Pelanggan tidak tersedia' }}
        </p>
        <hr>

        <table>
            @foreach ($detilPenjualan as $row)
                <tr>
                    <td>{{ $row->jumlah }} {{ $row->nama_produk }} x {{ number_format($row->harga_produk, 0, ',', '.') }}</td> <!-- Menambahkan number_format pada harga_produk -->
                    <td class="right">{{ number_format($row->subtotal, 0, ',', '.') }}</td> <!-- Menambahkan number_format pada subtotal -->
                </tr>
            @endforeach
        </table>

        <hr>

        <p class="right">
            Sub Total : {{ number_format($penjualan->subtotal, 0, ',', '.') }} <br>
            Pajak PPN(10%) : {{ number_format($penjualan->pajak, 0, ',', '.') }} <br>
            Diskon : {{ number_format($penjualan->diskon, 0, ',', '.') }} <br>
            Total : {{ number_format($penjualan->total, 0, ',', '.') }} <br>
            Kembalian : {{ number_format($penjualan->kembalian, 0, ',', '.') }} <br>
        </p>

        <h3 class="center">Terima Kasih</h3>
    </div>
</body>

</html>
