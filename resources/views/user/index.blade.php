@extends('layouts.master')
​
@section('title')
    <title>Manajemen User</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
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
                                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i> Tambah
                                </a>
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
                                                <th>#</th>
                                                <th>Nama User</th>
                                                <th>Status</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            @forelse ($users as $row)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>
                                                        {{ $row->name }}
                                                    </td>
                                                    <td>{!! $row->status_label !!}</td>
                                                    <td>{{ $row->email }}</td>
                                                    <td>{{ $row->role }}</td>
                                                    <td>
                                                        <form action="{{ route('user.destroy', $row->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ route('user.edit', $row->id) }}"
                                                                class="btn btn-warning btn-sm">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
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
                                    <div class="float-right">
                                        {!! $users->links() !!}
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
