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

    <div class="row">
        <div class="col-md">
            <x-adminlte-card title="" theme="primary" icon="fas fa-lg fa-plus">
                <div class="container-fluid">
                    <form
                        action="{{ Auth::user()->hasRole('admin') ? route('admin.hasil-panen.store') : route('penyuluh.hasil-panen.store') }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <x-adminlte-card theme="secondary" theme-mode="outline" class="bg-light">

                            @if (auth()->user()->roles == 'admin')
                                <div class="row">
                                    <div class="col-md">
                                        <label for="luas_lahan">Luas Lahan</label>
                                        <input type="text" name="luas_lahan" id="luas_lahan"
                                            class="form-control shadow-sm mb-3" placeholder="Luas Lahan" required>
                                    </div>
                                    <div class="col-md">
                                        <label for="alamat_ubinan">Alamt Ubinan</label>
                                        <input type="text" name="alamat_ubinan" id="alamat_ubinan"
                                            class="form-control shadow-sm mb-3" placeholder="Alamt Ubinan" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <label for="kelompok_tani">Kelompok Tani/Nama Petani</label>
                                        <input type="text" name="kelompok_tani" id="kelompok_tani"
                                            class="form-control shadow-sm mb-3" placeholder="Kelompok Tani" required>
                                    </div>
                                    <div class="col-md">
                                        <label for="url_lokasi">URL Lokasi (Gmaps)</label>
                                        <input type="text" name="url_lokasi" id="url_lokasi"
                                            class="form-control shadow-sm mb-3" placeholder="URL Lokasi (Gmaps)" required>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md">
                                        <label for="luas_lahan">Luas Lahan</label>
                                        <input type="text" name="luas_lahan" id="luas_lahan"
                                            class="form-control shadow-sm mb-3" placeholder="Luas Lahan" required>
                                    </div>
                                    <div class="col-md">
                                        <label for="alamat_ubinan">Alamt Ubinan</label>
                                        <input type="text" name="alamat_ubinan" id="alamat_ubinan"
                                            class="form-control shadow-sm mb-3" placeholder="Alamt Ubinan" required>
                                    </div>
                                    <div class="col-md">
                                        <label for="kelompok_tani">Kelompok Tani/Nama Petani</label>
                                        <input type="text" name="kelompok_tani" id="kelompok_tani"
                                            class="form-control shadow-sm mb-3" placeholder="Kelompok Tani" required>
                                    </div>
                                    <div class="col-md">
                                        <label for="url_lokasi">URL Lokasi (Gmaps)</label>
                                        <input type="text" name="url_lokasi" id="url_lokasi"
                                            class="form-control shadow-sm mb-3" placeholder="URL Lokasi (Gmaps)" required>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md">
                                    <label for="tgl_tanam">Tanggal Tanam</label>
                                    <div class="input-group mb-3 shadow-sm">
                                        <input type="date" name="tgl_tanam" id="" class="form-control"
                                            placeholder="Tanggal Tanam" aria-label="Tanggal Tanam" required
                                            aria-describedby="basic-addon2">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="tgl_panen">Tanggal Panen</label>
                                    <div class="input-group mb-3 shadow-sm">
                                        <input type="date" name="tgl_panen" id="" class="form-control"
                                            placeholder="Tanggal Panen" aria-label="Tanggal Panen" required
                                            aria-describedby="basic-addon2">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="gkp">GKP</label>
                                    <div class="input-group mb-3 shadow-sm">
                                        <input type="number" name="gkp" id="gkp" class="form-control"
                                            placeholder="GKP" aria-label="GKP" required aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="gkg">GKG</label>
                                    <div class="input-group mb-3 shadow-sm">
                                        <input type="number" name="gkg" id="gkg" class="form-control"
                                            placeholder="GKG" aria-label="GKG" required aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label for="hasil_produksi">Hasil Produksi</label>
                                    <div class="input-group mb-3 shadow-sm">
                                        <input type="number" name="hasil_produksi" id="hasil_produksi"
                                            class="form-control" placeholder="Hasil Produksi" aria-label="Hasil Produksi"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Ton</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="detail_hasil_produksi">Detail Hasil Produksi</label>
                                    <input type="text" name="detail_hasil_produksi" id="detail_hasil_produksi"
                                        class="form-control shadow-sm mb-3" placeholder="Detail Hasil Produksi" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label for="kecamatan_id">Kecamatan</label>
                                    <select name="kecamatan_id" id="kecamatan_id" onchange="getKelurahan(this)"
                                        data-url="{{ Auth::user()->hasRole('admin') ? route('admin.getKelurahanByKecamatan') : route('penyuluh.getKelurahanByKecamatan') }}"
                                        class="custom-select shadow-sm mb-3" required>
                                        <option value="" disabled selected>-- Pilih Kecamatan --</option>
                                        @foreach ($kecamatan as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label for="kelurahan_id">Kelurahan</label>
                                    <select name="kelurahan_id" id="kelurahan_id" class="custom-select shadow-sm mb-3"
                                        required>
                                        <option value="">-- Pilih Kelurahan --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label for="penyuluh_id">Penyuluh</label>
                                    <select name="penyuluh_id" id="penyuluh_id" class="custom-select shadow-sm mb-3"
                                        required>
                                        <option value="" disabled selected>-- Pilih Penyuluh --</option>
                                        @foreach ($penyuluh as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_penyuluh }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label for="petani">Petani</label>
                                    <select name="petani" id="petani"
                                        onchange="getPetani()"
                                        class="custom-select shadow-sm mb-3" required>
                                        <option value="" disabled selected>-- Pilih Petani --</option>
                                        <option value="Poktan">Poktan</option>
                                        <option value="Gapoktan">Gapoktan</option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label for="kelompok_id">Kelompok Petani</label>
                                    <select name="kelompok_id" id="kelompok_id" class="custom-select shadow-sm mb-3"
                                        required data-mode="create">
                                        <option value="">-- Pilih Kelompok --</option>

                                    </select>
                                </div>
                            </div>

                </div>
                {{-- <div class="row">
                            <div class="col-md">
                                <label for="penyuluh_id">Penyuluh</label>
                                <select name="penyuluh_id" id="penyuluh_id" class="custom-select shadow-sm mb-3" required>
                                    <option value="" disabled selected>-- Pilih Penyuluh --</option>
                                    @foreach ($penyuluh as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_penyuluh }}</option>
                                    @endforeach
                                </select> --}}
            </x-adminlte-card>

            <x-adminlte-card theme="secondary" theme-mode="outline" class="bg-light">
                <div class="row">
                    <div class="col-md">
                        <button type="button" onclick="addFotoColumn()" class="btn btn-sm btn-success mb-3"><i
                                class="fas fa-sm fa-plus mr-2"></i> Tambah Kolom Foto</button>
                    </div>
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
                                <input type="file" id="inputFile_1" name="foto[]" class="custom-file-input"
                                    onchange="changeLabelInputFile(this)" accept="image/*">
                                <label class="custom-file-label text-truncate" for="inputFile_1">
                                    Pilih File...
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </x-adminlte-card>
            <div class="row">
                <div class="col-md">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            </form>
        </div>
        </x-adminlte-card>
    </div>
    </div>

@endsection

@section('css')

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
