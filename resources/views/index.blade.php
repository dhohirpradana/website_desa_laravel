@extends('layouts.layout')
@section('title', 'Beranda')

@section('header')
<h2 class="text-white text-sm text-muted">SELAMAT DATANG DI LAYANAN ONLINE</h2>
<h2 class="text-lead text-white">DESA ARJASA<br/>KABUPATEN JEMBER</h2>
@endsection

@section('content')
<section id="services">
    <div class="row">
        <div class="col-md">
            <div class="header-body text-center mt-5 mb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 border-bottom">
                        <h2 class="text-white">LAYANAN</h2>
                        <p class="text-white">Dengan menggunakan Aplikasi SIP, masyarakat dapat dengan mudah mengajukan beberapa layanan berikut ini secara online.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 text-center">
        <div class="col-lg-4 col-md-6">
            <div class="single-service bg-white rounded">
                <a href="https://sipdispendukcapiljember.id/syarat/akta_lahir">
                    <i class="fa fa-baby"></i>
                    <h4>Permohonan Akta Lahir</h4>
                </a>
                <p>Klik disini untuk melihat persyaratan</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="single-service bg-white rounded">
                <a href="https://sipdispendukcapiljember.id/syarat/akta_kematian">
                    <i class="fa fa-ambulance"></i>
                    <h4>Permohonan Akta Kematian</h4>
                </a>
                <p>Klik disini untuk melihat persyaratan</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="single-service bg-white rounded">
                <a href="https://sipdispendukcapiljember.id/syarat/ktp_baru">
                    <i class="fa fa-id-card"></i>
                    <h4>Pengajuan Cetak KTP</h4>
                </a>
                <p>Klik disini untuk melihat persyaratan</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="single-service bg-white rounded">
                <a href="https://sipdispendukcapiljember.id/syarat/ktp_hilang_rusak">
                    <i class="fa fa-id-card"></i>
                    <h4>Permohonan KTP Hilang atau Rusak</h4>
                </a>
                <p>Klik disini untuk melihat persyaratan</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="single-service bg-white rounded">
                <a href="https://sipdispendukcapiljember.id/syarat/suket">
                    <i class="fa fa-file-invoice"></i>
                    <h4>Permohonan Surat Keterangan Perekaman KTP (SUKET)</h4>
                </a>
                <p>Klik disini untuk melihat persyaratan</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="single-service bg-white rounded">
                <a href="https://sipdispendukcapiljember.id/syarat/kia">
                    <i class="fa fa-child"></i>
                    <h4>Permohonan Kartu Identitas Anak (KIA)</h4>
                </a>
                <p>Klik disini untuk melihat persyaratan</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="single-service bg-white rounded">
                <a href="https://sipdispendukcapiljember.id/syarat/kk_baru">
                    <i class="fa fa-address-card"></i>
                    <h4>Permohonan Kartu Keluarga (KK) Baru</h4>
                </a>
                <p>Klik disini untuk melihat persyaratan</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="single-service bg-white rounded">
                <a href="https://sipdispendukcapiljember.id/syarat/kk_hilang_rusak">
                    <i class="fa fa-address-card"></i>
                    <h4>Permohonan Kartu Keluarga (KK) Hilang atau Rusak</h4>
                </a>
                <p>Klik disini untuk melihat persyaratan</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="single-service bg-white rounded">
                <a href="https://sipdispendukcapiljember.id/syarat/pindah_datang">
                    <i class="fa fa-walking"></i>
                    <h4>Permohonan Pelaporan Pindah Datang</h4>
                </a>
                <p>Klik disini untuk melihat persyaratan</p>
            </div>
        </div>
    </div>
</section>
@endsection
