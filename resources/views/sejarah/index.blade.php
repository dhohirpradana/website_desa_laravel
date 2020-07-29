@extends('layouts.app')

@section('title', 'Sejarah')

@section('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
    .ikon {
        font-family: fontAwesome;
    }
    .animate-up:hover {
        top: -5px;
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
                                <h2 class="mb-0">Sejarah</h2>
                                <p class="mb-0 text-sm">Kelola Sejarah</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('sejarah.create') }}" class="btn btn-success" title="Tambah"><i class="fas fa-plus"></i> Tambah Sejarah</a>
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
    @forelse ($sejarah as $item)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card animate-up">
                @if ($item->gambar)
                    <a href="{{ route('sejarah.show', ['sejarah' => $item, 'slug' => Str::slug($item->judul)]) }}">
                        <div class="card-img" style="background-image: url('{{ url(Storage::url($item->gambar)) }}'); background-size: cover; height: 200px;">
                        </div>
                    </a>
                @endif
                <div class="card-body text-center">
                    <a href="{{ route('sejarah.show', ['sejarah' => $item, 'slug' => Str::slug($item->judul)]) }}">
                        <h3>{{ $item->judul }}</h3>
                        <p class="text-sm text-muted"><i class="fas fa-clock-o"></i> {{ $item->created_at->diffForHumans() }}</p>
                    </a>
                    <a href="{{ route('sejarah.edit', $item) }}" class="btn btn-sm btn-success" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                    <a class="btn btn-sm btn-danger hapus" data-nama="{{ $item->judul }}" data-id="{{ $item->id }}" data-toggle="modal" href="#modal-hapus" title="Hapus"><i class="fas fa-trash"></i> Hapus</a>
                </div>
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
                <h6 class="modal-title" id="modal-title-delete">Hapus Pengguna?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Perhatian!!</h4>
                    <p>Menghapus sejarah akan menghapus semua data yang dimilikinya</p>
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
            $('#form-hapus').attr('action', $("meta[name='base-url']").attr('content') + '/sejarah/' + $(this).data('id'));
        });
    });
</script>
@endpush
