@extends('layouts.app')

@section('title', 'Tambah Surat')

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
                                <h2 class="mb-0">Tambah Surat</h2>
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
                <h3 class="mb-0">Tambah Surat</h3>
            </div>
            <div class="card-body">
                <form id="form" autocomplete="off" action="javascript:;" method="post">
                    @csrf
                    <input type="hidden" class="form-control form-control-alternative" name="isian[]" value="isian">
                    <input type="hidden" name="jenis_isi[]" value="0">
                    <input type="hidden" name="tampilkan[]" value="0">
                    <h6 class="heading-small text-muted">Detail Surat</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Nama Surat</label>
                                    <input class="form-control form-control-alternative" name="nama">
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
                            <textarea class="form-control form-control-alternative" name="deskripsi"></textarea>
                        </div>
                    </div>
                    <h6 class="heading-small text-muted mt-4">Isian</h6>
                    <div class="pl-lg-4" id="isian"></div>
                    <h6 class="heading-small text-muted">Alat</h6>
                    <div class="pl-lg-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="tampilkan_surat" name="tampilkan_surat" value="1">
                            <label class="custom-control-label" for="tampilkan_surat">Tampilkan surat ini untuk warga yang ingin mencetak surat keterangan ini</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="perihal" name="perihal" value="1">
                            <label class="custom-control-label" for="perihal">Perihal</label> <a href="{{ url('img/bantuan-perihal.png') }}" data-fancybox data-caption="Akan menampilkan surat seperti ini"><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="data_kades" name="data_kades" value="1">
                            <label class="custom-control-label" for="data_kades">Data Kades</label> <a href="{{ url('img/bantuan-data-kades.png') }}" data-fancybox data-caption="Akan menampilkan data kepala desa"><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="tanda_tangan_bersangkutan" name="tanda_tangan_bersangkutan" value="1">
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
    let urutan = 1;
    $(document).ready(function(){
        $(".ikon").val("fa-file-text-o");

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
                                    <input type="hidden" name="tampilkan[]" value="0">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Lampiran</label>
                                    <input class="form-control form-control-alternative" name="isian[]">
                                    <input type="hidden" name="jenis_isi[]" value="4">
                                    <input type="hidden" name="tampilkan[]" value="0">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Perihal</label>
                                    <input class="form-control form-control-alternative" name="isian[]">
                                    <input type="hidden" name="jenis_isi[]" value="4">
                                    <input type="hidden" name="tampilkan[]" value="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Kepada</label>
                                    <input class="form-control form-control-alternative" name="isian[]">
                                    <input type="hidden" name="jenis_isi[]" value="4">
                                    <input type="hidden" name="tampilkan[]" value="0">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Di</label>
                                    <input class="form-control form-control-alternative" name="isian[]">
                                    <input type="hidden" name="jenis_isi[]" value="4">
                                    <input type="hidden" name="tampilkan[]" value="0">
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
                        <div class="input-group-append">
    				        <button type="button" class="btn btn-outline-danger hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
    				        <button type="button" class="btn btn-outline-success atas" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
    				        <button type="button" class="btn btn-outline-success bawah" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                        </div>
                    </div>
                    <input type="hidden" name="jenis_isi[]" value="1">
                </div>
            `);
            $('[data-toggle="tooltip"]').tooltip();
            urutan++;
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
                        <div class="input-group-append">
    				        <button type="button" class="btn btn-outline-danger hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
                            <button type="button" class="btn btn-outline-success atas" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
    				        <button type="button" class="btn btn-outline-success bawah" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                        </div>
                    </div>
                    <input type="hidden" name="jenis_isi[]" value="2">
                </div>
            `);
            $('[data-toggle="tooltip"]').tooltip();
            urutan++;
        });

        $("#isi").click(function(){
            $("#isian").append(`
                <div class="form-group urutan-${urutan}" data-urutan="${urutan}">
                    <label class="form-control-label">Isian</label>
                    <div class="input-group input-group-alternative mb-3">
                        <input type="text" class="form-control" name="isian[]">
                        <div class="input-group-append">
    				        <button type="button" class="btn btn-outline-danger hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
                            <button type="button" class="btn btn-outline-success atas" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
    				        <button type="button" class="btn btn-outline-success bawah" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                        </div>
                    </div>
                    <input type="hidden" name="jenis_isi[]" value="3">
                    <input type="hidden" name="tampilkan[]" value="0">
                </div>
            `);
            $('[data-toggle="tooltip"]').tooltip();
            urutan++;
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
                        <div class="input-group-append">
    				        <button type="button" class="btn btn-outline-danger hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
                            <button type="button" class="btn btn-outline-success atas" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
    				        <button type="button" class="btn btn-outline-success bawah" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                        </div>
                    </div>
                    <input type="hidden" name="jenis_isi[]" value="5">
                </div>
            `);
            $('[data-toggle="tooltip"]').tooltip();
            urutan++;
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

        $(document).on("click", ".hapus", function () {
            $(this).tooltip('dispose');
            $(this).parent('div').parent('div').parent('div').remove();
        });

        $(document).on("click", "input[type='checkbox']", function () {
            $(this).tooltip('hide');
        });

        $('#form').on('submit',function(){
            const form = new FormData(this);
            $.ajax({
                url: "{{ route('surat.store') }}",
                type: 'POST',
                data: form,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(data){
                    $("#simpan").attr('disabled','disabled');
                    $("#simpan").html(`<img height="20px" src="{{ url('/storage/loading.gif') }}" alt=""> Loading ...`);
                },
                success: function(data){
                    $("#simpan").html('SIMPAN');
                    $("#simpan").removeAttr('disabled');
                    if (data.success) {
                        location.href = "{{ route('surat.index') }}";
                    } else {
                        $(".notifikasi").html(`
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
                        $.each(data.message, function (i, e) {
                            $('#pesanError').append(`<li>`+e+`</li>`);
                        });
                        setTimeout(() => {
                            $(".notifikasi").html('');
                        }, 10000);
                    }
                }
            });
        });
    });
</script>
@endpush
