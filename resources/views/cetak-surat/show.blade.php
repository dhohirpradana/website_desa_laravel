<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $surat->nama }}</title>
    <link rel="icon" href="{{ url(Storage::url($desa->logo)) }}" type="image/png">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>

<body>
    <div style="margin:1cm">
        <div style="height:100px;width:100%" class="mb-5">
            <div style="height:90px;width:90px;float:left" class="">
                <img class="mw-100" src="{{ $logo }}" alt="">
            </div>
            <div class="text-center lh-20px">
                <span style="font-size: 14pt" class="font-weight-bold">PEMERINTAHAN KABUPATEN {{ Str::upper($desa->nama_kabupaten) }}</span><br>
                <span style="font-size: 14pt" class="font-weight-bold">KECAMATAN {{ Str::upper($desa->nama_kecamatan) }}</span><br>
                <span style="font-size: 14pt" class="font-weight-bold">DESA {{ Str::upper($desa->nama_desa) }}</span><br>
                <div style="font-size: 11pt; font-style: italic">
                    {{ $desa->alamat }}
                </div>
            </div>
            <hr style="border-top: 5px double #000000;">
        </div>

        @if ($surat->perihal == 1)
            @php
                $perihal = array();
                foreach ($surat->isiSurat->where('jenis_isi', 4) as $isiSurat) {
                    array_push($perihal, $isiSurat->isi);
                }
            @endphp
            <div style="width: 50%" class="float-left">
                <br>
                <table>
                    <tbody>
                        <tr>
                            <td>Nomor</td>
                            <td>: 140 / {!! str_repeat('&nbsp;', 10) !!} / 20.2003 / {{ Terbilang::roman(date('m')) }} / {{ date('Y') }}</td>
                        </tr>
                        <tr>
                            <td>Sifat</td>
                            <td>: {{ $perihal[0] }}</td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td>: {{ $perihal[1] }}</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>: {{ $perihal[2] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="margin-left: 50%; width: 50%" class="text-center float-right">
                <p style="margin-bottom: 55px">{{ $desa->nama_desa }}, {{ $tanggal }}<br>Kepada {{ $perihal[3] }}</p>
                <p>Di - {{ $perihal[4] }}</p>
            </div>
        @else
            <div class="text-center mt-5 mb-3">
                <b style="text-decoration: underline;">{{ Str::upper($surat->nama) }}</b><br>
                Nomor : 140 / {!! str_repeat('&nbsp;', 10) !!} / 20.2003 / {{ Terbilang::roman(date('m')) }} / {{ date('Y') }}
            </div>
        @endif

        @php
            $data_kades = true;
            $tabel = true;
            $i = 0;
        @endphp

        @foreach ($surat->isiSurat->where('jenis_isi', '!=', 4) as $key => $isiSurat)
            @php
                $string = $isiSurat->isi;
                $pattern = "/\{[0-9A-Za-z\s\(\)]+\}/";
                preg_match_all($pattern, $string, $matches);
                $hasil = $string;

                foreach ($matches[0] as $k => $value) {
                    $hasil = str_replace($value, $request->isian[$i], $hasil);
                    $i++;
                }

                try {
                    if ($surat->isiSurat[$key + 1]->jenis_isi == 3 || $data_kades == true && $surat->data_kades == 1) {
                        if ($isiSurat->jenis_isi == 1) {
                            echo '<div class="text-justify">'. str_repeat('&nbsp;', 12) . $hasil .'</div>';
                        } elseif ($isiSurat->jenis_isi == 2) {
                            echo '<div class="text-justify">'. $hasil .'</div>';
                        } elseif ($isiSurat->jenis_isi == 5) {
                            echo '<div class="font-weight-bold text-center" style="text-decoration: underline;">'. $hasil .'</div>';
                        }
                    } else {
                        if ($isiSurat->jenis_isi == 1) {
                            echo '<p class="text-justify">'. str_repeat('&nbsp;', 12) . $hasil .'</p>';
                        } elseif ($isiSurat->jenis_isi == 2) {
                            echo '<p class="text-justify">'. $hasil .'</p>';
                        } elseif ($isiSurat->jenis_isi == 5) {
                            echo '<p class="font-weight-bold text-center" style="text-decoration: underline;">'. $hasil .'</p>';
                        }
                    }
                } catch (\Throwable $th) {
                    if ($isiSurat->jenis_isi == 1) {
                        echo '<p class="text-justify">'. str_repeat('&nbsp;', 12) . $hasil .'</p>';
                    } elseif ($isiSurat->jenis_isi == 2) {
                        echo '<p class="text-justify">'. $hasil .'</p>';
                    } elseif ($isiSurat->jenis_isi == 5) {
                        echo '<p class="font-weight-bold text-center" style="text-decoration: underline;">'. $hasil .'</p>';
                    }
                }
            @endphp

            @if ($data_kades && $surat->data_kades == 1)
                <table class="mb-3 ml-5">
                    <tbody>
                        <tr>
                            <td width="160px" valign="top">Nama</td>
                            <td width="10px" valign="top">:</td>
                            <td class="text-justify" width="10cm" valign="top">{{ $desa->nama_kepala_desa }}</td>
                        </tr>
                        <tr>
                            <td width="160px" valign="top">Jabatan</td>
                            <td width="10px" valign="top">:</td>
                            <td class="text-justify" width="10cm" valign="top">Kepala Desa</td>
                        </tr>
                        <tr>
                            <td width="160px" valign="top">Alamat</td>
                            <td width="10px" valign="top">:</td>
                            <td class="text-justify" width="10cm" valign="top">{{ $desa->alamat_kepala_desa }}</td>
                        </tr>
                    </tbody>
                </table>

                @php
                    $data_kades = false;
                @endphp
            @endif

            @if ($isiSurat->jenis_isi == 3)
                @if ($tabel)
                    <table class="mb-3 ml-5">
                        <tbody>
                    @php
                        $tabel = false;
                    @endphp
                @endif

                <tr>
                    <td width="160px" valign="top">{{ $isiSurat->isi }}</td>
                    <td width="10px" valign="top">:</td>
                    <td class="text-justify" width="10cm" valign="top">{{ $request->isian[$i] }}</td>
                </tr>

                @php
                    $i++;
                    try {
                        if ($surat->isiSurat[$key + 1]->jenis_isi != 3) {
                            echo "</tbody>";
                            echo "</table>";
                            $tabel = true;
                        }
                    } catch (\Throwable $th) {}
                @endphp
            @endif
        @endforeach

        <div class="mt-3">
            @if ($surat->tanda_tangan_bersangkutan == 1)
                <div style="width: 50%" class="float-left text-center">
                    <br>
                    <p style="margin-bottom: 100px">
                        Yang Bersangkutan
                    </p>
                    <p style="" class="bold underline">
                        {{ $request->isian[count($request->isian)-1] }}
                    </p>
                </div>
            @endif
            <div style="margin-left: 50%; width: 50%" class="text-center float-right">
                <p style="margin-bottom: 100px">
                    {{ $desa->nama_desa }}, {{ $tanggal }}  <br>
                    Kepala Desa {{ $desa->nama_desa }}
                </p>
                <p style="" class="bold underline">
                    {{ $desa->nama_kepala_desa }}
                </p>
            </div>
        </div>
    </div>
</body>

</html>
