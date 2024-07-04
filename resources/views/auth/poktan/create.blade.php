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
                        action="{{ Auth::user()->hasRole('penyuluh') ? route('penyuluh.poktan.store') : route('petani.poktan.store') }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <x-adminlte-card theme="secondary" theme-mode="outline" class="bg-light">
                            <div class="row">
                                <div class="col-md">
                                    <label for="nama_petani">Nama Petani</label>
                                    <input type="text" name="nama_petani" id="nama_petani"
                                        class="form-control shadow-sm mb-3" placeholder="Nama Petani" required>
                                </div>
                                <div class="col-md">
                                    <label for="luas_lahan_poktan">Luas Lahan Poktan</label>
                                    <input type="text" name="luas_lahan_poktan" id="luas_lahan_poktan"
                                        class="form-control shadow-sm mb-3" placeholder="Luas Lahan Poktan" required>
                                </div>
                                <div class="col-md">
                                    <label for="nik">NIK</label>
                                    <input type="text" name="nik" id="nik"
                                        class="form-control shadow-sm mb-3" placeholder="nik" required>
                                </div>
                                <div class="col-md">
                                    <label for="alamat_poktan">Alamat Poktan</label>
                                    <input type="text" name="alamat_poktan" id="alamat_poktan"
                                        class="form-control shadow-sm mb-3" placeholder="alamat_poktan" required>
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
                                    <label for="Nama">Kelompok</label>
                                    <select name="kelompok_id" id="kelompok_id" class="form-control mb-3" required>
                                        <option value="" disabled selected>-- Pilih Kelompok --</option>
                                        @foreach (\App\Models\Kelompok::all() as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kelompok }}</option>
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