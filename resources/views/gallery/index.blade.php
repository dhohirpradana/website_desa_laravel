@extends('layouts.app')

@section('title', 'Gallery')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
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
                                <h2 class="mb-0">Gallery</h2>
                                <p class="mb-0 text-sm">Kelola Gallery {{ config('app.name') }}</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('gallery.create') }}" class="btn btn-success" title="Tambah"><i class="fas fa-plus"></i> Tambah Gallery</a>
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
    @forelse ($gallery as $item)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-img">
                    <a href="{{ url(Storage::url($item->gallery)) }}" data-fancybox>
                        <img class="mw-100" src="{{ url(Storage::url($item->gallery)) }}" alt="">
                    </a>
                    <a href="#modal-hapus" data-toggle="modal" data-id="{{ $item->id }}" class="mb-0 btn btn-sm btn-danger hapus" style="position: absolute; top: 0; left: 0; z-index: 1;">
                        <i class="fas fa-trash" title="Hapus" data-toggle="tooltip"></i>
                    </a>
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
                <h6 class="modal-title" id="modal-title-delete">Hapus Surat?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Perhatian!!</h4>
                    <p><strong>Apakah anda yakin ingin menghapus gallery ini ???</strong></p>
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
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.hapus').on('click', function(){
            $('#form-hapus').attr('action', $("meta[name='base-url']").attr('content') + '/gallery/' + $(this).data('id'));
        });
    });
</script>
@endpush
