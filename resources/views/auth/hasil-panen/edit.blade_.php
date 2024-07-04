@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{ $title }}</h1>
@endsection

@section('content')
    
    @if (session('success'))
        <div class="row mt-3">
            <div class="col-md">
                <x-adminlte-alert theme="success" title="Success" dismissable>
                    {{ session('success') }}
                </x-adminlte-alert>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md">

            <form action="{{ route('admin.hasil-panen.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- form content --}}
                <x-adminlte-card title="" theme="primary" icon="fas fa-lg fa-plus">
                    <div class="container-fluid">
                        <x-adminlte-card theme="secondary" theme-mode="outline" class="bg-light">
                            @if (auth()->user()->roles == 'admin')
                                <div class="row">
                                    <div class="col-md">
                                        <label for="luas_lahan">Luas Lahan</label>
                                        <input type="text" name="luas_lahan" id="luas_lahan" class="form-control shadow-sm mb-3" placeholder="Luas Lahan" value="{{ $data->luas_lahan }}">
                                    </div>
                                    <div class="col-md">
                                        <label for="alamat_ubinan">Alamt Ubinan</label>
                                        <input type="text" name="alamat_ubinan" id="alamat_ubinan" class="form-control shadow-sm mb-3" placeholder="Alamt Ubinan" value="{{ $data->alamat_ubinan }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <label for="kelompok_tani">Kelompok Tani</label>
                                        <input type="text" name="kelompok_tani" id="kelompok_tani" class="form-control shadow-sm mb-3" placeholder="Kelompok Tani" value="{{ $data->kelompok_tani }}">
                                    </div>
                                    <div class="col-md">
                                        <label for="url_lokasi">URL Lokasi (Gmaps)</label>
                                        <input type="text" name="url_lokasi" id="url_lokasi" class="form-control shadow-sm mb-3" placeholder="URL Lokasi (Gmaps)" value="{{ $data->url_lokasi }}">
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md">
                                        <label for="luas_lahan">Luas Lahan</label>
                                        <input type="text" name="luas_lahan" id="luas_lahan" class="form-control shadow-sm mb-3" placeholder="Luas Lahan" value="{{ $data->luas_lahan }}">
                                    </div>
                                    <div class="col-md">
                                        <label for="alamat_ubinan">Alamt Ubinan</label>
                                        <input type="text" name="alamat_ubinan" id="alamat_ubinan" class="form-control shadow-sm mb-3" placeholder="Alamt Ubinan" value="{{ $data->alamat_ubinan }}">
                                    </div>
                                    <div class="col-md">
                                        <label for="kelompok_tani">Kelompok Tani</label>
                                        <input type="text" name="kelompok_tani" id="kelompok_tani" class="form-control shadow-sm mb-3" placeholder="Kelompok Tani" value="{{ $data->kelompok_tani }}">
                                    </div>
                                </div>
                            @endif
                            
                            <div class="row">
                                <div class="col-md">
                                    <label for="gkp">GKP</label>
                                    <div class="input-group mb-3 shadow-sm">
                                        <input type="number" name="gkp" id="gkp" class="form-control" placeholder="GKP" aria-label="GKP" required aria-describedby="basic-addon2" value="{{ $data->gkp }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="gkg">GKG</label>
                                    <div class="input-group mb-3 shadow-sm">
                                        <input type="number" name="gkg" id="gkg" class="form-control" placeholder="GKG" aria-label="GKG" required aria-describedby="basic-addon2" value="{{ $data->gkg }}">
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
                                        <input type="number" name="hasil_produksi" id="hasil_produksi" class="form-control" placeholder="Hasil Produksi" aria-label="Hasil Produksi" aria-describedby="basic-addon2" value="{{ $data->hasil_produksi }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Ton</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="detail_hasil_produksi">Detail Hasil Produksi</label>
                                    <input type="text" name="detail_hasil_produksi" id="detail_hasil_produksi" class="form-control shadow-sm mb-3" placeholder="Detail Hasil Produksi" required value="{{ $data->detail_hasil_produksi }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label for="kecamatan_id">Kecamatan</label>
                                    <select name="kecamatan_id" id="kecamatan_id" class="custom-select shadow-sm mb-3" onchange="getKelurahan(this)" data-url="{{ route('admin.getKelurahanByKecamatan') }}" required>
                                        <option value="" disabled selected>-- Pilih Kecamatan --</option>
                                        @foreach ($kecamatan as $item)
                                            <option value="{{ $item->id }}" @if($item->id == $data->kecamatan_id) selected @endif>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label for="kelurahan_id">Kelurahan</label>
                                    <select name="kelurahan_id" id="kelurahan_id" class="custom-select shadow-sm mb-3" required>
                                        <option value="" disabled>-- Pilih Kelurahan --</option>
                                        @foreach ($kelurahan as $item)
                                            <option value="{{ $item->id }}" @if($item->id == $data->kelurahan_id) selected @endif>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </x-adminlte-card>
                        
                        <x-adminlte-card theme="secondary" theme-mode="outline" class="bg-light">
                            <div class="row">
                                <div class="col-md">
                                    <button type="button" onclick="addFotoColumn()" class="btn btn-sm btn-success mb-3"><i class="fas fa-sm fa-plus mr-2"></i> Tambah Kolom Foto</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label class="mb-0">Masukkan Foto</label>
                                    <br>
                                    <label class="text-muted mb-3">Centang jika ingin menghapus foto atau klik tombol untuk menambahkan foto</label>
                                    @if (count($data->foto_hasil) > 0)
                                        @foreach ($data->foto_hasil as $item)
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="input-group mb-3" id="fotoColumn">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-danger">
                                                                <input type="checkbox" name="file_checked[{{ $item->id }}]">
                                                            </div>
                                                        </div>
                                                        <input type="text" id="{{ 'inputFile_' . $loop->iteration }}" name="foto[]" class="form-control" value="{{ substr($item->nama, 27)  }}" disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text bg-danger"><i class="fas fa-trash"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <button type="button" class="btn btn-block btn-primary mb-3" data-image="{{ asset($item->nama) }}" data-toggle="modal" data-target="#imageModal" onclick="showImageInModal(this)">Lihat Foto</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="input-group mb-3" id="fotoColumn">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-lightblue">
                                                            <i class="fas fa-upload"></i>
                                                        </div>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" id="inputFile_1" name="foto[]" class="custom-file-input" onchange="changeLabelInputFile(this)" accept="image/*">
                                                        <label class="custom-file-label text-truncate" for="inputFile_1">
                                                            Pilih File...
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </x-adminlte-card>
                    </div>
                </x-adminlte-card>

                {{-- submit button --}}
                <div class="row">
                    <div class="col-md">
                        <a href="{{ $urlback }}" class="btn btn-secondary mb-3">Kembali</a>
                        <button type="submit" class="btn btn-warning mb-3">Simpan Perubahan</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
  
    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <img alt="" class="img-fluid" id="imageModalContent">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection

@section('css')

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection