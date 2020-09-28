@extends('layouts.app')

@section('title', 'Tambah Dusun')

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Tambah Dusun</h2>
                                <p class="mb-0 text-sm">Kelola Dusun</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route("dusun.index") }}" class="btn btn-success" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
@include('layouts.components.alert')
<div class="row">
    <div class="col-md-5">
        <div class="card bg-secondary shadow h-100">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('dusun.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label" for="nama">Nama Dusun</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Masukkan Nama Dusun ..." value="{{ old('nama') }}">
                        @error('nama')<span class="invalid-feedback font-weight-bold">{{ $message }}</span>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="simpan">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
