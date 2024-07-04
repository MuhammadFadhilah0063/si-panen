@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{ $title }}</h1>
@endsection

@section('content')

    @if (session('success'))
        <div class="row mt-3">
            <div class="col-md">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md">
            {!! $buttons !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="card card-lime card-outline">
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
                @if (Str::contains(request()->url(), '/hasil-panen/daerah'))
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-ket">
                            Jumlah total semua hasil produksi panen
                        </div>
                        <div class="col text-right font-weight-bold text-total">
                            {{ $dataPanen['total'] }} Ton
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Tambah Penyuluh --}}
    <!-- Modal -->
    {{-- @include('templates.modal') --}}
    <div class="modal fade" id="tambahPenyuluh" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.penyuluh.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Penyuluh</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md">
                                <label for="nama_penyuluh">Nama Penyuluh</label>
                                <input type="text" name="nama_penyuluh" id="nama_penyuluh" class="form-control mb-3"
                                    placeholder="Nama Penyuluh" required>

                                <label for="nip_penyuluh">Nip Penyuluh</label>
                                <input type="number" name="nip_penyuluh" id="nip_penyuluh" class="form-control mb-3"
                                    placeholder="Nip Penyuluh" required>

                                <label for="no_hp_penyuluh">No Hp Penyuluh</label>
                                <input type="number" name="no_hp_penyuluh" id="no_hp_penyuluh" class="form-control mb-3"
                                    placeholder="No Hp Penyuluh" required>

                                <label for="alamat_penyuluh">Alamat Penyuluh</label>
                                <input type="text" name="alamat_penyuluh" id="alamat_penyuluh" class="form-control mb-3"
                                    placeholder="Alamat Penyuluh" required>
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

    {{-- Tambah Kecamatan --}}
    <!-- Modal -->
    {{-- @include('templates.modal') --}}
    <div class="modal fade" id="tambahKelurahan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.kelurahan.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kelurahan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md">
                                <label for="Nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control mb-3"
                                    placeholder="Nama Kelurahan" required>

                                <label for="Kecamatan">Kecamatan</label>
                                <select name="kecamatan_id" id="kecamatan_id" class="form-control mb-3" required>
                                    <option value="" disabled selected>-- Pilih Kecamatan --</option>
                                    @foreach (\App\Models\Kecamatan::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
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

    {{-- Tambah Kelurahan --}}

    <div class="modal fade" id="tambahKecamatan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.kecamatan.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kecamatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md">
                                <label for="Nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control mb-3"
                                    placeholder="Nama Kecamatan" required>
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

    {{-- Tambah Pegawai --}}
    <div class="modal fade" id="tambahPegawai" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.pegawai.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label for="Nama">Nama Pegawai</label>
                            <input type="text" name="nama_pegawai" id="nama" class="form-control mb-3"
                                placeholder="Nama Pegawai" required>
                            <label for="nip">NIP</label>
                            <input type="text" name="nip_pegawai" id="nip" class="form-control mb-3"
                                placeholder="Nama Pegawai" required>
                            <label for="No Hp">No Hp</label>
                            <input type="text" name="no_hp_pegawai" id="No Hp" class="form-control mb-3"
                                placeholder="No Hp Pegawai" required>
                            <label for="Alamat">Alamat</label>
                            <input type="text" name="alamat_pegawai" id="Alamat" class="form-control mb-3"
                                placeholder="Alamat Pegawai" required>
                            <label for="Jabatan">Jabatan</label>
                            <select name="jabatan_id" id="jabatan_id" class="form-control mb-3" required>
                                <option value="" disabled selected>-- Pilih Jabatan --</option>
                                @foreach (\App\Models\Jabatan::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
                                @endforeach
                            </select>
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

    {{-- Tambah Jabatan --}}
    <div class="modal fade" id="tambahJabatan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.jabatan.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Jabatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label for="Nama">Nama Jabatan</label>
                            <input type="text" name="nama_jabatan" id="nama" class="form-control mb-3"
                                placeholder="Nama Jabatan" required>
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

    {{-- Tambah Poktan --}}
    <div class="modal fade" id="tambahPoktan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @php
                    $role = auth()->user()->getRoleNames();
                @endphp
                <form action="{{ route($role[0] . '.poktan.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Poktan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label for="Nama">Nama Petani</label>
                            <input type="text" name="nama_petani" id="nama" class="form-control mb-3"
                                placeholder="Nama Petani" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Luas Lahan Poktan</label>
                            <input type="text" name="luas_lahan_poktan" id="nama" class="form-control mb-3"
                                placeholder="Luas Lahan Poktan" required>
                        </div>
                        <div class="row">
                            <label for="Nama">NIK</label>
                            <input type="text" name="NIK" id="nama" class="form-control mb-3"
                                placeholder="nik" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="nama" class="form-control mb-3"
                                placeholder="Tempat Lahir" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" id="nama" class="form-control mb-3"
                                required>
                        </div>
                        <div class="row">
                            <label for="no_hp_poktan">No HP Poktan</label>
                            <input type="number" name="no_hp_poktan" id="no_hp_poktan"
                                class="form-control shadow-sm mb-3" placeholder="No HP Poktan" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Alamat</label>
                            <input type="text" name="alamat_poktan" id="nama" class="form-control mb-3"
                                placeholder="Alamat" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Status</label>
                            <input type="text" name="status_poktan" id="nama" class="form-control mb-3"
                                placeholder="Status" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Penyuluh</label>
                            <select name="penyuluh_id" id="penyuluh_id" class="form-control mb-3" required>
                                <option value="" disabled selected>-- Pilih Penyuluh --</option>
                                @foreach (\App\Models\Penyuluh::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_penyuluh }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <label for="Nama">Kecamatan</label>
                            <select name="kecamatan_id" id="kecamatan_id" class="form-control mb-3"
                                onchange="getKelurahan(this, 'create')"
                                data-url="{{ Auth::user()->hasRole('admin') ? route('admin.getKelurahanByKecamatan') : route('penyuluh.getKelurahanByKecamatan') }}"
                                required>
                                <option value="" disabled selected>-- Pilih Kecamatan --</option>
                                @foreach (\App\Models\Kecamatan::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <label for="Nama">Kelurahan</label>
                            <select name="kelurahan_id" id="kelurahan_id_create" class="form-control mb-3" required>
                                <option value="" disabled selected>-- Pilih Kelurahan --</option>
                            </select>
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

    {{-- Tambah Gapoktan --}}
    <div class="modal fade" id="tambahGapoktan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route($role[0] . '.gapoktan.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Gapoktan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label for="Nama">Ketua Tani</label>
                            <input type="text" name="nama_petani" id="nama_petani" class="form-control mb-3"
                                placeholder="Nama Petani" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Luas Lahan Gapoktan</label>
                            <input type="text" name="luas_lahan_gapoktan" id="luas_lahan_gapoktan"
                                class="form-control mb-3" placeholder="Luas Lahan Gapoktan" required>
                        </div>
                        <div class="row">
                            <label for="Nama">NIK</label>
                            <input type="text" name="NIK" id="nama" class="form-control mb-3"
                                placeholder="nik" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="nama" class="form-control mb-3"
                                placeholder="Tempat Lahir" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" id="nama" class="form-control mb-3"
                                required>
                        </div>
                        <div class="row">
                            <label for="Nama">No HP Gapoktan</label>
                            <input type="number" name="no_hp_gapoktan" id="no_hp_gapoktan" class="form-control mb-3"
                                placeholder="No HP Gapoktan" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Alamat</label>
                            <input type="text" name="alamat_gapoktan" id="alamat_gapoktan" class="form-control mb-3"
                                placeholder="Alamat" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Status</label>
                            <input type="text" name="status_gapoktan" id="status_gapoktan" class="form-control mb-3"
                                placeholder="Status" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Penyuluh</label>
                            <select name="penyuluh_id" id="penyuluh_id" class="form-control mb-3" required>
                                <option value="" disabled selected>-- Pilih Penyuluh --</option>
                                @foreach (\App\Models\Penyuluh::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_penyuluh }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <label for="Nama">Kelompok</label>
                            <input type="text" name="kelompok_nama" id="nama" class="form-control mb-3"
                                placeholder="Kelompok" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Kecamatan</label>
                            <select name="kecamatan_id" id="kecamatan_id" class="form-control mb-3"
                                onchange="getKelurahan(this, 'creategapoktan')"
                                data-url="{{ Auth::user()->hasRole('admin') ? route('admin.getKelurahanByKecamatan') : route('penyuluh.getKelurahanByKecamatan') }}"
                                required>
                                <option value="" disabled selected>-- Pilih Kecamatan --</option>
                                @foreach (\App\Models\Kecamatan::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <label for="Nama">Kelurahan</label>
                            <select name="kelurahan_id" id="kelurahan_id_creategapoktan" class="form-control mb-3" required>
                                <option value="" disabled selected>-- Pilih Kelurahan --</option>
                            </select>
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

    {{-- Tambah Berita --}}
    <div class="modal fade" id="tambahBerita" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Berita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="slug" id="slug" class="form-control mb-3" required
                                readonly>
                        </div>
                        <div class="row">
                            <label for="judul_berita">Judul Berita</label>
                            <input type="text" name="judul_berita" id="judul_berita"
                                oninput="generateSlug(this, 'slug')" class="form-control mb-3" placeholder="Judul Berita"
                                required>
                        </div>
                        <div class="row">
                            <label for="Nama">Isi Berita</label>
                            <textarea class="form-control mb-3" name="isi_berita" id="isi_berita" cols="30" rows="10"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label for="">Masukkan Foto</label>
                                <div class="input-group mb-3" id="fotoColumn">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-upload"></i>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" id="inputFile_1" name="foto" class="custom-file-input"
                                            onchange="changeLabelInputFile(this)" accept="image/*">
                                        <label class="custom-file-label text-truncate" for="inputFile_1">
                                            Pilih File...
                                        </label>
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

    {{-- Edit Berita --}}
    <div class="modal fade" id="editBeritaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="editBeritaModalForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Berita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="slug" id="slug_edit" class="form-control mb-3" required
                                readonly>
                        </div>
                        <div class="row">
                            <label for="judul_berita">Judul Berita</label>
                            <input type="text" name="judul_berita" id="judul_berita"
                                oninput="generateSlug(this, 'slug_edit')" class="form-control mb-3"
                                placeholder="Judul Berita" required>
                        </div>
                        <div class="row">
                            <label for="Nama">Isi Berita</label>
                            <textarea class="form-control mb-3" name="isi_berita" id="isi_berita" cols="30" rows="10"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label for="">Edit Foto</label>
                                <img src="" id="foto_preview" width="300px" height="300px"
                                    class="d-block my-3">
                                <div class="input-group mb-3" id="fotoColumn">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-upload"></i>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" id="inputFile_2" name="foto_edit"
                                            class="custom-file-input" onchange="changeLabelInputFile(this)"
                                            accept="image/*">
                                        <label class="custom-file-label text-truncate" for="inputFile_2">
                                            Pilih File...
                                        </label>
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

    {{-- Edit Jabatan --}}
    <div class="modal fade" id="editJabatanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="editJabatanModalForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Jabatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md">
                                <label for="editNamaJabatan">Nama Jabatan</label>
                                <input type="text" name="nama_jabatan" id="editNamaJabatan" class="form-control mb-3"
                                    placeholder="Nama Jabatan" required>
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

    {{-- Edit Kelurahan --}}

    <div class="modal fade" id="editKelurahanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="editKelurahanModalForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kelurahan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md">
                                <label for="Nama">Nama</label>
                                <input type="text" name="nama" id="editNamaKelurahan" class="form-control mb-3"
                                    placeholder="Nama Kelurahan" required>

                                <label for="Kecamatan">Kecamatan</label>
                                <select name="kecamatan_id" id="editNamaKecamatanId" class="form-control mb-3" required>
                                    <option value="" disabled selected>-- Pilih Kecamatan --</option>
                                    @foreach (\App\Models\Kecamatan::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
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

    {{-- Edit Kecamatan --}}

    <div class="modal fade" id="editKecamatanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="editKecamatanModalForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kecamatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md">
                                <label for="Nama">Nama</label>
                                <input type="text" name="nama" id="editNamaKecamatan" class="form-control mb-3"
                                    placeholder="Nama Kecamatan" required>
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

    {{-- Edit Penyuluh --}}

    <div class="modal fade" id="editPenyuluhModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="editPenyuluhModalForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Penyuluh</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md">
                                <label for="nama_penyuluh">Nama Penyuluh</label>
                                <input type="text" name="nama_penyuluh" id="nama_penyuluh" class="form-control mb-3"
                                    placeholder="Nama Penyuluh" required>

                                <label for="nip_penyuluh">Nip Penyuluh</label>
                                <input type="number" name="nip_penyuluh" id="nip_penyuluh" class="form-control mb-3"
                                    placeholder="Nip Penyuluh" required>

                                <label for="no_hp_penyuluh">No Hp Penyuluh</label>
                                <input type="number" name="no_hp_penyuluh" id="no_hp_penyuluh"
                                    class="form-control mb-3" placeholder="No Hp Penyuluh" required>

                                <label for="alamat_penyuluh">Alamat Penyuluh</label>
                                <input type="text" name="alamat_penyuluh" id="alamat_penyuluh"
                                    class="form-control mb-3" placeholder="Alamat Penyuluh" required>
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

    {{-- Edit Poktan --}}

    <div class="modal fade" id="editPoktanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="editPoktanModalForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Poktan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <label for="Nama">Nama Petani</label>
                                <input type="text" name="nama_petani" id="nama" class="form-control mb-3"
                                    placeholder="Nama Petani" required>
                            </div>
                            <div class="row">
                                <label for="Nama">Luas Lahan Poktan</label>
                                <input type="text" name="luas_lahan_poktan" id="nama" class="form-control mb-3"
                                    placeholder="Luas Lahan Poktan" required>
                            </div>
                            <div class="row">
                                <label for="Nama">NIK</label>
                                <input type="text" name="NIK" id="nama" class="form-control mb-3"
                                    placeholder="nik" required>
                            </div>
                            <div class="row">
                                <label for="Nama">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="nama" class="form-control mb-3"
                                    placeholder="Tempat Lahir" required>
                            </div>
                            <div class="row">
                                <label for="Nama">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="nama" class="form-control mb-3"
                                    required>
                            </div>
                            <div class="row">
                                <label for="Nama">No HP Poktan</label>
                                <input type="number" name="no_hp_poktan" id="nama" class="form-control mb-3"
                                    placeholder="No HP Poktan" required>
                            </div>
                            <div class="row">
                                <label for="Nama">Alamat</label>
                                <input type="text" name="alamat_poktan" id="nama" class="form-control mb-3"
                                    placeholder="Alamat" required>
                            </div>
                            <div class="row">
                                <label for="Nama">status</label>
                                <input type="text" name="status_poktan" id="nama" class="form-control mb-3"
                                    placeholder="status" required>
                            </div>
                            <div class="row">
                                <label for="Nama">Penyuluh</label>
                                <select name="penyuluh_id" id="penyuluh_id" class="form-control mb-3" required>
                                    <option value="" disabled selected>-- Pilih Penyuluh --</option>
                                    @foreach (\App\Models\Penyuluh::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_penyuluh }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <label for="Nama">Kecamatan</label>
                                <select name="kecamatan_id" id="kecamatan_id" class="form-control mb-3"
                                    onchange="getKelurahan(this, 'edit')"
                                    data-url="{{ Auth::user()->hasRole('admin') ? route('admin.getKelurahanByKecamatan') : route('penyuluh.getKelurahanByKecamatan') }}"
                                    required>
                                    <option value="" disabled selected>-- Pilih Kecamatan --</option>
                                    @foreach (\App\Models\Kecamatan::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <label for="Nama">Kelurahan</label>
                                <select name="kelurahan_id" id="kelurahan_id_edit" class="form-control mb-3" required>
                                    <option value="" disabled selected>-- Pilih Kelurahan --</option>
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

    {{-- Edit Gapoktan --}}

    <div class="modal fade" id="editGapoktanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="editGapoktanModalForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Gapoktan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <label for="Nama">Ketua Tani</label>
                                <input type="text" name="nama_petani" id="nama_petani" class="form-control mb-3"
                                    placeholder="Nama Petani" required>
                            </div>
                            <div class="row">
                                <label for="Nama">Luas Lahan Gapoktan</label>
                                <input type="text" name="luas_lahan_gapoktan" id="luas_lahan_gapoktan"
                                    class="form-control mb-3" placeholder="Luas Lahan Gapoktan" required>
                            </div>
                            <div class="row">
                                <label for="Nama">NIK</label>
                                <input type="text" name="NIK" id="nama" class="form-control mb-3"
                                    placeholder="nik" required>
                            </div>
                            <div class="row">
                                <label for="Nama">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="nama" class="form-control mb-3"
                                    placeholder="Tempat Lahir" required>
                            </div>
                            <div class="row">
                                <label for="Nama">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="nama" class="form-control mb-3"
                                    required>
                            </div>
                            <div class="row">
                                <label for="Nama">No HP Gapoktan</label>
                                <input type="number" name="no_hp_gapoktan" id="no_hp_gapoktan"
                                    class="form-control mb-3" placeholder="No HP Gapoktan" required>
                            </div>
                            <div class="row">
                                <label for="Nama">Alamat</label>
                                <input type="text" name="alamat_gapoktan" id="alamat_gapoktan"
                                    class="form-control mb-3" placeholder="Alamat" required>
                            </div>
                            <div class="row">
                                <label for="Nama">Status</label>
                                <input type="text" name="status_gapoktan" id="status_gapoktan"
                                    class="form-control mb-3" placeholder="Status" required>
                            </div>
                            <div class="row">
                                <label for="Nama">Penyuluh</label>
                                <select name="penyuluh_id" id="penyuluh_id" class="form-control mb-3" required>
                                    <option value="" disabled selected>-- Pilih Penyuluh --</option>
                                    @foreach (\App\Models\Penyuluh::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_penyuluh }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <label for="Nama">Kelompok</label>
                                <input type="text" name="kelompok_nama" id="nama" class="form-control mb-3"
                                    placeholder="Kelompok" required>
                            </div>
                            <div class="row">
                                <label for="Nama">Kecamatan</label>
                                <select name="kecamatan_id" id="kecamatan_id" class="form-control mb-3"
                                    onchange="getKelurahan(this, 'editgapoktan')"
                                    data-url="{{ Auth::user()->hasRole('admin') ? route('admin.getKelurahanByKecamatan') : route('penyuluh.getKelurahanByKecamatan') }}"
                                    required>
                                    <option value="" disabled selected>-- Pilih Kecamatan --</option>
                                    @foreach (\App\Models\Kecamatan::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <label for="Nama">Kelurahan</label>
                                <select name="kelurahan_id" id="kelurahan_id_editgapoktan" class="form-control mb-3" required>
                                    <option value="" disabled selected>-- Pilih Kelurahan --</option>
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

    {{-- Tambah Kelurahan --}}

    <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.user-config.store') }}" id="tambahUserModalForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md">
                                <select name="roles" id="akun" class="form-control mb-3" required>
                                    <option disabled selected>-- Pilih Tipe Akun --</option>
                                    <option value="penyuluh">Penyuluh</option>
                                    <option value="petani">Petani</option>
                                    <option value="pegawai">Pegawai</option>
                                    <option value="kabid">Kepala Bidang</option>
                                </select>
                                <select name="name" id="nama_user" class="form-control mb-3" required>
                                    <option disabled selected>-- Pilih Data --</option>
                                </select>
                                <label>Username</label>
                                <input type="text" name="username" class="form-control mb-3" placeholder="Username"
                                    required>
                                <label>Email</label>
                                <input type="email" name="email" class="form-control mb-3" placeholder="Email"
                                    required>
                                <label>No. Telepon</label>
                                <input type="number" readonly name="telp" id="telponnn" class="form-control mb-3"
                                    placeholder="No. Telepon" required>
                                <label>Password</label>
                                <input type="password" name="password" class="form-control mb-3" placeholder="Password"
                                    required>
                                <label>Ketik Ulang Password</label>
                                <input type="password" name="password_2" class="form-control mb-3"
                                    placeholder="Ketik Ulang Password" required>
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

    {{-- Hapus Data --}}

    <div class="modal fade" id="hapusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="hapusModalForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Verifikasi Hasil Penen --}}

    <div class="modal fade" id="verifikasiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="updateVerifikasiModalForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Verifikasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md">
                                <label>Status Verifikasi</label>
                                <select name="is_verified" id="is_verified" class="form-control mb-3" required>
                                    <option disabled selected>-- Pilih Status --</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Diterima">Diterima</option>
                                    <option value="Ditolak">Ditolak</option>
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

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <!-- jQuery -->
    <script src="{{ asset('js/script.js') }}"></script>
    {{ $dataTable->scripts() }}
    <script>
        // Panggil fungsi tambahUserForm() setelah dokumen dimuat sepenuhnya
        tambahUserForm();
    </script>
@endsection
