$(document).on("click", ".atas", function () {
    $(this).tooltip('hide');
    const before = $(this).parent('div').parent('div').parent('div').prev();
    const current = $(this).parent('div').parent('div').parent('div');
    const dataBefore = $(before).html();
    const dataCurrent = $(current).html();
    $(current).html(dataBefore);
    $(before).html(dataCurrent);
});

$(document).on("click", ".bawah", function () {
    $(this).tooltip('hide');
    const after = $(this).parent('div').parent('div').parent('div').next();
    const current = $(this).parent('div').parent('div').parent('div');
    const dataAfter = $(after).html();
    const dataCurrent = $(current).html();
    $(current).html(dataAfter);
    $(after).html(dataCurrent);
});

$(document).on("change","input:checkbox", function (event) {
    if ($(this).prop('checked')){
        $(this).siblings('input[name="tampilkan[]"]').attr('value','1');
    } else {
        $(this).siblings('input[name="tampilkan[]"]').attr('value','0');
    }
});

$(document).on("click", ".hapus", function () {
    $(this).tooltip('dispose');
    $(this).parent('div').parent('div').parent('div').remove();
});

document.addEventListener("keyup", function(event) {
    if (event.ctrlKey && event.altKey && event.which == 80) {
        $("#paragraf").click();
    }

    if (event.ctrlKey && event.altKey && event.which == 75) {
        $("#kalimat").click();
    }

    if (event.ctrlKey && event.altKey && event.which == 73) {
        $("#isi").click();
    }

    if (event.ctrlKey && event.altKey && event.which == 74) {
        $("#sub-judul").click();
    }
});

$('form').on('submit', function(event) {
    event.preventDefault();
    const url = $(this).attr('action');
    const redirect = $(this).data('redirect');
    $.ajax({
        url: url,
        type: 'POST',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function(data){
            $("#simpan").attr('disabled','disabled');
            $("#simpan").html(`<img height="20px" src="${baseURL}/storage/loading.gif" alt=""> Loading ...`);
        },
        success: function(result){
            $("#simpan").html('SIMPAN');
            $("#simpan").removeAttr('disabled');
            if (result.success) {
                alertSuccess(result.message);
                setTimeout(() => {
                    $(".notifikasi").html('');
                }, 3000);
                if (redirect) {
                    location.href = redirect;
                }
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
    $(this).tooltip('hide');
    let foc = $("#isian").append(`
        <div class="form-group">
            <label class="form-control-label">Paragraf</label> <a href="{{ url('img/bantuan-paragraf.png') }}" data-fancybox><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="checkbox" name="tampil[]" value="1" data-toggle="tooltip" title="Centang untuk menampilkan paragraf ini pada form buat surat">
                        <input type="hidden" name="tampilkan[]" value="0">
                    </div>
                </div>
                <textarea class="form-control" name="isian[]"></textarea>
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
    $("#isian").find('.form-control').focus();
});

$("#kalimat").click(function(){
    $(this).tooltip('hide');
    $("#isian").append(`
        <div class="form-group">
            <label class="form-control-label">Kalimat</label> <a href="{{ url('img/bantuan-kalimat.png') }}" data-fancybox><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="checkbox" name="tampil[]" value="1" data-toggle="tooltip" title="Centang untuk menampilkan kalimat ini pada form buat surat">
                        <input type="hidden" name="tampilkan[]" value="0">
                    </div>
                </div>
                <input type="text" class="form-control" name="isian[]">
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
    $("#isian").find('.form-control').focus();
});

$("#isi").click(function(){
    $(this).tooltip('hide');
    $("#isian").append(`
        <div class="form-group">
            <label class="form-control-label">Isian</label>
            <div class="input-group input-group-alternative mb-3">
                <input type="text" class="form-control" name="isian[]">
                <input type="hidden" name="jenis_isi[]" value="3">
                <input type="hidden" name="tampilkan[]" value="0">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-danger hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
                    <button type="button" class="btn btn-outline-success atas" data-toggle="tooltip" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
                    <button type="button" class="btn btn-outline-success bawah" data-toggle="tooltip" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                </div>
            </div>
        </div>
    `);
    $('[data-toggle="tooltip"]').tooltip();
    $("#isian").find('.form-control').focus();
});

$("#sub-judul").click(function(){
    $(this).tooltip('hide');
    $("#isian").append(`
        <div class="form-group">
            <label class="form-control-label">Sub Judul</label> <a href="{{ url('img/bantuan-subjudul.png') }}" data-fancybox><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="checkbox" name="tampil[]" value="1" data-toggle="tooltip" title="Centang untuk menampilkan kalimat ini pada form buat surat">
                        <input type="hidden" name="tampilkan[]" value="0">
                    </div>
                </div>
                <input type="text" class="form-control" name="isian[]">
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
    $("#isian").find('.form-control').focus();
});
