@extends('layouts.app')

@section('title', 'Edit Surat')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
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
                                <h2 class="mb-0">Edit Surat</h2>
                                <p class="mb-0 text-sm">Kelola Surat {{ config('app.name') }}</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ URL::previous() }}" class="btn btn-success" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
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
<div class="row fixed-top m-3">
    <div class="col-lg-6"></div>
    <div class="col-lg-6">
        <div class="notifikasi"></div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card bg-secondary shadow h-100">
            <div class="card-header bg-white border-0">
                <h3 class="mb-0">Edit Surat</h3>
            </div>
            <div class="card-body">
                <form id="form" autocomplete="off" action="javascript:;" method="post">
                    @csrf @method('patch')
                    <input type="hidden" class="form-control form-control-alternative" name="isian[]" value="isian">
                    <input type="hidden" name="jenis_isi[]" value="2">
                    <input type="hidden" name="tampilkan[]" value="0">
                    <h6 class="heading-small text-muted">Detail Surat</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Nama Surat</label>
                                    <input class="form-control form-control-alternative" name="nama" value="{{ $surat->nama }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Icon</label>
                                    @include('layouts.components.icon')
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Deskripsi</label>
                            <textarea class="form-control form-control-alternative" name="deskripsi">{{ $surat->deskripsi }}</textarea>
                        </div>
                    </div>
                    <h6 class="heading-small text-muted">Isian</h6>
                    <div class="pl-lg-4" id="isian">
                        @if ($surat->perihal == 1)
                            @php
                                $perihal = array();
                                foreach ($surat->isiSurat->where('jenis_isi',4) as $isiSurat) {
                                    array_push($perihal, $isiSurat->isi);
                                }
                            @endphp
                            <div id="isian_perihal">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Sifat</label>
                                            <input class="form-control form-control-alternative" name="isian[]" value="{{ $perihal[0] }}">
                                            <input type="hidden" name="jenis_isi[]" value="4">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Lampiran</label>
                                            <input class="form-control form-control-alternative" name="isian[]" value="{{ $perihal[1] }}">
                                            <input type="hidden" name="jenis_isi[]" value="4">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Perihal</label>
                                            <input class="form-control form-control-alternative" name="isian[]" value="{{ $perihal[2] }}">
                                            <input type="hidden" name="jenis_isi[]" value="4">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Kepada</label>
                                            <input class="form-control form-control-alternative" name="isian[]" value="{{ $perihal[3] }}">
                                            <input type="hidden" name="jenis_isi[]" value="4">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Di</label>
                                            <input class="form-control form-control-alternative" name="isian[]" value="{{ $perihal[4] }}">
                                            <input type="hidden" name="jenis_isi[]" value="4">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @foreach ($surat->isiSurat as $key => $isiSurat)
                            @if ($isiSurat->jenis_isi == 1)
                                <div class="form-group urutan-{{ $key+1 }}" data-urutan="{{ $key+1 }}">
                                    <label class="form-control-label">Paragraf</label> <a href="{{ url('img/bantuan-paragraf.png') }}" data-fancybox><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" name="tampil[]" value="1" data-toggle="tooltip" title="Centang untuk menampilkan paragraf ini pada form buat surat" @if($isiSurat->tampilkan == 1) checked @endif>
                                                <input type="hidden" name="tampilkan[]" value="{{ $isiSurat->tampilkan }}">
                                            </div>
                                        </div>
                                        <textarea class="form-control" name="isian[]">{{ $isiSurat->isi }}</textarea>
                                        <input type="hidden" name="id" value="{{ $isiSurat->id }}">
                                        <input type="hidden" name="jenis_isi[]" value="1">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-danger hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
                                            <button type="button" class="btn btn-outline-success atas" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
    				                        <button type="button" class="btn btn-outline-success bawah" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($isiSurat->jenis_isi == 2)
                                <div class="form-group urutan-{{ $key+1 }}" data-urutan="{{ $key+1 }}">
                                    <label class="form-control-label">Kalimat</label> <a href="{{ url('img/bantuan-kalimat.png') }}" data-fancybox><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" name="tampil[]" value="1" data-toggle="tooltip" title="Centang untuk menampilkan kalimat ini pada form buat surat" @if($isiSurat->tampilkan == 1) checked @endif>
                                                <input type="hidden" name="tampilkan[]" value="{{ $isiSurat->tampilkan }}">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="isian[]" value="{{ $isiSurat->isi }}">
                                        <input type="hidden" name="id" value="{{ $isiSurat->id }}">
                                        <input type="hidden" name="jenis_isi[]" value="2">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-danger hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
                                            <button type="button" class="btn btn-outline-success atas" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
    				                        <button type="button" class="btn btn-outline-success bawah" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($isiSurat->jenis_isi == 3)
                                <div class="form-group urutan-{{ $key+1 }}" data-urutan="{{ $key+1 }}">
                                    <label class="form-control-label">Isian</label>
                                    <div class="input-group input-group-alternative mb-3">
                                        <input type="text" class="form-control" name="isian[]" value="{{ $isiSurat->isi }}">
                                        <input type="hidden" name="id" value="{{ $isiSurat->id }}">
                                        <input type="hidden" name="jenis_isi[]" value="3">
                                        <input type="hidden" name="tampilkan[]" value="{{ $isiSurat->tampilkan }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-danger hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
                                            <button type="button" class="btn btn-outline-success atas" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
    				                        <button type="button" class="btn btn-outline-success bawah" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($isiSurat->jenis_isi == 5)
                                <div class="form-group urutan-{{ $key+1 }}" data-urutan="{{ $key+1 }}">
                                    <label class="form-control-label">Sub Judul</label> <a href="{{ url('img/bantuan-kalimat.png') }}" data-fancybox><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" name="tampil[]" value="1" data-toggle="tooltip" title="Centang untuk menampilkan kalimat ini pada form buat surat" @if($isiSurat->tampilkan == 1) checked @endif>
                                                <input type="hidden" name="tampilkan[]" value="{{ $isiSurat->tampilkan }}">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="isian[]" value="{{ $isiSurat->isi }}">
                                        <input type="hidden" name="id" value="{{ $isiSurat->id }}">
                                        <input type="hidden" name="jenis_isi[]" value="5">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-danger hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
                                            <button type="button" class="btn btn-outline-success atas" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
    				                        <button type="button" class="btn btn-outline-success bawah" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <h6 class="heading-small text-muted">Alat</h6>
                    <div class="pl-lg-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="tampilkan_surat" name="tampilkan_surat" value="1" {{ $surat->tampilkan == 1 ? 'checked':'' }}>
                            <label class="custom-control-label" for="tampilkan_surat">Tampilkan surat ini untuk warga yang ingin mencetak surat keterangan ini</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="perihal" name="perihal" value="1" {{ $surat->perihal == 1 ? 'checked':'' }}>
                            <label class="custom-control-label" for="perihal">Perihal</label> <a href="{{ url('img/bantuan-perihal.png') }}" data-fancybox data-caption="Akan menampilkan surat seperti ini"><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="data_kades" name="data_kades" value="1" {{ $surat->data_kades == 1 ? 'checked':'' }}>
                            <label class="custom-control-label" for="data_kades">Data Kades</label> <a href="{{ url('img/bantuan-data-kades.png') }}" data-fancybox data-caption="Akan menampilkan data kepala desa"><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="tanda_tangan_bersangkutan" name="tanda_tangan_bersangkutan" value="1" {{ $surat->tanda_tangan_bersangkutan == 1 ? 'checked':'' }}>
                            <label class="custom-control-label" for="tanda_tangan_bersangkutan">Tanda tangan bersangkutan</label> <a href="{{ url('img/bantuan-tanda-tangan-bersangkutan.png') }}" data-fancybox data-caption="Akan menampilkan tanda tangan yang bersangkutan"><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                        </div>
                        <button type="button" id="paragraf" class="btn btn-sm btn-slack mt-2">Paragraf</button>
                        <button type="button" id="kalimat" class="btn btn-sm btn-slack mt-2">Kalimat</button>
                        <button type="button" id="isi" class="btn btn-sm btn-slack mt-2">Isian</button>
                        <button type="button" id="sub-judul" class="btn btn-sm btn-slack mt-2">Sub Judul</button>
                        <a href="{{ url('img/bantuan-paragraf-kalimat-isian.png') }}" data-fancybox><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary btn-block" id="simpan">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script>
    let urutan = "{{ count($surat->isiSurat) }}";
    urutan = parseInt(urutan);

    $(document).ready(function(){
        $(".ikon").val("{{ $surat->icon }}");

        $("#perihal").change(function(){
            if ($(this).prop('checked') == true) {
                $("#isian").prepend(`
                    <div id="isian_perihal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Sifat</label>
                                    <input class="form-control form-control-alternative" name="isian[]">
                                    <input type="hidden" name="jenis_isi[]" value="4">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Lampiran</label>
                                    <input class="form-control form-control-alternative" name="isian[]">
                                    <input type="hidden" name="jenis_isi[]" value="4">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Perihal</label>
                                    <input class="form-control form-control-alternative" name="isian[]">
                                    <input type="hidden" name="jenis_isi[]" value="4">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Kepada</label>
                                    <input class="form-control form-control-alternative" name="isian[]">
                                    <input type="hidden" name="jenis_isi[]" value="4">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Di</label>
                                    <input class="form-control form-control-alternative" name="isian[]">
                                    <input type="hidden" name="jenis_isi[]" value="4">
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            } else {
                $("#isian_perihal").remove();
            }
        });

        $("#paragraf").click(function(){
            $("#isian").append(`
                <div class="form-group urutan-${urutan}" data-urutan="${urutan}">
                    <label class="form-control-label">Paragraf</label> <a href="{{ url('img/bantuan-paragraf.png') }}" data-fancybox><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                    <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" name="tampil[]" value="1" data-toggle="tooltip" title="Centang untuk menampilkan paragraf ini pada form buat surat">
                                <input type="hidden" name="tampilkan[]" value="0">
                            </div>
                        </div>
                        <textarea class="form-control" name="isian[]"></textarea>
                        <input type="hidden" name="surat_id" value="{{ $surat->id }}">
                        <input type="hidden" name="jenis_isi[]" value="1">
                        <div class="input-group-append">
    				        <button type="button" class="btn btn-outline-danger hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
    				        <button type="button" class="btn btn-outline-success atas" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
    				        <button type="button" class="btn btn-outline-success bawah" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                        </div>
                    </div>
                </div>
            `);
            $('[data-toggle="tooltip"]').tooltip();
        });

        $("#kalimat").click(function(){
            $("#isian").append(`
                <div class="form-group urutan-${urutan}" data-urutan="${urutan}">
                    <label class="form-control-label">Kalimat</label> <a href="{{ url('img/bantuan-kalimat.png') }}" data-fancybox><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                    <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" name="tampil[]" value="1" data-toggle="tooltip" title="Centang untuk menampilkan kalimat ini pada form buat surat">
                                <input type="hidden" name="tampilkan[]" value="0">
                            </div>
                        </div>
                        <input type="text" class="form-control" name="isian[]">
                        <input type="hidden" name="surat_id" value="{{ $surat->id }}">
                        <input type="hidden" name="jenis_isi[]" value="2">
                        <div class="input-group-append">
    				        <button type="button" class="btn btn-outline-danger hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
    				        <button type="button" class="btn btn-outline-success atas" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
    				        <button type="button" class="btn btn-outline-success bawah" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                        </div>
                    </div>
                </div>
            `);
            $('[data-toggle="tooltip"]').tooltip();
        });

        $("#isi").click(function(){
            $("#isian").append(`
                <div class="form-group urutan-${urutan}" data-urutan="${urutan}">
                    <label class="form-control-label">Isian</label>
                    <div class="input-group input-group-alternative mb-3">
                        <input type="text" class="form-control" name="isian[]">
                        <input type="hidden" name="surat_id" value="{{ $surat->id }}">
                        <input type="hidden" name="jenis_isi[]" value="3">
                        <div class="input-group-append">
    				        <button type="button" class="btn btn-outline-danger hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
    				        <button type="button" class="btn btn-outline-success atas" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
    				        <button type="button" class="btn btn-outline-success bawah" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                        </div>
                    </div>
                </div>
            `);
            $('[data-toggle="tooltip"]').tooltip();
        });

        $("#sub-judul").click(function(){
            $("#isian").append(`
                <div class="form-group urutan-${urutan}" data-urutan="${urutan}">
                    <label class="form-control-label">Sub Judul</label> <a href="{{ url('img/bantuan-kalimat.png') }}" data-fancybox><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                    <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" name="tampil[]" value="1" data-toggle="tooltip" title="Centang untuk menampilkan kalimat ini pada form buat surat">
                                <input type="hidden" name="tampilkan[]" value="0">
                            </div>
                        </div>
                        <input type="text" class="form-control" name="isian[]">
                        <input type="hidden" name="surat_id" value="{{ $surat->id }}">
                        <input type="hidden" name="jenis_isi[]" value="5">
                        <div class="input-group-append">
    				        <button type="button" class="btn btn-outline-danger hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
    				        <button type="button" class="btn btn-outline-success atas" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
    				        <button type="button" class="btn btn-outline-success bawah" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                        </div>
                    </div>
                </div>
            `);
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).on("click", ".atas", function () {
            $(this).tooltip('hide');
            const urutan = $(this).parent('div').parent('div').parent('div').data('urutan') - 1;
            const before = $(this).parent('div').parent('div').parent('div').siblings('.urutan-' + urutan);
            const current = $(this).parent('div').parent('div').parent('div');
            const dataBefore = $(before).html();
            const dataCurrent = $(current).html();
            $(current).html(dataBefore);
            $(before).html(dataCurrent);
        });

        $(document).on("click", ".bawah", function () {
            $(this).tooltip('hide');
            const urutan = $(this).parent('div').parent('div').parent('div').data('urutan') + 1;
            const after = $(this).parent('div').parent('div').parent('div').siblings('.urutan-' + urutan);
            const current = $(this).parent('div').parent('div').parent('div');
            const dataAfter = $(after).html();
            const dataCurrent = $(current).html();
            $(current).html(dataAfter);
            $(after).html(dataCurrent);
        });

        $(document).on("change","input:checkbox", function (event) {
            $(this).attr('checked', $(this).prop('checked'));
            if ($(this).prop('checked')){
                $(this).siblings('input[name="tampilkan[]"]').attr('value','1');
            } else {
                $(this).siblings('input[name="tampilkan[]"]').attr('value','0');
            }
        });

        $(document).on("change","input", function (event) {
            $(this).attr('value', this.value);
        });

        $(document).on("change","textarea", function (event) {
            $(this).html(event.target.value);
        });

        $('#form').on('submit',function(){
            $.ajax({
                url: "{{ route('surat.update', $surat) }}",
                type: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(data){
                    $("#simpan").attr('disabled','disabled');
                    $("#simpan").html(`<img height="20px" src="{{ url('/storage/loading.gif') }}" alt=""> Loading ...`);
                },
                success: function(result){
                    $("#simpan").html('SIMPAN');
                    $("#simpan").removeAttr('disabled');
                    if (result.success) {
                        alertSuccess("Surat berhasil diperbarui");
                        setTimeout(() => {
                            $(".notifikasi").html('');
                        }, 3000);
                    } else {
                        alertError();
                        $.each(result.message, function (i, e) {
                            $('#pesanError').append(`<li>`+e+`</li>`);
                        });
                        setTimeout(() => {
                            $(".notifikasi").html('');
                        }, 10000);
                    }
                }
            });
        });

        $(document).on("click", ".hapus", function () {
            $(this).tooltip('dispose');
            $(this).parent('div').parent('div').parent('div').remove();
        });

        $(document).on("click", "input[type='checkbox']", function () {
            $(this).tooltip('hide');
        });
    });

    function alertSuccess (pesan) {
        $('.notifikasi').html(`
            <div class="alert alert-success alert-dismissible fade show">
                <span class="alert-icon"><i class="fas fa-check-circle"></i> <strong>Berhasil</strong></span>
                <span class="alert-text">
                    ${pesan}
                </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `);
    }

    function alertError () {
        $('.notifikasi').html(`
            <div class="alert alert-danger alert-dismissible fade show">
                <span class="alert-icon"><i class="fas fa-times-circle"></i> <strong>Gagal</strong></span>
                <span class="alert-text">
                    <ul id="pesanError">
                    </ul>
                </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `);
    }
</script>
@endpush
