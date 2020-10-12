@extends('layouts.app')

@section('title', 'Anggaran Pendapatan Belanja Desa')

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
                                <h2 class="mb-0">Anggaran Pendapatan Belanja Desa</h2>
                                <p class="mb-0 text-sm">Kelola Anggaran Pendapatan Belanja Desa</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('anggaran-realisasi.create') }}?jenis={{ request('jenis') }}&tahun={{ request('tahun') }}&page={{ request('page') }}" class="btn btn-success" title="Tambah"><i class="fas fa-plus"></i> Tambah APBDes</a>
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
<div class="card shadow">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left mb-3">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item m-1">
                        <a class="nav-link {{ request('jenis') == 'pendapatan' ? 'active' : '' }}" href="{{ URL::current() }}?jenis=pendapatan&tahun={{ request('tahun') }}"><i class="fas fa-hand-holding-usd mr-2"></i>PENDAPATAN</a>
                    </li>
                    <li class="nav-item m-1">
                        <a class="nav-link {{ request('jenis') == 'belanja' ? 'active' : '' }}" href="{{ URL::current() }}?jenis=belanja&tahun={{ request('tahun') }}"><i class="fas fa-shopping-cart mr-2"></i>BELANJA</a>
                    </li>
                    <li class="nav-item m-1">
                        <a class="nav-link {{ request('jenis') == 'pembiayaan' ? 'active' : '' }}" href="{{ URL::current() }}?jenis=pembiayaan&tahun={{ request('tahun') }}"><i class="fas fa-money-check-alt mr-2"></i>PEMBIAYAAN</a>
                    </li>
                </ul>
            </div>
            <form id="form-tahun" action="{{ URL::current()}}" method="GET">
                <input type="hidden" name="jenis" value="{{ request('jenis') ? request('jenis') : "pendapatan"}}">
                Tahun: <input type="number" name="tahun" id="tahun" class="form-control-sm" value="{{ request('tahun') ? request('tahun') : date('Y') }}" style="width: 80px">
                <img id="loading-tahun" src="{{ asset(Storage::url('loading.gif')) }}" alt="Loading" height="20px" style="display: none">
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <th width="100px">#</th>
                    <th>Rincian</th>
                    <th>Anggaran</th>
                    <th>Realisasi</th>
                    <th>Ditambahkan pada</th>
                    <th>Diperbarui pada</th>
                </thead>
                <tbody>
                    @forelse ($anggaran_realisasi as $item)
                        <tr>
                            <td>
                                <a href="{{ route('anggaran-realisasi.edit', $item) }}?jenis={{ request('jenis') }}&tahun={{ request('tahun') }}&page={{ request('page') }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-sm btn-danger hapus-data" data-nama="{{ $item->detail_jenis_anggaran->nama ? $item->detail_jenis_anggaran->nama : $item->detail_jenis_anggaran->kelompok_jenis_anggaran->nama }}" data-action="{{ route("anggaran-realisasi.destroy", $item) }}" data-toggle="modal" href="#modal-hapus"><i data-toggle="tooltip" title="Hapus" class="fas fa-trash"></i></a>
                            </td>
                            <td>{{ $item->detail_jenis_anggaran->nama ? $item->detail_jenis_anggaran->nama : $item->detail_jenis_anggaran->kelompok_jenis_anggaran->nama }} {{ $item->keterangan_lainnya ? "(" . $item->keterangan_lainnya . ")" : "" }}</td>
                            <td>Rp. {{ substr(number_format($item->nilai_anggaran, 2, ',', '.'),0,-3) }}</td>
                            <td>Rp. {{ substr(number_format($item->nilai_realisasi, 2, ',', '.'),0,-3) }}</td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($item->updated_at)) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" align="center">Data tidak tersedia</td>
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

@push('scripts')
<script>
    $(document).ready(function () {
        $("#tahun").change(function () {
            $("#tahun").css('display','none');
            $("#loading-tahun").css('display','');
            $("tbody").html(`<tr><td colspan="6" align="center"><img id="loading-tahun" src="{{ asset(Storage::url('loading.gif')) }}" alt="Loading" height="20px" style="display: none"></td></tr>`);
            $(this).parent().submit();
        });
    });
</script>
@endpush
