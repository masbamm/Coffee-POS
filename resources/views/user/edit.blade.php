@extends('layouts.master')
​
@section('title')
    <title>Tambah Data User</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header with-border">
                                <h3 class="card-title">Edit Data</h3>
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
                                <form action="{{ route('user.update', $user->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="">Nama User</label>
                                        <input type="text" name="name" required value="{{ $user->name }}"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" required value="{{ $user->email }}"
                                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password *(Jika ingin dirubah)</label>
                                        <input type="password" name="password"
                                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><strong>Konfirmasi Password *(Jika ingin dirubah) </strong></label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Role</label>
                                        <select name="role" id="role" required
                                            class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}">
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>Kasir
                                            </option>
                                            <option value="barista" {{ $user->role == 'barista' ? 'selected' : '' }}>
                                                Barista
                                            </option>
                                            <option value="dapur" {{ $user->role == 'dapur' ? 'selected' : '' }}>Dapur
                                            </option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('role') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" id="status" required
                                            class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                            <option value="1" {{ $user->status == '1' ? 'selected' : '' }}>Aktifkan
                                            </option>
                                            <option value="0" {{ $user->status == '0' ? 'selected' : '' }}>Non Aktif
                                            </option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('status') }}</p>
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
