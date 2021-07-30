@extends('layouts.master')
​
@section('title')
    <title>Edit Kategori</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
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
                                <form role="form" action="{{ route('kategori.update', $categories->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Kategori</label>
                                        <input type="text" name="name" value="{{ $categories->name }}"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea name="description" id="description" cols="5" rows="5"
                                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ $categories->description }}</textarea>
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
