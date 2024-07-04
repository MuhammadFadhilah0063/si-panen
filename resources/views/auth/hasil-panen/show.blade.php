@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{ $title }}</h1>
@endsection

@section('content')
@php
@endphp

    <div class="row">
        <div class="col-md">
            <x-adminlte-card title="" theme="primary" icon="fas fa-lg fa-plus">
                <div class="container-fluid">
                    <x-adminlte-card theme="secondary" theme-mode="outline" class="bg-light">
                        <div class="row">
                            <div class="col-md">
                                <label for="luas_lahan">Luas Lahan</label>
                                <input type="text" name="luas_lahan" id="luas_lahan" class="form-control shadow-sm mb-3" placeholder="Luas Lahan" value="{{ $data->luas_lahan }}" readonly>
                            </div>
                            <div class="col-md">
                                <label for="alamat_ubinan">Alamt Ubinan</label>
                                <input type="text" name="alamat_ubinan" id="alamat_ubinan" class="form-control shadow-sm mb-3" placeholder="Alamt Ubinan" value="{{ $data->alamat_ubinan }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label for="tgl_tanam">Tanggal Tanam</label>
                                <div class="input-group mb-3 shadow-sm">
                                    <input type="date" name="tgl_tanam" id="tgl_tanam" class="form-control" placeholder="Tanggal Tanam" aria-label="Tanggal Tanam" required aria-describedby="basic-addon2" value="{{$data->tgl_tanam}}" readonly>
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="tgl_panen">Tanggal Panen</label>
                                <div class="input-group mb-3 shadow-sm">
                                    <input type="date" name="tgl_panen" id="tgl_panen" class="form-control" placeholder="Tanggal Panen" aria-label="Tanggal Panen" required aria-describedby="basic-addon2" value="{{$data->tgl_panen}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label for="kelompok_tani">Kelompok Tani</label>
                                <input type="text" name="kelompok_tani" id="kelompok_tani" class="form-control shadow-sm mb-3" placeholder="Kelompok Tani" value="{{ $data->kelompok_tani }}" readonly>
                            </div>
                            <div class="col-md">
                                <label for="url_lokasi">URL Lokasi (Gmaps)</label>
                                <a href="https://{{ $data->url_lokasi }}" class="btn btn-success btn-block">Lihat Lokasi</a>
                                {{-- <input type="text" name="url_lokasi" id="url_lokasi" class="form-control shadow-sm mb-3" placeholder="URL Lokasi (Gmaps)" value="" readonly> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label for="gkp">GKP</label>
                                <div class="input-group mb-3 shadow-sm">
                                    <input type="number" name="gkp" id="gkp" class="form-control" placeholder="GKP" aria-label="GKP" required aria-describedby="basic-addon2" value="{{ $data->gkp }}" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Kg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="gkg">GKG</label>
                                <div class="input-group mb-3 shadow-sm">
                                    <input type="number" name="gkg" id="gkg" class="form-control" placeholder="GKG" aria-label="GKG" required aria-describedby="basic-addon2" value="{{ $data->gkg }}" readonly>
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
                                    <input type="number" name="hasil_produksi" id="hasil_produksi" class="form-control" placeholder="Hasil Produksi" aria-label="Hasil Produksi" aria-describedby="basic-addon2" value="{{ $data->hasil_produksi }}" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Ton</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="detail_hasil_produksi">Detail Hasil Produksi</label>
                                <input type="text" name="detail_hasil_produksi" id="detail_hasil_produksi" class="form-control shadow-sm mb-3" placeholder="Detail Hasil Produksi" value="{{ $data->detail_hasil_produksi }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label for="kecamatan_id">Kecamatan</label>
                                <input type="text" name="kecamatan_id" class="form-control shadow-sm mb-3" placeholder="Kecamatan" value="{{ $kecamatan->nama }}" readonly>
                            </div>
                            <div class="col-md">
                                <label for="kelurahan_id">Kelurahan</label>
                                <input type="text" name="kelurahan_id" class="form-control shadow-sm mb-3" placeholder="Kelurahan" value="{{ $kelurahan->nama }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">    
                                <label for="petani">Petani</label>
                                <input type="text" name="petani" class="form-control shadow-sm mb-3" placeholder="petani" value="{{ $data->petani }}" readonly>
                            </div>
                            <div class="col-md">    
                                <label for="kelompok">Kelompok Petani</label>
                                <input type="text" name="kelompok" class="form-control shadow-sm mb-3" placeholder="kelompok" value="{{ $kelompok_petani->nama_petani }}" readonly>
                            </div>
                        </div>
                    </x-adminlte-card>
                    
                    <x-adminlte-card theme="secondary" theme-mode="outline" class="bg-light">
                        <div class="row">
                            <div class="col-md">
                                <label for="foto">Foto</label>
                                <div class="row">
                                    @foreach ($data->foto_hasil as $item)
                                        <div class="col-md-6 text-center">
                                            <img src="{{ asset($item->nama) }}" alt="" class="img-fluid" style="height: 75%">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </x-adminlte-card>
                </div>
            </x-adminlte-card>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <a href="{{ $urlback }}" class="btn btn-secondary mb-3">Kembali</a>
        </div>
    </div>
  
@endsection

@section('css')

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection