@extends('layouts.app')

@section('title', 'Edit Dusun')

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Edit Dusun</h2>
                                <p class="mb-0 text-sm">Kelola Dusun</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route("dusun.index") }}" class="btn btn-success" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
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
    <div class="col-md-5 mb-3">
        <div class="card bg-secondary shadow">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('dusun.update', $dusun) }}" method="post">
                    @csrf @method('patch')
                    <div class="form-group">
                        <label class="form-control-label" for="nama">Nama Dusun</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Masukkan Nama Dusun ..." value="{{ old('nama', $dusun->nama) }}">
                        @error('nama')<span class="invalid-feedback font-weight-bold">{{ $message }}</span>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="simpan">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7 mb-3">
        <div class="card bg-secondary shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h2 class="mb-0">Detail Dusun</h2>
                    <a href="#modal-tambah-detail-dusun" data-toggle="modal" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <th width="20px">#</th>
                            <th>RW</th>
                            <th>RT</th>
                            <th>Opsi</th>
                        </thead>
                        <tbody>
                            @forelse ($dusun->detailDusun as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->rw }}</td>
                                    <td>{{ $item->rt }}</td>
                                    <td>
                                        <a href="#modal-edit-detail-dusun" class="btn btn-sm btn-success edit" data-get="{{ route('detailDusun.show', $item) }}" data-action="{{ route('detailDusun.update', $item) }}" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger hapus-data" data-nama="RT/RW {{ $item->rt }}/{{ $item->rw }}" data-action="{{ route("detailDusun.destroy", $item) }}" data-toggle="tooltip" title="Hapus" href="#modal-hapus"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" align="center">Data tidak tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-delete">Hapus Detail Dusun?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Perhatian!!</h4>
                    <p>Menghapus dusun akan menghapus semua data yang dimilikinya</p>
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

<div class="modal fade" id="modal-edit-detail-dusun" tabindex="-1" role="dialog" aria-labelledby="modal-edit-detail-dusun" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title">Edit Detail Dusun</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form form-edit" data-redirect="{{ route('dusun.edit',$dusun) }}" action="" method="POST">
                    @csrf @method('patch')
                    <input type="hidden" name="dusun_id" value="{{ $dusun->id }}">
                    <div class="form-group">
                        <label class="form-control-label">RW</label>
                        <input type="text" class="form-control" id="rw" name="rw" placeholder="Masukkan RW ...">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">RT</label>
                        <input type="text" class="form-control" id="rt" name="rt" placeholder="Masukkan RT ...">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tambah-detail-dusun" tabindex="-1" role="dialog" aria-labelledby="modal-tambah-detail-dusun" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title">Tambah Detail Dusun</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form" data-redirect="{{ route('dusun.edit',$dusun) }}" action="{{ route("detailDusun.store") }}" method="POST">
                    @csrf
                    <input type="hidden" name="dusun_id" value="{{ $dusun->id }}">
                    <div class="form-group">
                        <label class="form-control-label">RW</label>
                        <input type="text" class="form-control" name="rw" placeholder="Masukkan RW ...">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">RT</label>
                        <input type="text" class="form-control" name="rt" placeholder="Masukkan RT ...">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).on('click', '.edit', function (event) {
        event.preventDefault();
        const btn = this;
        $(".form-edit").attr('action', $(this).data('action'));
        $.ajax({
            url: $(this).data('get'),
            method: 'get',
            beforeSend: function (){
                $(btn).attr('disabled','disabled');
                $(btn).html(`<img height="20px" src="${baseURL}/storage/loading.gif" alt="">`);
            },
            success: function (response) {
                $(btn).html('<i class="fas fa-edit"></i>');
                $(btn).removeAttr('disabled');
                $("#modal-edit-detail-dusun").modal('show');
                $("#rw").val(response.rw);
                $("#rt").val(response.rt);
            }
        });
    });

    $(document).on('submit', '.form', function(event) {
        event.preventDefault();
        const form = this;
        const url = $(this).attr('action');
        const redirect = $(this).data('redirect');
        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData(form),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(result){
                $(form).find("button:submit").html('Simpan');
                $(form).find("button:submit").removeAttr('disabled');
                if (result.success) {
                    alertSuccess(result.message);
                    setTimeout(() => {
                        $(".notifikasi").html('');
                    }, 3000);
                    if (redirect) {
                        location.href = redirect;
                    }
                }
            },
            error: function (response) {
                console.clear();
                $(form).find('button:submit').html('Simpan');
                $(form).find('button:submit').removeAttr('disabled');
                alertError();
                let focus = true;
                $.each(response.responseJSON.errors, function (i, e) {
                    $('#pesanError').append(`<li>`+e+`</li>`);
                    if (!$(form).find("[name='" + i + "']").hasClass('is-invalid')) {
                        $(form).find("[name='" + i + "']").addClass('is-invalid');
                        if (focus) {
                            $("[name='" + i + "']").focus();
                            focus = false;
                        }
                    }
                });
            }
        });
    });
</script>
@endpush
