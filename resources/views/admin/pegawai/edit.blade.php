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

            <form action="{{ route('admin.pegawai.update', $data->id) }}" method="post">
                @csrf
                @method('PUT')

                {{-- form content --}}
                <x-adminlte-card title="" theme="primary" icon="fas fa-lg fa-plus">
                    <div class="container-fluid">
                        <x-adminlte-card theme="secondary" theme-mode="outline" class="bg-light">
                            <div class="row">
                                <div class="col-md">
                                    <label for="nama_pegawai">Nama Pegawai</label>
                                    <input type="text" name="nama_pegawai" id="nama_pegawai"
                                        class="form-control shadow-sm mb-3" placeholder="Nama Pegawai"
                                        value="{{ $data->nama_pegawai }}">
                                </div>
                                <div class="col-md">
                                    <label for="nip_pegawai">Nip Pegawai</label>
                                    <input type="number" name="nip_pegawai" id="nip_pegawai"
                                        class="form-control shadow-sm mb-3" placeholder="Nip Pegawai"
                                        value="{{ $data->nip_pegawai }}">
                                </div>
                                <div class="col-md">
                                    <label for="no_hp_pegawai">No Hp Pegawai</label>
                                    <input type="number" name="no_hp_pegawai" id="no_hp_pegawai"
                                        class="form-control shadow-sm mb-3" placeholder="Nip Pegawai"
                                        value="{{ $data->no_hp_pegawai }}">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label for="alamat_pegawai">Alamat Pegawai</label>
                                    <input type="text" name="alamat_pegawai" id="alamat_pegawai"
                                        class="form-control shadow-sm mb-3" placeholder="Kelompok Tani"
                                        value="{{ $data->alamat_pegawai }}">
                                </div>
                                <div class="col-md">
                                    <label for="jabatan_id">Jabatan</label>
                                    <select name="jabatan_id" id="jabatan_id" class="custom-select shadow-sm mb-3"
                                        onchange="getKelurahan(this)"
                                        data-url="{{ route('admin.getKelurahanByKecamatan') }}" required>
                                        <option value="" disabled selected>-- Pilih Jabatan --</option>
                                        @foreach ($jabatan as $item)
                                            <option value="{{ $item->id }}"
                                                @if ($item->id == $data->jabatan_id) selected @endif>{{ $item->nama_jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
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
