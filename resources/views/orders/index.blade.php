@extends('layouts.master')
​
@section('title')
    <title>Manajemen Order</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">List Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div> ​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header with-border">
                                <h3 class="card-title">Transaksi</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('order.index') }}" method="get">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Mulai Tanggal</label>
                                                <input type="text" name="start_date" autocomplete="off"
                                                    class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                                                    id="start_date" value="{{ request()->get('start_date') }}">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Sampai Tanggal</label>
                                                <input type="text" name="end_date" autocomplete="off"
                                                    class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                                                    id="end_date" value="{{ request()->get('end_date') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm">Cari</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header with-border">
                                <h3 class="card-title">Data Transaksi</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>{{ $sold }}</h3>
                                                <p>Item Terjual</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="small-box bg-success">
                                            <div class="inner">
                                                <h3>Rp {{ number_format($total) }}</h3>
                                                <p>Total Omset</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- TABLE UNTUK MENAMPILKAN DATA TRANSAKSI -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Invoice</th>
                                                <th>Pelanggan</th>
                                                <th>No. Meja</th>
                                                <th>Total Belanja</th>
                                                <th>Kasir</th>
                                                <th>Tgl Transaksi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- LOOPING MENGGUNAKAN FORELSE, DIRECTIVE DI LARAVEL 5.6 -->
                                            @forelse ($orders as $row)
                                                <tr>
                                                    <td><strong>#{{ $row->invoice }}</strong></td>
                                                    <td>{{ $row->customer }}</td>
                                                    <td>{{ $row->table }}</td>
                                                    <td>Rp {{ number_format($row->total) }}</td>
                                                    <td>{{ $row->user->name }}</td>
                                                    <td>{{ $row->created_at->format('d-m-Y H:i:s') }}</td>
                                                    <td>
                                                        <a href="{{ route('order.pdf', $row->invoice) }}" target="_blank"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                        <a href="{{ route('order.excel', $row->invoice) }}"
                                                            target="_blank" class="btn btn-info btn-sm">
                                                            <i class="fa fa-file-excel-o"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="7">Tidak ada data transaksi</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </section>
    </div>

@endsection

@section('js')
<script>
    $('#start_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    $('#end_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
</script>
@endsection
