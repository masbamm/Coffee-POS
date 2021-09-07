<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report {{ $report->created_at->format('d-m-Y') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        .page {
            max-width: 80em;
            margin: 0 auto;
        }

        table th,
        table td {
            text-align: left;
        }

        table.layout {
            width: 100%;
            border-collapse: collapse;
        }

        table.display {
            margin: 1em 0;
        }

        table.display th,
        table.display td {
            border: 1px solid #B3BFAA;
            padding: .5em 1em;
        }

        ​ table.display th {
            background: #D5E0CC;
        }

        table.display td {
            background: #fff;
        }

        ​ table.responsive-table {
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
        }

        ​ .listcust {
            margin: 0;
            padding: 0;
            list-style: none;
            display: table;
            border-spacing: 10px;
            border-collapse: separate;
            list-style-type: none;
        }

        ​ .customer {
            padding-left: 600px;
        }

    </style>
</head>

<body>
    <div class="header">
        <h3>Laporan Pembelian Bahan Baku</h3>
        <p><small style="opacity: 0.5;">{{ $report->created_at->format('d-m-Y H:i:s') }}</small></p>
    </div>
    <div class="customer">
        <table class="block">
            <tr>
                <th>Nama Admin</th>
                <td>: {{ auth()->user()->name }}</td>

            </tr>

            <tr>
                <th>Alamat Cafe</th>
                <td>: Jln. Pembangunan no.37, Garut</td>

            </tr>
        </table>
    </div>
    <div class="page">
        <table class="layout display responsive-table">
            <thead>
                <tr>
                    <td>Deskripsi</td>
                    <td>Total Beli Bahan Baku</td>
                    <td>Tanggal</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $report->description }}</td>
                    <td>Rp {{ number_format($report->total) }}</td>
                    <td>{{ $report->created_at->format('d-m-Y') }}</td>
                </tr>
                ​
            </tbody>
        </table>

        <div class="header">
            <h3>Laporan Penjualan</h3>
        </div>
        <table class="layout display responsive-table">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Pelanggan</th>
                    <th>Total Penjualan</th>
                    <th>Kasir</th>
                    <th>Tgl Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- LOOPING MENGGUNAKAN FORELSE, DIRECTIVE DI LARAVEL 5.6 -->
                @forelse ($orders as $row)
                    <tr>
                        <td><strong>#{{ $row->invoice }}</strong></td>
                        <td>{{ $row->customer }}</td>
                        <td>Rp {{ number_format($row->total) }}</td>
                        <td>{{ $row->user->name }}</td>
                        <td>{{ $row->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="7">Tidak ada data transaksi</td>
                    </tr>
                @endforelse

            </tbody>

        </table>

        <div class="header">
            <h3>Akumulasi Laporan</h3>
        </div>
        <table class="layout display responsive-table">
            <tbody>
                <tr>
                    <td colspan="4">Total Pengeluaran</td>
                    <td>Rp {{ number_format($report->total) }}</td>
                </tr>
                <tr>
                    <td colspan="4">Total Pemasukan</td>
                    <td>Rp {{ number_format($total) }}</td>
                </tr>
                <tr>
                    <td colspan="4">Profit</td>
                    <td>Rp {{ number_format($total - $report->total) }}</td>
                </tr>
            </tbody>

        </table>

        <div class="header">
            <h3>Lampiran</h3>
        </div>

        <div>
            <img
                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path("data/$report->image"))) }}">

        </div>

    </div>


</body>

</html>
