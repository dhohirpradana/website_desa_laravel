<table>
    <thead>
        <tr>
            <th><b>NIK</b></th>
            <th><b>KK</b></th>
            <th><b>Nama</b></th>
            <th><b>Jenis Kelamin</b></th>
            <th><b>Tempat Lahir</b></th>
            <th><b>Tanggal Lahir</b></th>
            <th><b>Agama</b></th>
            <th><b>Pendidikan</b></th>
            <th><b>Pekerjaan</b></th>
            <th><b>Golongan Darah</b></th>
            <th><b>Status Perkawinan</b></th>
            <th><b>Status Hubungan dalam keluarga</b></th>
            <th><b>Kewarganegaraan</b></th>
            <th><b>Nomor Paspor</b></th>
            <th><b>Nomor Kitas atau Kitap</b></th>
            <th><b>NIK Ayah</b></th>
            <th><b>Nama Ayah</b></th>
            <th><b>NIK Ibu</b></th>
            <th><b>Nama Ibu</b></th>
            <th><b>Dusun</b></th>
            <th><b>RW</b></th>
            <th><b>RT</b></th>
            <th><b>Alamat</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($penduduks ?? '' as $p)
            <tr>
                <td>{{ number_format($p->nik) }}</td>
                <td>{{ number_format($p->kk) }}</td>
                <td>{{ $p->nama }}</td>
                <td>
                    @if ($p->jenis_kelamin == 1)
                        Laki-Laki
                    @elseif ($p->jenis_kelamin == 2)
                        Perempuan
                    @endif
                </td>
                <td>{{ $p->tempat_lahir }}</td>
                <td>{{ $p->tanggal_lahir }}</td>
                <td>{{ $p->agama }}</td>
                <td>{{ $p->pendidikan }}</td>
                <td>{{ $p->pekerjaan }}</td>
                <td>{{ $p->darah }}</td>
                <td>{{ $p->status_perkawinan }}</td>
                <td>{{ $p->status_hubungan_dalam_keluarga }}</td>
                {{-- <td>{{ $p->kewarganegaraan }}</td> --}}
                <td>
                    @if ($p->kewarganegaraan == 1)
                        WNI
                    @elseif ($p->kewarganegaraan == 2)
                        WNA
                    @elseif ($p->kewarganegaraan == 3)
                        Kewarganegaraan Ganda
                    @endif
                </td>
                <td>{{ $p->nomor_paspor }}</td>
                <td>{{ $p->nomor_kitas_atau_kitap }}</td>
                <td>{{ number_format($p->nik_ayah) }}</td>
                <td>{{ $p->nama_ayah }}</td>
                <td>{{ number_format($p->nik_ibu) }}</td>
                <td>{{ $p->nama_ibu }}</td>
                <td>{{ $p->dusun }}</td>
                <td>{{ $p->rw }}</td>
                <td>{{ $p->rt }}</td>
                <td>{{ $p->alamat }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
