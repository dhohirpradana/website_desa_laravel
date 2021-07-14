@extends('layouts.app')

@section('title', 'Edit Anggaran Pendapatan Belanja Desa')

@section('styles')

@endsection

@section('content-header')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card shadow h-100">
                        <div class="card-header border-0">
                            <div
                                class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                                <div class="mb-3">
                                    <h2 class="mb-0">Edit Anggaran Pendapatan Belanja Kelurahan</h2>
                                    <p class="mb-0 text-sm">Kelola Anggaran Pendapatan Belanja Kelurahan</p>
                                </div>
                                <div class="mb-3">
                                    <a href="{{ route('anggaran-realisasi.index') }}?jenis={{ request('jenis') }}&tahun={{ request('tahun') }}&page={{ request('page') }}"
                                        class="btn btn-success" title="Kembali"><i class="fas fa-arrow-left"></i>
                                        Kembali</a>
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
        <div class="col">
            <div class="card bg-secondary shadow h-100">
                <div class="card-header bg-white border-0">
                    <h3 class="mb-0">Edit Anggaran Pendapatan Belanja Kelurahan</h3>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="{{ route('anggaran-realisasi.update', $anggaran_realisasi) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf @method('patch')
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label class="form-control-label">Tahun</label>
                                <input type="number" onkeypress="return hanyaAngka(event);"
                                    class="form-control @error('tahun') is-invalid @enderror" name="tahun" id="tahun"
                                    placeholder="Masukkan Tahun ..."
                                    value="{{ old('tahun', $anggaran_realisasi->tahun) }}">
                                @error('tahun') <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-5">
                                <label class="form-control-label">Jenis Anggaran</label>
                                <select class="form-control @error('jenis_anggaran') is-invalid @enderror"
                                    name="jenis_anggaran" id="jenis_anggaran">
                                    <option value="" selected disabled>Pilih Jenis Anggaran</option>
                                    @foreach ($jenis_anggaran as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('jenis_anggaran', $anggaran_realisasi->detail_jenis_anggaran->jenis_anggaran_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->id }}. {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_anggaran') <span
                                    class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-5">
                                <label class="form-control-label">Detail Jenis Anggaran</label>
                                <select class="form-control @error('detail_jenis_anggaran_id') is-invalid @enderror"
                                    name="detail_jenis_anggaran_id" id="detail_jenis_anggaran_id">
                                    <option value="" selected disabled>Pilih Detail Jenis Anggaran</option>
                                </select>
                                @error('detail_jenis_anggaran_id') <span
                                    class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Nilai Anggaran</label>
                                <input type="number" onkeypress="return hanyaAngka(event);"
                                    class="form-control @error('nilai_anggaran') is-invalid @enderror" name="nilai_anggaran"
                                    id="nilai_anggaran" placeholder="Masukkan Nilai Anggaran ..."
                                    value="{{ old('nilai_anggaran', $anggaran_realisasi->nilai_anggaran) }}">
                                @error('nilai_anggaran') <span
                                    class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Nilai Realisasi</label>
                                <input type="number" onkeypress="return hanyaAngka(event);"
                                    class="form-control @error('nilai_realisasi') is-invalid @enderror"
                                    name="nilai_realisasi" id="nilai_realisasi" placeholder="Masukkan Nilai Realisasi ..."
                                    value="{{ old('nilai_realisasi', $anggaran_realisasi->nilai_realisasi) }}">
                                @error('nilai_realisasi') <span
                                    class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-12">
                                <label class="form-control-label">Keterangan Lainnya</label>
                                <textarea class="form-control @error('keterangan_lainnya') is-invalid @enderror"
                                    name="keterangan_lainnya" id="keterangan_lainnya"
                                    placeholder="Masukkan Keterangan Lainnya ...">{{ old('keterangan_lainnya', $anggaran_realisasi->keterangan_lainnya) }}</textarea>
                                @error('keterangan_lainnya') <span
                                    class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" id="simpan">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.getJSON(
                "{{ route('detail-jenis-anggaran.show', $anggaran_realisasi->detail_jenis_anggaran->jenis_anggaran_id) }}",
                function(response) {
                    $("#detail_jenis_anggaran_id").html(
                        `<option value="" selected disabled>Pilih Detail Jenis Anggaran</option>`);
                    $.each(response, function(key, item) {
                        if (!item.nama) {
                            $.getJSON(baseURL + "/kelompok-jenis-anggaran/" + item
                                .kelompok_jenis_anggaran_id, res => {
                                    $("#detail_jenis_anggaran_id").append(
                                        `<option value="${item.id}">${res.nama}</option>`);
                                });
                        } else {
                            let id = item.id;
                            id = id.toString();
                            let kode_rincian_split = id.split('');
                            let kode = '';
                            kode_rincian_split.forEach(element => {
                                kode += element + ".";
                            });
                            $("#detail_jenis_anggaran_id").append(
                                `<option value="${item.id}">${kode} ${item.nama}</option>`);
                        }
                        $("#detail_jenis_anggaran_id").val(
                            "{{ $anggaran_realisasi->detail_jenis_anggaran_id }}");
                    });
                });

            $('#jenis_anggaran').change(function() {
                $("#detail_jenis_anggaran_id").html(
                    `<option value="" selected disabled>Loading ...</option>`);
                $.getJSON(baseURL + "/detail-jenis-anggaran/" + $(this).val(), function(response) {
                    $("#detail_jenis_anggaran_id").html(
                        `<option value="" selected disabled>Pilih Detail Jenis Anggaran</option>`
                    );
                    $.each(response, function(key, item) {
                        if (!item.nama) {
                            $.getJSON(baseURL + "/kelompok-jenis-anggaran/" + item
                                .kelompok_jenis_anggaran_id, res => {
                                    $("#detail_jenis_anggaran_id").append(
                                        `<option value="${item.id}">${res.nama}</option>`
                                    );
                                });
                        } else {
                            let id = item.id;
                            id = id.toString();
                            let kode_rincian_split = id.split('');
                            let kode = '';
                            kode_rincian_split.forEach(element => {
                                kode += element + ".";
                            });
                            $("#detail_jenis_anggaran_id").append(
                                `<option value="${item.id}">${kode} ${item.nama}</option>`
                            );
                        }
                    });
                });
            });
        });
    </script>
@endpush
