@extends('layouts.master')
​
@section('title')
    <title>Manajemen Bahan Baku</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Bahan Baku</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Bahan Baku</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        ​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @if (auth()->user()->role != 'admin')
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header with-border">
                                    <h3 class="card-title">Tambah Bahan Baku</h3>
                                </div>
                                <div class="card-body">
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible">
                                            {!! session('error') !!}
                                        </div>
                                    @endif
                                    ​
                                    <form role="form" action="{{ route('bahan.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Bahan Baku</label>
                                            <input type="text" name="name"
                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                id="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Stok</label>
                                            <input type="number" name="stock" required
                                                class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}">
                                            <p class="text-danger">{{ $errors->first('stock') }}</p>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Kategori</label>
                                            <select name="category" id="category" class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example">
                                            <option selected>Pilih Kategori</option>
                                                <option value="Minuman">Minuman</option>
                                                <option value="Makanan">Makanan</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Keterangan</label>
                                            <input type="text" name="additional" required
                                                class="form-control {{ $errors->has('additional') ? 'is-invalid' : '' }}">
                                            <p class="text-danger">{{ $errors->first('additional') }}</p>
                                        </div>

                                        <div class="card-footer">
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col">
                        <div class="card">
                            <div class="card-header with-border">
                                <h3 class="card-title">List Bahan Baku</h3>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                                        {!! session('success') !!}

                                    </div>
                                @endif
                                ​
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Bahan</td>
                                                <td>Stok</td>
                                                <td>Kategori</td>
                                                <td>Keterangan</td>
                                                @if (auth()->user()->role != 'admin')
                                                <td>Aksi</td>
                                                @endif

                                                {{-- <p>Cari Bahan Baku :</p>

                                                <form action="" method="GET">
                                                    <input type="text" name="cari" placeholder="Cari Bahan .." value="{{ old('cari') }}">
                                                    <input type="submit" value="CARI">
                                                <br>
                                                </form>
                                                <br> --}}

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @forelse ($bahan as $row)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->stock }}</td>
                                                    <td>{{ $row->category }}</td>
                                                    <td>{{ $row->additional }}</td>
                                                <td>
                                                    @if (auth()->user()->role != 'admin')
                                                        <form action="{{ route('bahan.destroy', $row->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ route('bahan.edit', $row->id) }}"
                                                                class="btn btn-warning btn-sm"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <button class="btn btn-danger btn-sm"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="float-right">
                                        {!! $bahan->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
