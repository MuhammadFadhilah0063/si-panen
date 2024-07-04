
{{-- Modal Tambah Surat Masuk --}}
<div class="modal fade" id="suratMasukTambahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('surat-masuk.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">Status Surat</label>
                            <select name="status_surat" class="custom-select shadow-sm mb-3">
                                <option value="Asli">Asli</option>
                                <option value="Tembusan">Tembusan</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="">Sifat Surat</label>
                            <select name="sifat_surat" class="custom-select shadow-sm mb-3">
                                <option value="Penting">Penting</option>
                                <option value="Sangat Penting">Sangat Penting</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="">Sumber Surat</label>
                            <input type="text" name="sumber_surat" class="form-control shadow-sm mb-3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">No Surat</label>
                            <input type="text" name="no_surat" class="form-control shadow-sm mb-3">
                        </div>
                        <div class="col-md">
                            <label for="">Kode Surat</label>
                            <input type="text" name="kode_surat" class="form-control shadow-sm mb-3">
                        </div>
                        <div class="col-md">
                            <label for="">Divisi</label>
                            <select name="divisi_id" class="custom-select shadow-sm mb-3" required>
                                <option selected disabled>Pilih Opsi</option>
                                @foreach (\App\Models\Divisi::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" class="form-control shadow-sm mb-3">
                        </div>
                        <div class="col-md">
                            <label for="">Tanggal Surat Masuk</label>
                            <input type="date" name="tanggal_surat_masuk" class="form-control shadow-sm mb-3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">Perihal</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="perihal">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">File</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fileTambahSuratMasuk" name="file" onchange="changeLabelFile(this)" accept=".pdf,.doc,.docx" required>
                                    <label class="custom-file-label" for="fileTambahSuratMasuk">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Surat Masuk --}}
<div class="modal fade" id="suratMasukEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data" id="suratMasukEditForm">
                @csrf
                @method("PUT")
                <input type="hidden" name="id" id="editSuratMId">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">Status Surat</label>
                            <input type="text" name="status_surat" class="form-control shadow-sm mb-3" id="editSuratMStatusSurat">
                            {{-- <select name="status_surat" id="editSuratMStatusSurat" class="custom-select shadow-sm mb-3">
                                <option value="Asli">Asli</option>
                                <option value="Tembusan">Tembusan</option>
                            </select> --}}
                        </div>
                        <div class="col-md">
                            <label for="">Sifat Surat</label>
                            <input type="text" name="sifat_surat" class="form-control shadow-sm mb-3" id="editSuratMSifatSurat">
                            {{-- <select name="sifat_surat" id="editSuratMSifatSurat" class="custom-select shadow-sm mb-3">
                                <option value="Penting">Penting</option>
                                <option value="Sangat Penting">Sangat Penting</option>
                            </select> --}}
                        </div>
                        <div class="col-md">
                            <label for="">Sumber Surat</label>
                            <input type="text" name="sumber_surat" class="form-control shadow-sm mb-3" id="editSuratMSumberSurat">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">No Surat</label>
                            <input type="text" name="no_surat" class="form-control shadow-sm mb-3"id="editSuratMNoSurat">
                        </div>
                        <div class="col-md">
                            <label for="">Kode Surat</label>
                            <input type="text" name="kode_surat" class="form-control shadow-sm mb-3" id="editSuratMKodeSurat">
                        </div>
                        <div class="col-md">
                            <label for="">Divisi</label>
                            <input type="text" name="divisi_id" class="form-control shadow-sm mb-3" id="editSuratMDivisiInput">
                            <select name="divisi_id" id="editSuratMDivisiSelect" class="custom-select shadow-sm mb-3 d-none">
                                <option selected disabled>Pilih Opsi</option>
                                @foreach (\App\Models\Divisi::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" class="form-control shadow-sm mb-3" id="editSuratMTanggalSurat">
                        </div>
                        <div class="col-md">
                            <label for="">Tanggal Surat Masuk</label>
                            <input type="date" name="tanggal_surat_masuk" class="form-control shadow-sm mb-3" id="editSuratMTanggalSuratMasuk">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">Perihal</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="perihal" id="editSuratMPerihal">
                        </div>
                    </div>

                    {{-- download button --}}
                    <div class="row" id="rowDownloadBtnEditSM">
                        <div class="col-md mb-3">
                            <label for="">File</label>
                            <a class="btn btn-success d-block" id="editSuratMFile"><i class="fas fa-download"></i> Unduh</a>
                            <span class="text-danger" id="spanEditFileSuratM">File Kosong!</span>
                        </div>
                    </div>

                    <div class="row" id="rowInputFileEditSM">
                        <div class="col-md">
                            <label for="">File</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fileEditSuratMasuk" name="file" onchange="changeLabelFile(this)" accept=".pdf,.doc,.docx">
                                    <label class="custom-file-label" for="fileEditSuratMasuk">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="rowVerifEditSM">
                        <div class="col-md">
                            <div class="card shadow-sm my-3">
                                <div class="card-header bg-warning">
                                    <h3 class="card-title">Verifikasi Surat Masuk</h3>
                                </div>
                                <div class="card-body bg-light">
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="">Tindakan</label>
                                            <select name="tindakan" id="" class="custom-select shadow-sm mb-3">
                                                <option selected disabled>Pilih opsi</option>
                                                <option value="Disetujui">Setujui</option>
                                                <option value="Koreksi">Koreksi</option>
                                            </select>
                                        </div>
                                        <div class="col-md">
                                            <label for="">Catatan</label>
                                            <input type="text" class="form-control shadow-sm mb-3" name="catatan" placeholder="kosongkan jika tidak perlu" id="editSuratMCatatan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Show Surat Masuk --}}
<div class="modal fade" id="suratMasukShowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Show Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md">
                        <label for="">Status Surat</label>
                        <input type="text" name="sumber_surat" class="form-control shadow-sm mb-3" id="showSuratMStatusSurat" readonly>
                    </div>
                    <div class="col-md">
                        <label for="">Sifat Surat</label>
                        <input type="text" name="sumber_surat" class="form-control shadow-sm mb-3" id="showSuratMSifatSurat" readonly>
                    </div>
                    <div class="col-md">
                        <label for="">Sumber Surat</label>
                        <input type="text" name="sumber_surat" class="form-control shadow-sm mb-3" id="showSuratMSumberSurat" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label for="">No Surat</label>
                        <input type="text" name="no_surat" class="form-control shadow-sm mb-3" id="showSuratMNoSurat" readonly>
                    </div>
                    <div class="col-md">
                        <label for="">Kode Surat</label>
                        <input type="text" name="kode_surat" class="form-control shadow-sm mb-3" id="showSuratMKodeSurat" readonly>
                    </div>
                    <div class="col-md">
                        <label for="">Divisi</label>
                        <input type="text" name="kode_surat" class="form-control shadow-sm mb-3" id="showSuratMDivisi" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label for="">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" class="form-control shadow-sm mb-3" id="showSuratMTanggalSurat" readonly>
                    </div>
                    <div class="col-md">
                        <label for="">Tanggal Surat Masuk</label>
                        <input type="date" name="tanggal_surat_masuk" class="form-control shadow-sm mb-3" id="showSuratMTanggalSuratMasuk" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label for="">Perihal</label>
                        <input type="text" class="form-control shadow-sm mb-3" name="perihal" id="showSuratMPerihal" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label for="">File</label>
                        <a class="btn btn-success d-block" id="showSuratMFile"><i class="fas fa-download"></i> Unduh</a>
                        <span class="text-danger" id="spanShowFileSuratM">File Kosong!</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Surat Keluar --}}
<div class="modal fade" id="suratKeluarTambahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Surat Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('surat-keluar.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">Nomor Surat</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="no_surat">
                        </div>
                        <div class="col-md">
                            <label for="">Sifat Surat</label>
                            <select name="sifat_surat" class="custom-select shadow-sm mb-3">
                                <option value="Penting">Penting</option>
                                <option value="Sangat Penting">Sangat Penting</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="">Divisi</label>
                            <select name="divisi_id" class="custom-select shadow-sm mb-3">\
                                <option disabled selected>Pilih Opsi</option>
                                @foreach (\App\Models\Divisi::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">Perihal</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="perihal">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">Tanggal Surat</label>
                            <input type="date" class="form-control shadow-sm mb-3" name="tanggal_surat">
                        </div>
                        <div class="col-md">
                            <label for="">Surat Kepada</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="surat_kepada">
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-md">
                            <label for="">Status Surat</label>
                            <select name="status_surat" class="custom-select shadow-sm mb-3">
                                <option value="Asli">Asli</option>
                                <option value="Tembusan">Tembusan</option>
                            </select>
                        </div> --}}
                        <div class="col-md">
                            <label for="">Lampiran</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="lampiran" onchange="changeLabelFile(this)">
                                    <label class="custom-file-label" for="inputGroupFile01">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Surat Keluar --}}
<div class="modal fade" id="suratKeluarEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Surat Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data" id="editSuratKForm">
                @method("PUT")
                @csrf
                <input type="hidden" id="editSuratKId" name="surat_keluar_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">Nomor Surat</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="no_surat" id="editSuratKNoSurat">
                        </div>
                        <div class="col-md">
                            <label for="">Sifat Surat</label>
                            <select name="sifat_surat" class="custom-select shadow-sm mb-3" id="editSuratKSifat">
                                <option value="Penting">Penting</option>
                                <option value="Sangat Penting">Sangat Penting</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="">Divisi</label>
                            <select name="divisi_id" class="custom-select shadow-sm mb-3" id="editSuratKDivisi">
                                <option disabled selected>Pilih Opsi</option>
                                @foreach (\App\Models\Divisi::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">Perihal</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="perihal" id="editSuratKPerihal">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">Tanggal Surat</label>
                            <input type="date" class="form-control shadow-sm mb-3" name="tanggal_surat" id="editSuratKTanggal">
                        </div>
                        <div class="col-md">
                            <label for="">Surat Kepada</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="surat_kepada" id="editSuratKKepada">
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-md">
                            <label for="">Status Surat</label>
                            <select name="status_surat" id="editSuratKStatus" class="custom-select shadow-sm mb-3">
                                <option value="Asli">Asli</option>
                                <option value="Tembusan">Tembusan</option>
                            </select>
                        </div> --}}
                        <div class="col-md">
                            <label for="">Lampiran</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="editSuratKLampiran" aria-describedby="inputGroupFileAddon01" name="lampiran" onchange="changeLabelFile(this)">
                                    <label class="custom-file-label" for="editSuratKLampiran">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal show Surat Keluar --}}
<div class="modal fade" id="suratKeluarShowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Show Surat Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md">
                        <label for="">Nomor Surat</label>
                        <input type="text" class="form-control shadow-sm mb-3" name="no_surat" id="showSuratKNoSurat">
                    </div>
                    <div class="col-md">
                        <label for="">Sifat Surat</label>
                        <select name="sifat_surat" class="custom-select shadow-sm mb-3" id="showSuratKSifat">
                            <option value="Penting">Penting</option>
                            <option value="Sangat Penting">Sangat Penting</option>
                        </select>
                    </div>
                    <div class="col-md">
                        <label for="">Divisi</label>
                        <select name="divisi_id" class="custom-select shadow-sm mb-3" id="showSuratKDivisi">
                            <option disabled selected>Pilih Opsi</option>
                            @foreach (\App\Models\Divisi::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label for="">Perihal</label>
                        <input type="text" class="form-control shadow-sm mb-3" name="perihal" id="showSuratKPerihal">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label for="">Tanggal Surat</label>
                        <input type="date" class="form-control shadow-sm mb-3" name="tanggal_surat" id="showSuratKTanggal">
                    </div>
                    <div class="col-md">
                        <label for="">Surat Kepada</label>
                        <input type="text" class="form-control shadow-sm mb-3" name="surat_kepada" id="showSuratKKepada">
                    </div>
                    <div class="col-md">
                        <label for="">Pembuat Surat</label>
                        <input type="text" class="form-control shadow-sm mb-3" name="status_surat" id="showSuratKPembuat">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md d-none">
                        <label for="">Status Surat</label>
                        <input type="text" class="form-control shadow-sm mb-3" name="status_surat" id="showSuratKStatus">
                    </div>
                    <div class="col-md">
                        <label for="">Lampiran</label>
                        <a class="btn btn-success d-block disabled" id="showLampiran">Unduh</a>
                        <span id="showSuratKLampiranSpan" class="text-danger">Lampiran Kosong!</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Data Pegawai --}}
<div class="modal fade" id="dataPegawaiTambahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('data-pegawai.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">Nama</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="name">
                        </div>
                        <div class="col-md">
                            <label for="">Username</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="username">
                        </div>
                        <div class="col-md">
                            <label for="">Password</label>
                            <input type="password" class="form-control shadow-sm mb-3" name="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">Tingkatan</label>
                            <select name="roles" class="custom-select shadow-sm mb-3">
                                <option selected disabled>Pilih Opsi</option>
                                <option value="admin">Admin</option>
                                <option value="kepalabidang">Kepala Bidang</option>
                                <option value="p3mp">Ketua P3MP</option>
                                <option value="sekretaris">Sekretaris</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="">Jabatan</label>
                            <select name="jabatan" class="custom-select shadow-sm mb-3">
                                <option selected disabled>Pilih Opsi</option>
                                @foreach (\App\Models\Jabatan::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="">Status</label>
                            <select name="status" class="custom-select shadow-sm mb-3">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">Email</label>
                            <input type="email" class="form-control shadow-sm mb-3" name="email">
                        </div>
                        <div class="col-md">
                            <label for="">No. Telpon</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="telp">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Data Pegawai --}}
<div class="modal fade" id="dataPegawaiEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data" id="dataPegawaiFormEdit">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <input type="hidden" id="pegawaiEditId" name="id">
                            <label for="">Nama</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="name" id="pegawaiEditName">
                        </div>
                        <div class="col-md">
                            <label for="">Username</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="username" id="pegawaiEditUsername">
                        </div>
                        <div class="col-md">
                            <label for="">Password</label>
                            <input type="password" class="form-control shadow-sm mb-3" name="password" id="pegawaiEditPassword">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">Tingkatan</label>
                            <select name="roles" id="pegawaiEditRoles" class="custom-select shadow-sm mb-3">
                                <option selected disabled>Pilih Opsi</option>
                                <option value="admin">Admin</option>
                                <option value="kepalabidang">Kepala Bidang</option>
                                <option value="p3mp">Ketua P3MP</option>
                                <option value="sekretaris">Sekretaris</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="">Jabatan</label>
                            <select name="jabatan" id="pegawaiEditJabatan" class="custom-select shadow-sm mb-3">
                                <option selected disabled>Pilih Opsi</option>
                                @foreach (\App\Models\Jabatan::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="">Status</label>
                            <select name="status" id="pegawaiEditStatus" class="custom-select shadow-sm mb-3">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="">Email</label>
                            <input type="email" class="form-control shadow-sm mb-3" name="email" id="pegawaiEditEmail">
                        </div>
                        <div class="col-md">
                            <label for="">No. Telpon</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="telp" id="pegawaiEditTelp">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Show Data Pegawai --}}
<div class="modal fade" id="dataPegawaiShowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Show Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md">
                        <label for="">Nama</label>
                        <input type="text" class="form-control shadow-sm mb-3" name="name" id="pegawaiShowName" readonly>
                    </div>
                    <div class="col-md">
                        <label for="">Username</label>
                        <input type="text" class="form-control shadow-sm mb-3" name="username" id="pegawaiShowUsername" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label for="">Tingkatan</label>
                        <input type="text" class="form-control shadow-sm mb-3" id="pegawaiShowRoles" readonly>
                    </div>
                    <div class="col-md">
                        <label for="">Jabatan</label>
                        <input type="text" class="form-control shadow-sm mb-3" id="pegawaiShowJabatan" readonly>
                    </div>
                    <div class="col-md">
                        <label for="">Status</label>
                        <input type="text" class="form-control shadow-sm mb-3" id="pegawaiShowStatus" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label for="">Email</label>
                        <input type="email" class="form-control shadow-sm mb-3" name="email" id="pegawaiShowEmail" readonly>
                    </div>
                    <div class="col-md">
                        <label for="">No. Telpon</label>
                        <input type="text" class="form-control shadow-sm mb-3" name="telp" id="pegawaiShowTelp" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Jabatan --}}
<div class="modal fade" id="jabatanTambahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('jabatan.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">Nama</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="name">
                            <label for="">Status</label>
                            <select name="status" class="custom-select shadow-sm mb-3">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Jabatan --}}
<div class="modal fade" id="jabatanEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data" id="jabatanEditForm">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">Nama</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="name" id="jabatanEditNama">
                            <label for="">Status</label>
                            <select name="status" class="custom-select shadow-sm mb-3" id="jabatanEditStatus">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Tambah Divisi --}}
<div class="modal fade" id="divisiTambahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('divisi.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">Nama</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="name">
                            <label for="">Kode</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="kode">
                            <label for="">Deskripsi</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="desc">
                            <label for="">Status</label>
                            <select name="status" class="custom-select shadow-sm mb-3">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Divisi --}}
<div class="modal fade" id="divisiEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data" id="divisiFormEdit">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">Nama</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="name" id="editDivisiName">
                            <label for="">Kode</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="kode" id="editDivisiKode">
                            <label for="">Deskripsi</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="desc" id="editDivisiDesc">
                            <label for="">Status</label>
                            <select name="status" class="custom-select shadow-sm mb-3" id="editDivisiStatus">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Delete data --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data" id="hapusFormModal">
                @csrf
                @method("DELETE")
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md" id="modalBodyDelete">
                            <h4>Yakin untuk menghapus?</h4>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>