<div class="row fixed-top m-3" style="z-index: 99999999999999999">
    <div class="col-lg-6"></div>
    <div class="col-lg-6">
        <div class="notifikasi"></div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-check-circle"></i> <strong>Berhasil</strong></span>
                <span class="alert-text">
                    {{ session('success') }}
                </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-times-circle"></i> <strong>Gagal</strong></span>
                <span class="alert-text">
                    {{ session('error') }}
                </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('api_error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-times-circle"></i> <strong>Gagal</strong></span>
                <span class="alert-text">
                    {!! session('api_error') !!}
                </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <span class="alert-icon"><i class="fas fa-times-circle"></i> <strong>Gagal</strong></span>
                <span class="alert-text">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
</div>
