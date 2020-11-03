<div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
        aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand -->
    <a class="text-center pt-0" href="{{ route('home.index') }}">
        <h1 class="text-primary font-weight-900 text-uppercase">Desa {{ $desa->nama_desa }}</h1>
    </a>
    <!-- User -->
    <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                        <img alt="{{ asset(Storage::url(auth()->user()->foto_profil)) }}" src="{{ asset(Storage::url(auth()->user()->foto_profil)) }}">
                    </span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                <a href="{{ route('profil') }}"  class="dropdown-item">
                    <i class="ni ni-single-02"></i>
                    <span>Profil Saya</span>
                </a>
                <a href="{{ route('pengaturan') }}"  class="dropdown-item">
                    <i class="ni ni-settings-gear-65"></i>
                    <span>Pengaturan</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('keluar') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ni ni-user-run"></i>
                    <span>Keluar</span>
                </a>
            </div>
        </li>
    </ul>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
            <div class="row">
                <div class="col-6 collapse-brand">
                    <a href="{{ route('home.index') }}">
                        <h1 class="text-primary"><b>Desa {{ $desa->nama_desa }}</b></h1>
                    </a>
                </div>
                <div class="col-6 collapse-close">
                    <button type="button" class="navbar-toggler" data-toggle="collapse"
                        data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                        aria-label="Toggle sidenav">
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Form -->
        @yield('form-search-mobile')
        <!-- Navigation -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt text-blue"></i>
                    <span class="nav-link-inner--text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home.index') }}">
                    <i class="fas fa-home text-cyan"></i>
                    <span class="nav-link-inner--text">Beranda</span>
                </a>
            </li>
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(1) == 'penduduk' || Request::segment(1) == 'tambah-penduduk') active @endif" href="{{ route('penduduk.index') }}">
                    <i class="fas fa-users text-info"></i>
                    <span class="nav-link-inner--text">Kelola Penduduk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(1) == 'dusun' || Request::segment(1) == 'tambah-dusun') active @endif" href="{{ route('dusun.index') }}">
                    <i class="fas fa-map-marker-alt text-yellow"></i>
                    <span class="nav-link-inner--text">Kelola Dusun</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(1) == 'anggaran-realisasi' || Request::segment(1) == 'tambah-anggaran-realisasi') active @endif" href="{{ url('anggaran-realisasi?jenis=pendapatan&tahun='.date('Y')) }}">
                    <i class="fas fa-coins text-success"></i>
                    <span class="nav-link-inner--text">Kelola APBDes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(1) == 'surat' || Request::segment(1) == 'tambah-surat') active @endif" href="{{ route('surat.index') }}">
                    <i class="ni ni-single-copy-04 text-primary"></i>
                    <span class="nav-link-inner--text">Kelola Surat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(1) == 'kelola-pemerintahan-desa' || Request::segment(1) == 'tambah-pemerintahan-desa' || Request::segment(1) == 'pemerintahan-desa') active @endif" href="{{ route('pemerintahan-desa.index') }}">
                    <i class="fas fa-atlas text-success"></i>
                    <span class="nav-link-inner--text">Kelola Informasi Pemerintahan Desa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(1) == 'kelola-berita' || Request::segment(1) == 'tambah-berita' || Request::segment(1) == 'berita') active @endif" href="{{ route('berita.index') }}">
                    <i class="fas fa-newspaper text-cyan"></i>
                    <span class="nav-link-inner--text">Kelola Berita</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(1) == 'gallery') active @endif" href="{{ route('gallery.index') }}">
                    <i class="fas fa-images text-orange"></i>
                    <span class="nav-link-inner--text">Kelola Gallery</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(1) == 'slider') active @endif" href="{{ route('slider.index') }}">
                    <i class="fas fa-images text-purple"></i>
                    <span class="nav-link-inner--text">Kelola Slider</span>
                </a>
            </li>
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(1) == 'profil-desa') active @endif" href="{{ route('profil-desa') }}">
                    <i class="fas fa-users text-info"></i>
                    <span class="nav-link-inner--text">Profil Desa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(1) == 'profil' || Request::segment(1) == 'pengaturan') active @endif" href="{{ route('profil') }}">
                    <i class="ni ni-single-02 text-yellow"></i>
                    <span class="nav-link-inner--text">Profil Saya</span>
                </a>
            </li>
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('keluar') }}" onclick="event.preventDefault(); document.getElementById('form-keluar').submit();">
                    <i class="ni ni-user-run"></i>
                    <span class="nav-link-inner--text">Keluar</span>
                </a>
            </li>
        </ul>
    </div>
</div>
