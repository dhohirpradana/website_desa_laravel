<h6 class="heading-small text-muted">Alat</h6>
<div class="pl-lg-4">
    <div class="mb-3">
        <button type="button" title="shorcut-key (ctrl + alt + p)" data-toggle="tooltip" id="paragraf" class="btn btn-sm btn-slack mt-2">Paragraf</button>
        <button type="button" title="shorcut-key (ctrl + alt + k)" data-toggle="tooltip" id="kalimat" class="btn btn-sm btn-slack mt-2">Kalimat</button>
        <button type="button" title="shorcut-key (ctrl + alt + i)" data-toggle="tooltip" id="isi" class="btn btn-sm btn-slack mt-2">Isian</button>
        <button type="button" title="shorcut-key (ctrl + alt + j)" data-toggle="tooltip" id="sub-judul" class="btn btn-sm btn-slack mt-2">Sub Judul</button>
        <a href="{{ url('img/bantuan-paragraf-kalimat-isian.png') }}" data-fancybox><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="tampilkan_surat" name="tampilkan_surat" value="1">
        <label class="custom-control-label" for="tampilkan_surat">Tampilkan surat ini untuk warga yang ingin mencetak surat keterangan ini</label>
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="perihal" name="perihal" value="1">
        <label class="custom-control-label" for="perihal">Perihal</label> <a href="{{ url('img/bantuan-perihal.png') }}" data-fancybox data-caption="Akan menampilkan surat seperti ini"><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="data_kades" name="data_kades" value="1">
        <label class="custom-control-label" for="data_kades">Data Kades</label> <a href="{{ url('img/bantuan-data-kades.png') }}" data-fancybox data-caption="Akan menampilkan data kepala desa"><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="tanda_tangan_bersangkutan" name="tanda_tangan_bersangkutan" value="1">
        <label class="custom-control-label" for="tanda_tangan_bersangkutan">Tanda tangan bersangkutan</label> <a href="{{ url('img/bantuan-tanda-tangan-bersangkutan.png') }}" data-fancybox data-caption="Akan menampilkan tanda tangan yang bersangkutan"><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
    </div>
</div>
