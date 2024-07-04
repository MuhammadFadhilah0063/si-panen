@extends('templates.dashboard-guest')

@section('title', $title ?? "Hasil Panen")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md my-3">
                <div class="h1">Hasil Panen</div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md mb-3">
                <div class="card rounded shadow-sm p-3">
                    <div class="card-body table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
      
        <!-- Modal 1 -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalToggleLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Hasil Panen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <h5>Luas Lahan</h5>
                            </div>
                            <div class="col text-end">
                                <h5 id="luasLahan"></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <h5>Kelompok Tani</h5>
                            </div>
                            <div class="col text-end">
                                <h5 id="kelompokTani"></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <h5>Alamat Ubinan</h5>
                            </div>
                            <div class="col text-end">
                                <h5 id="alamatUbinan"></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <h5>GKP</h5>
                            </div>
                            <div class="col text-end">
                                <h5 id="gkp"></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <h5>GKG</h5>
                            </div>
                            <div class="col text-end">
                                <h5 id="gkg"></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <h5>Hasil Produksi</h5>
                            </div>
                            <div class="col text-end">
                                <h5 id="hasilProduksi"></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <h5>Detail Hasil Produksi</h5>
                            </div>
                            <div class="col text-end">
                                <h5 id="detailHasilProduksi"></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <h5>URL Lokasi (Gmaps)</h5>
                            </div>
                            <div class="col text-end">
                                <h5><a href="" id="urlLokasi" class="btn btn-sm btn-primary" target="_blank">Lihat Lokasi</a></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <h5>Kecamatan</h5>
                            </div>
                            <div class="col text-end">
                                <h5 id="kecamatan"></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <h5>Kelurahan</h5>
                            </div>
                            <div class="col text-end">
                                <h5 id="kelurahan"></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <h5>Foto</h5>
                            </div>
                            <div class="col text-end">
                                <button type="button" data-bs-toggle='modal' data-bs-dismiss="modal" data-bs-target='#detaiFotolModal' class="btn btn-sm btn-success">Foto Hasil Panen</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="modal fade" id="detaiFotolModal" tabindex="-1" aria-labelledby="exampleModalToggleLabel2" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Hasil Panen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center" id="detailFotoModalBody">
                            <div class="col-12"><img src="{{ asset('img/hasil-panen/1701533716_myson2.jpeg') }}" alt="" class="img-fluid" width="50%"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-target="#detailModal" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection

@push('js')
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // datatable responsive
    </script>
    {{ $dataTable->scripts() }}
@endpush