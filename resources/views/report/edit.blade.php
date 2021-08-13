@extends('layouts.master')
​
@section('title')
    <title>Edit Report</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Report</a></li>
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
                                <form role="form" action="{{ route('report.update', [$report->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea name="description" id="description" cols="5" rows="5"
                                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ $report->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="total">Total Pengeluaran</label>
                                        <input type="number" name="total" value="{{ $report->total }}"
                                            class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}"
                                            id="total" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Mulai Tanggal</label>
                                        <input type="text" name="start_date" id="start_date" autocomplete="off"
                                            value="{{ $report->start_date ?? request()->get('start_date') }}"
                                            class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">Akhir Tanggal</label>
                                        <input type="text" name="end_date" id="end_date" autocomplete="off"
                                            value="{{ $report->end_date ?? request()->get('end_date') }}" class="form-control
                                                                                                        class="
                                            form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}">
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary">Simpan</button>
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
