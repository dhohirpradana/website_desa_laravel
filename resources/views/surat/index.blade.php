@extends('layouts.app')

@section('title', 'Surat')

@section('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
    .ikon {
        font-family: fontAwesome;
    }
</style>
@endsection

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Surat</h2>
                                <p class="mb-0 text-sm">Kelola Surat {{ config('app.name') }}</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('surat.create') }}" class="btn btn-success" title="Tambah"><i class="fas fa-plus"></i> Tambah Surat</a>
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
<div class="row mt-4 justify-content-center">
    @forelse ($surat as $item)
        <div class="col-lg-4 col-md-6">
            <div class="single-service bg-white rounded shadow">
                <a href="{{ route('buat-surat', ['id' => $item->id,'slug' => Str::slug($item->nama)]) }}">
                    <i class="fas {{ $item->icon }} ikon fa-5x mb-3"></i>
                    <h4>{{ $item->nama }}</h4>
                </a>
                <p>{{ $item->deskripsi }}</p>
                @if ($item->jumlah_cetak > 0)
                    <p class="text-sm text-muted">Telah dicetak sebanyak {{ $item->jumlah_cetak }}x</p>
                @endif
                @if ($item->tampilkan == 0)
                    <p class="font-weight-bold">(Belum ditampilkan)</p>
                @endif
                <a href="{{ route('surat.edit', $item) }}" class="btn btn-sm btn-success" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                <a class="btn btn-sm btn-danger hapus" data-nama="{{ $item->nama }}" data-id="{{ $item->id }}" data-toggle="modal" href="#modal-hapus" title="Hapus"><i class="fas fa-trash"></i> Hapus</a>
            </div>
        </div>
    @empty
        <div class="col">
            <div class="single-service bg-white rounded shadow">
                <h4>Data belum tersedia</h4>
            </div>
        </div>
    @endforelse
</div>

<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-delete">Hapus Surat?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Perhatian!!</h4>
                    <p>Menghapus surat akan menghapus semua data yang dimilikinya</p>
                    <p><strong id="nama-hapus"></strong></p>
                </div>

            </div>

            <div class="modal-footer">
                <form id="form-hapus" action="" method="POST" >
                    @csrf @method('delete')
                    <button type="submit" class="btn btn-white">Yakin</button>
                </form>
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Tidak</button>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('.hapus').on('click', function(){
            $('#nama-hapus').html('Apakah Anda yakin ingin menghapus ' + $(this).data('nama') + '???');
            $('#form-hapus').attr('action', $("meta[name='base-url']").attr('content') + '/surat/' + $(this).data('id'));
        });
    });
</script>
@endpush
