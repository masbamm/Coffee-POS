@extends('layouts.master')
​
@section('title')
    <title>Manajemen Produk</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Checkout</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('order.transaksi') }}">Transaksi</a></li>
                            <li class="breadcrumb-item active">Checkout</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>​
        <section class="content" id="dw">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header with-border">
                                <h4 class="card-title">Data Pelanggan</h4>
                            </div>
                            <div class="card-body">
                                <div v-if="message" class="alert alert-success">
                                    Transaksi telah disimpan, Invoice: <strong>#@{{ message }}</strong>
                                </div>
                                @if (Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="">Atas Nama</label>
                                    <input type="text" name="name" class="form-control" v-model="customer.name" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor Meja</label>
                                    <input type="text" name="name" class="form-control" v-model="customer.table" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Bayar</label>
                                    <input type="number" name="paid" class="form-control" v-model="customer.paid" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Catatan</label>
                                    <input type="text" name="catatan" class="form-control" v-model="customer.catatan" required>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <!-- JIKA VALUE DARI errorMessage ada, maka alert danger akan ditampilkan -->
                                <div v-if="errorMessage" class="alert alert-danger">
                                    @{{ errorMessage }}
                                </div>
                                <!-- JIKA TOMBOL DITEKAN MAKA AKAN MEMANGGIL METHOD sendOrder -->
                                <button class="btn btn-primary btn-sm float-right" :disabled="submitForm"
                                    @click.prevent="sendOrder">
                                    @{{ submitForm ? 'Loading...' : 'Order Now' }}
                                </button>
                            </div>
                        </div>
                    </div>
                    @include('orders.cart')
                </div>
            </div>
        </section>
    </div>

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
    <script src="{{ asset('js/transaksi.js') }}"></script>
@endsection
