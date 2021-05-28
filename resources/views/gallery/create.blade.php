@extends('layouts.app')
@section('title', 'Tambah Slider')

@section('styles')
<link rel="stylesheet" href="{{ url('/css/dropzone.css') }}">
<link rel="stylesheet" href="{{ url('/css/custom.css') }}">
@endsection

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Tambah Slider</h2>
                                <p class="mb-0 text-sm"> {{ config('app.name') }}</p>
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
<div class="row">
    <div class="col">
        <div class="card bg-secondary shadow h-100">
            <div class="card-header bg-white border-0">
                <h3 class="mb-0">Tambah Slider</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('gallery.store') }}" enctype="multipart/form-data"
                    class="dropzone mt-3" id="my-dropzone">
                    @csrf
                    <div class="dz-message">
                        <div class="col-xs-8">
                            <div class="message">
                                <p>Seret gambar kesini atau klik untuk mengunggah</p>
                            </div>
                        </div>
                    </div>
                    <div class="fallback">
                        <input type="file" name="file" multiple>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Dropzone Preview Template --}}
<div id="preview" style="display: none;">

    <div class="dz-preview dz-file-preview">
        <div class="dz-image"><img data-dz-thumbnail /></div>

        <div class="dz-details">
            <div class="dz-size"><span data-dz-size></span></div>
            <div class="dz-filename"><span data-dz-name></span></div>
        </div>
        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
        <div class="dz-error-message"><span data-dz-errormessage></span></div>

        <div class="dz-success-mark">

            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                <title>Check</title>
                <desc>Created with Sketch.</desc>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                    <path
                        d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                        id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475"
                        fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                </g>
            </svg>

        </div>
        <div class="dz-error-mark">

            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                <title>error</title>
                <desc>Created with Sketch.</desc>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                    <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158"
                        fill="#FFFFFF" fill-opacity="0.816519475">
                        <path
                            d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                            id="Oval-2" sketch:type="MSShapeGroup"></path>
                    </g>
                </g>
            </svg>
        </div>
    </div>
</div>
{{-- End of Dropzone Preview Template --}}
@endsection

@push('scripts')
<script src="{{ url('/js/dropzone.js') }}"></script>
<script>
    var total_photos_counter = 0;
    var name = "";
    Dropzone.options.myDropzone = {
        uploadMultiple: true,
        parallelUploads: 2,
        maxFilesize: 2,
        previewTemplate: document.querySelector('#preview').innerHTML,
        addRemoveLinks: true,
        dictRemoveFile: 'Hapus gambar',
        dictFileTooBig: 'Maximum ukuran gambar adalah 2 mb',
        timeout: 10000,
        acceptedFiles: "image/*",
        renameFile: function (file) {
            name = new Date().getTime() + Math.floor((Math.random() * 100) + 1) + '_' + file.name;
            return name;
        },

        init: function () {
            this.on("removedfile", function (file) {
                $.post({
                    url: "{{ route('gallery.store') }}",
                    data: {id: file.customName, _token: $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    success: function (data) {
                        total_photos_counter--;
                        $("#counter").text("# " + total_photos_counter);
                    }
                });
            });
        },
        success: function (file, done) {
            total_photos_counter++;
            $("#counter").text("# " + total_photos_counter);
            file["customName"] = name;
        }
    };

</script>
@endpush
