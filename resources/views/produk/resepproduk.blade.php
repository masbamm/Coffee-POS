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
                        <h1 class="m-0 text-dark">Manajemen Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Produk</li>
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
                                @if (auth()->user()->role != 'admin')
                                <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i> Tambah
                                </a>
                            </div>
                                @endif
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
                                                <th>Bahan Baku</th>
                                                <th>Last Update</th>
                                                @if (auth()->user()->role != 'admin')
                                                <th>Aksi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($products as $row)
                                                <tr>
                                                     
                                                    <td>
                                                        <sup class="label label-success">({{ $row->code }})</sup>
                                                        <strong>{{ ucfirst($row->name) }}</strong>
                                                    </td>
                                                    <td>{{ $row->updated_at }}</td>
                                                    <td>
                                                        @if (auth()->user()->role != 'admin')
                                                        <form action="{{ route('produk.destroy', $row->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ route('produk.edit', $row->id) }}"
                                                                class="btn btn-warning btn-sm">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endif
                                                        </form>
                                                    </td>
                                                    
                                                    
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{-- <div class="float-right">
                                        {!! $products->links() !!}
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
