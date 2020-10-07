@extends('layouts.app')

@section('title', 'Anggaran dan Realisasi APBDes')

@section('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@endsection

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Anggaran dan Realisasi APBDes</h2>
                                <p class="mb-0 text-sm">Kelola Anggaran dan Realisasi APBDes</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('anggaran-realisasi.create') }}" class="btn btn-success" title="Tambah"><i class="fas fa-plus"></i> Tambah Anggaran Realisasi</a>
                            </div>
                        </div>
                        <form class="navbar-search mt-3 cari-none" action="{{ URL::current() }}" method="GET">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Cari ...." type="text" name="cari" value="{{ request('cari') }}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('form-search')
<form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" action="{{ URL::current() }}" method="GET">
    <div class="form-group mb-0">
        <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input class="form-control" placeholder="Cari ...." type="text" name="cari" value="{{ request('cari') }}">
        </div>
    </div>
</form>
@endsection

@section('content')
@include('layouts.components.alert')
<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <th width="100px">#</th>
                    <th>Tahun</th>
                    <th>Jenis Anggaran</th>
                    <th>Kode Rincian</th>
                    <th>Anggaran</th>
                    <th>Realisasi</th>
                </thead>
                <tbody>
                    @forelse ($anggaran_realisasi as $item)
                        @php
                            $kode_detail_anggaran_split = str_split($item->detail_jenis_anggaran_id);
                            $kode_detail_anggaran = '';
                            foreach ($kode_detail_anggaran_split as $value) {
                                $kode_detail_anggaran .= $value . ".";
                            }
                        @endphp
                        <tr>
                            <td>
                                <a href="{{ route('anggaran-realisasi.edit', $item) }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-sm btn-danger hapus-data" data-nama="{{ $item->detail_jenis_anggaran->nama ? $item->detail_jenis_anggaran->nama : $item->detail_jenis_anggaran->kelompok_jenis_anggaran->nama }}" data-action="{{ route("anggaran-realisasi.destroy", $item) }}" data-toggle="modal" href="#modal-hapus"><i data-toggle="tooltip" title="Hapus" class="fas fa-trash"></i></a>
                            </td>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->detail_jenis_anggaran->jenis_anggaran_id }}. {{ $item->detail_jenis_anggaran->jenis_anggaran->nama }}</td>
                            <td>{{ $kode_detail_anggaran }} {{ $item->detail_jenis_anggaran->nama ? $item->detail_jenis_anggaran->nama : $item->detail_jenis_anggaran->kelompok_jenis_anggaran->nama }}</td>
                            <td>Rp. {{ substr(number_format($item->nilai_anggaran, 2, ',', '.'),0,-3) }}</td>
                            <td>Rp. {{ substr(number_format($item->nilai_realisasi, 2, ',', '.'),0,-3) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" align="center">Data tidak tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $anggaran_realisasi->links() }}
    </div>
</div>

<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-delete">Hapus Anggaran Realisasi?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Perhatian!!</h4>
                    <p>Menghapus anggaran realisasi akan menghapus semua data yang dimilikinya</p>
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
