<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $surat->nama }}</title>
    <link rel="icon" href="{{ public_path(Storage::url($desa->logo)) }}">

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
        <div style="height:100px;width:100%">
            <div style="height:90px;width:90px;float:left" class="">
                <img class="mw-100" src="{{ public_path(Storage::url($desa->logo)) }}" alt="">
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
        <div class="text-center mt-5 mb-3" >
            <b style="text-decoration: underline;">{{ Str::upper($surat->nama) }}</b><br>
            Nomor : 140 / &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; / 22.2003 / {{ Terbilang::roman(date('m')) }} / {{ date('Y') }}
        </div>

        <p class="text-justify mt-3 text-center">
            Mohon maaf website sedang dalam perkembangan
        </p>

        {{-- <div style="margin-left:50%;" class="text-center">
            <p style="line-height: 1; margin-bottom: 75px">
                {{ $desa->nama_desa }}, {{ date('d-m-Y') }}  <br>
                Kepala Desa {{ $desa->nama_desa }}
            </p>
            <p style="line-height: 1;" class="bold underline">
                {{ $desa->nama_kepala_desa }}
            </p>
        </div> --}}
    </div>
</body>

</html>
