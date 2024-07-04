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
                        action=""
                        method="post" enctype="multipart/form-data" id="formTambahPetani">
                        @csrf
                        <x-adminlte-card theme="secondary" theme-mode="outline" class="bg-light">
                            <div class="row">
                                <div class="col-md">
                                    <label for="petani">Petani</label>
                                    <select name="petani" id="petani" data-auth={{ Auth::user()->getRoleNames()[0] }} onchange="getTambahPetani(this)" class="custom-select shadow-sm mb-3" required>
                                        <option value="" disabled selected>-- Pilih Petani --</option>
                                        <option value="poktan">Poktan</option>
                                        <option value="gapoktan">Gapoktan</option>
                                    </select>
                                </div>
                                <div class="col-md" id="nama_petani">
                                    <label for="nama_petani">Nama Petani</label>
                                    <input type="text" name="nama_petani" id="nama_petani"
                                        class="form-control shadow-sm mb-3" placeholder="Nama Kelompok Gapoktan" required>
                                </div>
                            </div>
                            <div class="row" id="row_kedua">
                                <div class="col-md">
                                    <label for="luas_lahan_gapoktan">Luas Lahan Gapoktan</label>
                                    <input type="text" name="luas_lahan_gapoktan" id="luas_lahan_gapoktan"
                                        class="form-control shadow-sm mb-3" placeholder="Luas Lahan Gapoktan" required>
                                </div>
                                <div class="col-md">
                                    <label for="no_hp_gapoktan">No HP Gapoktan</label>
                                    <input type="number" name="no_hp_gapoktan" id="no_hp_gapoktan"
                                        class="form-control shadow-sm mb-3" placeholder="No HP Gapoktan" required>
                                </div>
                                <div class="col-md">
                                    <label for="alamat_gapoktan">Alamat Gapoktan</label>
                                    <input type="text" name="alamat_gapoktan" id="alamat_gapoktan"
                                        class="form-control shadow-sm mb-3" placeholder="Alamat Gapoktan" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label for="kecamatan_id">Kecamatan</label>
                                    <select name="kecamatan_id" id="kecamatan_id" onchange="getKelurahan(this)"
                                        data-url="{{ Auth::user()->hasRole('petani') ? route('petani.getKelurahanByKecamatan') : route('penyuluh.getKelurahanByKecamatan') }}"
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
