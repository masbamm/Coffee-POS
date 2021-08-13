@extends('layouts.master')
​
@section('title')
    <title>Edit Bahan Baku</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Bahan Baku</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Bahan Baku</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        ​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header with-border">
                                <h3 class="card-title">Update</h3>
                            </div>
                            <div class="card-body">

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible">
                                        {!! session('error') !!}
                                    </div>
                                @endif
                                ​
                                <form role="form" action="{{ route('bahan.update', $bahan->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Bahan Baku</label>
                                        <input type="text" name="name" value="{{ $bahan->name }}"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Stock</label>
                                        <input type="number" name="stock" required value="{{ $bahan->stock }}"
                                            class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}">
                                        <p class="text-danger">{{ $errors->first('stock') }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Kategori</label>
                                        <select name="category" id="category" class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example">
                                            <option {{ ($bahan->category) == 'Makanan' ? 'selected' : '' }}  value="Makanan">Makanan</option>
                                            <option {{ ($bahan->category) == 'Minuman' ? 'selected' : '' }}  value="Minuman">Minuman</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <input type="text" name="additional" required value="{{ $bahan->additional }}"
                                            class="form-control {{ $errors->has('additional') ? 'is-invalid' : '' }}">
                                        <p class="text-danger">{{ $errors->first('additional') }}</p>
                                    </div>

                                    <div class="card-footer">
                                        <button class="btn btn-info">Update</button>
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
