@extends('layouts.master')
​
@section('title')
    <title>Manajemen Laporan</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Laporan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Laporan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        ​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header with-border">
                                <h3 class="card-title">Tambah</h3>
                            </div>
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible">
                                        {!! session('error') !!}
                                    </div>
                                @endif
                                ​
                                <form role="form" action="{{ url('report') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea name="description" id="description" cols="5" rows="5"
                                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="total">Total Pengeluaran</label>
                                        <input type="number" name="total"
                                            class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}"
                                            id="total" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">image</label>
                                        <input class="form-control" type="file" name="image[]" accept="image/*" multiple>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Mulai Tanggal</label>
                                        <input type="text" name="start_date" id="start_date" autocomplete="off"
                                            value="{{ request()->get('start_date') }}"
                                            class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">Akhir Tanggal</label>
                                        <input type="text" name="end_date" id="end_date" autocomplete="off"
                                            value="{{ request()->get('end_date') }}"
                                            class="form-control
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
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header with-border">
                                <h3 class="card-title">List Laporan</h3>
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
                                <div class="table-responsive-sm">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Deskripsi</td>
                                                <td>Total Pengeluaran</td>
                                                <td>Tanggal</td>
                                                <td>Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @forelse ($report as $row)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td style="word-wrap: break-word;min-width: 250px;max-width: 160px;">
                                                        {{ $row->description }}</td>
                                                    <td>{{ $row->total }}</td>
                                                    <td>{{ $row->created_at->format('d-m-Y') }}</td>
                                                    <td>



                                </div>
                                <form action="{{ route('report.destroy', $row->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('report.pdf', $row->id) }}" target="_blank"
                                        class="btn btn-primary btn-sm">
                                        <i class="fa fa-print"></i>
                                    </a>

                                    <a href="{{ route('report.edit', $row->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fa fa-edit"></i></a>
                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                                </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                                </tbody>
                                </table>
                            </div>
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
