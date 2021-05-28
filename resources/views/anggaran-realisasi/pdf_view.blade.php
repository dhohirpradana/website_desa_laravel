<head>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
</head>
<style>
    @page {
        margin: 0px;
    }

    body {
        margin: 0px;
        margin-top: 15px;
        margin-bottom: 15px
    }

    h3 {
        text-align: center;
    }

</style>
<?php
$nama = [
'Hasil Usaha Desa',
'Hasil Aset Desa',
'Swadaya, Partisipasi dan
Gotong Royong',
'Lain-Lain Pendapatan Asli Desa',
'Dana Desa',
'Bagi Hasil Pajak dan Retribusi',
'Alokasi Dana Desa',
'Bantuan Keuangan Provinsi',
'Bantuan Keuangan Kabupaten/Kota',
'Penerimaan dari Hasil Kerjasama Antar Desa',
'Penerimaan dari Hasil Kerjasama dengan Pihak Ketiga',
'Penerimaan Bantuan dari Perusahaan yang Berlokasi di Desa',
'Hibah dan Sumbangan dari Pihak Ketiga',
'Koreksi Kesalahan Belanja Tahun-tahun Sebelumnya',
'Bunga Bank',
'Lain-lain Pendapatan Desa Yang Sah',
// Belanja
'Penyelenggaraan Pemerintahan desa',
'Pelaksanaan Pembangunan Desa',
'Pembinaan kemasyarakatan',
'Pemberdayaan Masyarakat',
'Penanggulangan Bencana, Darurat dan Mendesak Desa',
// Pembiayaan
'SILPA Tahun Sebelumnya',
'Pencairan Dana Cadangan',
'Hasil Penjualan Kekayaan Desa Yang Dipisahkan',
'Penerimaan Pembiayaan Lainnya',
'Pembentukan Dana Cadangan',
'Penyertaan Modal Desa',
'Pengeluaran Pembiayaan Lainnya',
];
$suma1 = 0;
$suma2 = 0;
$suma3 = 0;
$sumt1 = 0;
$sumt2 = 0;
$sumt3 = 0;
$suml1 = 0;
$suml2 = 0;
$suml3 = 0;
$sumb1 = 0;
$sumb2 = 0;
$sumb3 = 0;
// Pembiayaan
$sa = 0;
$sb = 0;
$sc = 0;
$na = 0;
$nb = 0;
$nc = 0;
?>
<div class="container">
    <div class="d-flex p-2 justify-content-center"">
        <h3>Realisasi APBDesa Tahun Anggaran {{ $tahun }}</h3>
    </div>
    <div class=" row">
        <table class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Uraian</th>
                    <th scope="col">Anggaran (Rp)</th>
                    <th scope="col">Realisasi (Rp)</th>
                    <th scope="col">Selisih (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" style="font-size: 14"><b>1. PENDAPATAN</b></td>
                </tr>
                <tr>
                    <td><b>1.1 Pendapatan Asli Desa</b></td>

                    @foreach ($pendapatan_asli_total ?? '' as $a)
                        <td><b>{{ number_format($a->total) }}</b></td>
                    @endforeach
                    @foreach ($realisasi_asli_total ?? '' as $b)
                        <td><b>{{ number_format($b->total) }}</b></td>
                    @endforeach</td>
                    <td><b>{{ number_format(abs($a->total - $b->total)) }}</b></td>

                    <?php
                    $suma2 = $b->total;
                    $suma1 = $a->total;
                    $suma3 = $a->total - $b->total;
                    ?>
                </tr>
                {{-- Asli --}}
                @for ($i = 1; $i < 5; $i++)
                    {{-- Asli Desa Val --}}
                    @foreach (${'a' . $i} ?? '' as $p) <tr>
                    <td>1.1.{{ $i }} {{ $nama[$i - 1] }}</td>
                    <td>{{ number_format($p->total_anggaran) }}</td>
                    <td>{{ number_format($p->total_realisasi) }}</td>
                    <td>{{ number_format(abs($p->total_anggaran - $p->total_realisasi)) }}</td>
                    {{-- <td>{{ round(($p->total_realisasi / $p->total_anggaran) * 100, 2) }}</td> --}}
                    </tr> @endforeach
                @endfor
                {{-- Transfer --}}
                <tr>
                    <td><b>1.2. Pendapatan Transfer</b></td>

                    @foreach ($pendapatan_transfer_total ?? '' as $a)
                        <td><b>{{ number_format($a->total) }}</b></td>
                        <?php $sumt1 = $a->total; ?>
                    @endforeach
                    @foreach ($realisasi_transfer_total ?? '' as $b)
                        <td><b>{{ number_format($b->total) }}</b></td>
                    @endforeach</td>
                    <td><b>{{ number_format(abs($a->total - $b->total)) }}</b></td>
                    {{-- <td><b>{{ round(($b->total / $a->total) * 100, 2) }}</b></td> --}}
                    <?php
                    $sumt2 = $b->total;
                    $sumt1 = $a->total;
                    $sumt3 = $a->total - $b->total;
                    ?>
                </tr>
                {{-- Transfer --}}
                @for ($i = 1; $i < 6; $i++)
                    {{-- Asli Desa Val --}}
                    @foreach (${'b' . $i} ?? '' as $p) <tr>
                    <td>1.2.{{ $i }} {{ $nama[$i + 3] }}</td>
                    <td>{{ number_format($p->total_anggaran) }}</td>
                    <td>{{ number_format($p->total_realisasi) }}</td>
                    <td>{{ number_format(abs($p->total_anggaran - $p->total_realisasi)) }}</td>
                    </tr> @endforeach
                @endfor
                {{-- Lain-Lain --}}
                <tr>
                    <td><b>1.3. Pendapatan Lain-lain</b></td>
                    @foreach ($pendapatan_lain_total ?? '' as $a)
                        <td><b>{{ number_format($a->total) }}</b></td>
                        <?php $suml1 = $a->total; ?>
                    @endforeach
                    @foreach ($realisasi_lain_total ?? '' as $b)
                        <td><b>{{ number_format($b->total) }}</b></td>
                    @endforeach</td>
                    <td><b>{{ number_format(abs($a->total - $b->total)) }}</b></td>
                    <?php
                    $suml2 = $b->total;
                    $suml1 = $a->total;
                    $suml3 = $a->total - $b->total;
                    ?>
                </tr>
                {{-- Lain-lain --}}
                @for ($i = 1; $i < 8; $i++)
                    {{-- Asli Desa Val --}}
                    @foreach (${'c' . $i} ?? '' as $p) <tr>
                    <td>1.3.{{ $i }} {{ $nama[$i + 8] }}</td>
                    <td>{{ number_format($p->total_anggaran) }}</td>
                    <td>{{ number_format($p->total_realisasi) }}</td>
                    <td>{{ number_format(abs($p->total_anggaran - $p->total_realisasi)) }}</td>
                    </tr> @endforeach
                @endfor
                <tr style="background-color: #ADD8E6">
                    <td style="font-size: 14"><b>JUMLAH PENDAPATAN</b>
                    </td>
                    <td style="font-size: 14"><b> {{ number_format($suma1 + $sumt1 + $suml1) }}</b>
                    </td>
                    </td>
                    <td style="font-size: 14"><b> {{ number_format($suma2 + $sumt2 + $suml2) }}</b>
                    </td>
                    </td>
                    <td style="font-size: 14"><b> {{ number_format($suma3 + $sumt3 + $suml3) }}</b>
                    </td>
                    </td>
                    </td>
                </tr>

                {{-- BELANJA --}}
                {{--  --}}
                <tr>
                    <td colspan="4" style="font-size: 14"><b>2. BELANJA</b></td>
                </tr>
                {{-- 51 --}}
                @for ($i = 1; $i < 6; $i++)
                    <tr>
                        <td><b>2.{{ $i }}. {{ $nama[$i + 15] }}</b></td>
                        @foreach (${'anggaran_belanja5' . $i} ?? '' as $a)
                            <td><b>{{ number_format($a->total) }}</b></td>
                            <?php
                            $sumb1 = $sumb1 + $a->total;
                            $sumb2 = $sumb2 + $b->total;
                            $sumb3 = $sumb3 + $a->total - $b->total;
                            ?>
                        @endforeach
                        @foreach (${'realisasi_belanja5' . $i} ?? '' as $b)
                            <td><b>{{ number_format($b->total) }}</b></td>
                        @endforeach</td>
                        <td><b>{{ number_format(abs($a->total - $b->total)) }}</b></td>

                    </tr>
                @endfor
                <tr style="background-color: #ADD8E6">
                    <td style="font-size: 14"><b>JUMLAH BELANJA</b>
                    </td>
                    <td style="font-size: 14"><b> {{ number_format($sumb1 + $sumt1 + $suml1) }}</b>
                    </td>
                    </td>
                    <td style="font-size: 14"><b> {{ number_format($suma2 + $sumt2 + $suml2) }}</b>
                    </td>
                    </td>
                    <td style="font-size: 14"><b> {{ number_format($suma3 + $sumt3 + $suml3) }}</b>
                    </td>
                    </td>
                    </td>
                </tr>
                <tr style="background-color: #ADD8E6">
                    <td style="font-size: 14"><b>SURPLUS/ (DEFISIT)</b>
                    </td>
                    <td style="font-size: 14"><b> {{ number_format($suma1 + $sumt1 + $suml1 - $sumb1) }}</b>
                    </td>
                    </td>
                    <td style="font-size: 14"><b> {{ number_format($suma2 + $sumt2 + $suml2 - $sumb2) }}</b>
                    </td>
                    </td>
                    <td style="font-size: 14"><b>
                            {{ number_format(abs($suma1 + $sumt1 + $suml1 - $sumb1 - ($suma2 + $sumt2 + $suml2 - $sumb2))) }}</b>
                    </td>
                    </td>
                    </td>
                </tr>

                {{-- Pembiayaan --}}
                {{--  --}}
                <tr>
                    <td colspan="4" style="font-size: 14"><b>3. PEMBIAYAAN</b></td>
                </tr>
                {{-- Masuk --}}
                <tr>
                    <td><b>2.1. Penerimaan Pembiayaan</b></td>
                    @foreach (${'pembiayaan_masuk_anggaran_total'} ?? '' as $a)
                        <td><b>{{ number_format($a->total) }}</b></td>
                    @endforeach
                    @foreach (${'pembiayaan_masuk_realisasi_total'} ?? '' as $b)
                        <td><b>{{ number_format($b->total) }}</b></td>
                    @endforeach</td>
                    <td><b>{{ number_format(abs($a->total - $b->total)) }}</b></td>
                    <?php
                    $sa = $a->total;
                    $sb = $b->total;
                    $sc = abs($a->total - $b->total);
                    ?>
                </tr>
                {{-- Masuk --}}
                @for ($i = 1; $i < 5; $i++)
                    {{-- Asli Desa Val --}}
                    @foreach (${'d' . $i} ?? '' as $p) <tr>
                    <td>2.1.{{ $i }} {{ $nama[$i + 20] }}</td>
                    <td>{{ number_format($p->total_anggaran) }}</td>
                    <td>{{ number_format($p->total_realisasi) }}</td>
                    <td>{{ number_format(abs($p->total_anggaran - $p->total_realisasi)) }}</td>
                    </tr> @endforeach
                @endfor
                {{-- Keluar --}}
                <tr>
                    <td><b>2.2. Pengeluaran Pembiayaan</b></td>
                    @foreach (${'pembiayaan_keluar_anggaran_total'} ?? '' as $a)
                        <td><b>{{ number_format($a->total) }}</b></td>
                    @endforeach
                    @foreach (${'pembiayaan_keluar_realisasi_total'} ?? '' as $b)
                        <td><b>{{ number_format($b->total) }}</b></td>
                    @endforeach</td>
                    <td><b>{{ number_format(abs($a->total - $b->total)) }}</b></td>
                    <?php
                    $na = $a->total;
                    $nb = $b->total;
                    $nc = abs($a->total - $b->total);
                    ?>
                </tr>
                {{-- Keluar --}}
                @for ($i = 1; $i < 4; $i++)
                    {{-- Asli Desa Val --}}
                    @foreach (${'e' . $i} ?? '' as $p) <tr>
                    <td>2.1.{{ $i }} {{ $nama[$i + 24] }}</td>
                    <td>{{ number_format($p->total_anggaran) }}</td>
                    <td>{{ number_format($p->total_realisasi) }}</td>
                    <td>{{ number_format(abs($p->total_anggaran - $p->total_realisasi)) }}</td>
                    </tr> @endforeach
                @endfor
                {{-- NETTO --}}
                <tr style="background-color: #ADD8E6">
                    <td style="font-size: 14"><b>PEMBIAYAAN NETTO</b>
                    </td>
                    <td style="font-size: 14"><b> {{ number_format($sa - $na) }}</b>
                    </td>
                    </td>
                    <td style="font-size: 14"><b> {{ number_format($sb - $nb) }}</b>
                    </td>
                    </td>
                    <td style="font-size: 14"><b>
                            {{ number_format($sc - $nc) }}</b>
                    </td>
                    </td>
                    </td>
                </tr>
                {{-- SILPA/SiLPA tahun berjalan --}}
                <tr style="background-color: #ADD8E6">
                    <td style="font-size: 14"><b>SILPA/SiLPA TAHUN BERJALAN</b>
                    </td>
                    <td style="font-size: 14"><b> {{ number_format($sa + $na) }}</b>
                        <?php $silpaa = $sa + $na; ?>
                    </td>
                    </td>
                    <td style="font-size: 14"><b> {{ number_format($sb - $nb) }}</b>
                        <?php $silpab = $sb - $nb; ?>
                    </td>
                    </td>
                    <td style="font-size: 14"><b>
                            {{ number_format(abs($silpaa - $silpab)) }}</b>
                    </td>
                    </td>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
