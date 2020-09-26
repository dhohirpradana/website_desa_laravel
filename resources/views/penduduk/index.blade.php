@extends('layouts.app')

@section('title', 'Penduduk')

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
                                <h2 class="mb-0">Penduduk</h2>
                                <p class="mb-0 text-sm">Kelola Penduduk</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('penduduk.create') }}" class="btn btn-success" title="Tambah"><i class="fas fa-plus"></i> Tambah Penduduk</a>
                            </div>
                        </div>
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
            <table class="table table-hover table-bordered">
                <thead>
                    <th>#</th>
                    <th>NIK</th>
                    <th>KK</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>TTL</th>
                    <th>Golongan Darah</th>
                    <th>Agama</th>
                    <th>Pendidikan</th>
                    <th>Pekerjaan</th>
                    <th>Status Perkawinan</th>
                    <th>Status Hub. dalam Keluarga</th>
                    <th>Kewarganegaraan</th>
                    <th>Nama Ayah</th>
                    <th>Nama Ibu</th>
                </thead>
                <tbody>
                    @forelse ($penduduk as $item)
                        <tr>
                            <td>
                                <a href="{{ route('penduduk.edit', $item) }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-sm btn-danger hapus-data" data-nama="{{ $item->nama }}" data-action="{{ route("penduduk.destroy", $item) }}" data-toggle="modal" href="#modal-hapus"><i data-toggle="tooltip" title="Hapus" class="fas fa-trash"></i></a>
                            </td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->kk }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jenis_kelamin == 1 ? "Laki-laki" : "Perempuan" }}</td>
                            <td>{{ $item->tempat_lahir }}, {{ date('d/m/Y',strtotime($item->tanggal_lahir)) }}</td>
                            <td>{{ $item->darah ? $item->darah->golongan : '-' }}</td>
                            <td>{{ $item->agama->nama }}</td>
                            <td>{{ $item->pendidikan ? $item->pendidikan->nama : '-' }}</td>
                            <td>{{ $item->pekerjaan ? $item->pekerjaan->nama : '-' }}</td>
                            <td>{{ $item->statusPerkawinan->nama }}</td>
                            <td>{{ $item->statusHubunganDalamKeluarga->nama }}</td>
                            <td>
                                @php
                                    switch ($item->kewarganegaraan) {
                                        case 1:
                                            echo "WNI";
                                            break;
                                        case 2:
                                            echo "WNA";
                                            break;
                                        case 3:
                                            echo "Dua Kewarganegaraan";
                                            break;
                                    }
                                @endphp
                            </td>
                            <td>{{ $item->nama_ayah }}</td>
                            <td>{{ $item->nama_ibu }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" align="center">Data tidak tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $penduduk->links() }}
    </div>
</div>

<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-delete">Hapus Penduduk?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Perhatian!!</h4>
                    <p>Menghapus penduduk akan menghapus semua data yang dimilikinya</p>
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
