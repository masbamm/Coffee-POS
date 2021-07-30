@extends('layouts.master')
​
@section('title')
    <title>Dashboard</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        ​
        <!-- Main content -->
        <section class="content" id="dw">
            <div class="container-fluid">

                <!-- ABAIKAN DULU LINE INI KARENA AKAN DI MODIFIKASI SELANJUTNYA -->
                @if (auth()->user()->role == 'admin')
                    <div class="row"> ​
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $order }}</h3>
                                    <p>Total Pesanan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>Rp {{ number_format($penjualan) }}</h3>
                                    <p>Total Penjualan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>Rp {{ number_format($pengeluaran) }}</h3>
                                    <p>Total Pengeluaran</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>Rp {{ number_format($profit) }}</h3>
                                    <p>Total Profit</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- SAMPAI LINE INI -->

                    <!-- YANG PERLU DIPERHATIKAN ADALAH LINE DIBAWAH -->
                    <div class="row">
                        <!-- CHART.JS MEMINTA ELEMENT YANG MEMILIKI ID dw-chart -->
                        <canvas id="dw-chart"></canvas>
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $product }}</h3>
                                    <p>Produk</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>

                            </div>
                        </div>
                        ​
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $order }}</h3>
                                    <p>Pesanan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- SAMPAI LINE INI -->
                @endif
            </div>
        </section>
    </div>
@endsection
​
@section('js')
    <!-- LOAD FILE dashboard.js -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
