@extends('layouts.master')
​
@section('title')
    <title>Tambah Data Produk</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tambah Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        ​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header with-border">
                                <h3 class="card-title">Tambah</h3>
                            </div>
                            <div class="card-body">

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-check"></i> Error!</h5>
                                        {!! session('error') !!}

                                    </div>
                                @endif
                                <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="">Kode Produk</label>
                                        <input type="text" name="code" required maxlength="10"
                                            class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}">
                                        <p class="text-danger">{{ $errors->first('code') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Produk</label>
                                        <input type="text" name="name" required
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Deskripsi</label>
                                        <textarea name="description" id="description" cols="5" rows="5"
                                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"></textarea>
                                        <p class="text-danger">{{ $errors->first('description') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Harga</label>
                                        <input type="number" name="price" required
                                            class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}">
                                        <p class="text-danger">{{ $errors->first('price') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kategori</label>
                                        <select name="category_id" id="category_id" required
                                            class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}">
                                            <option value="">Pilih</option>
                                            @foreach ($categories as $row)
                                                <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" id="status" required
                                            class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                            <option value="1">Aktifkan</option>
                                            <option value="0">Non Aktif</option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('status') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Foto</label>
                                        <input type="file" name="photo" class="form-control">
                                        <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-send"></i> Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
