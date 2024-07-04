@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>Export Data</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <x-adminlte-card theme="lime" theme-mode="outline">
                    @php
                        $role = auth()->user()->getRoleNames();
                    @endphp
                    <form id="exportForm" action="{{ route($role[0] . '.export.export') }}" method="post">
                        @csrf
                        <div class="row my-3">
                            <div class="col-md-2">
                                <label for="">Pilih Data untuk di export</label>
                            </div>
                            <div class="col-md">
                                <select name="pilih_bulan" id="pilih_bulan" class="custom-select shadow-sm mb-3">
                                    <option disabled selected>Pilih Bulan Export</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <select name="pilih_tahun" id="pilih_tahun" class="custom-select shadow-sm mb-3">
                                    <option disabled selected>Pilih Tahun Export</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                </select>
                                <select name="pilih_export" id="pilih_export" class="custom-select shadow-sm">
                                    <option value="Seluruh Daerah">Seluruh Daerah</option>
                                    <option value="Banjarmasin Tengah">Banjarmasin Tengah</option>
                                    <option value="Banjarmasin Selatan">Banjarmasin Selatan</option>
                                    <option value="Banjarmasin Utara">Banjarmasin Utara</option>
                                    <option value="Banjarmasin Barat">Banjarmasin Barat</option>
                                    <option value="Banjarmasin Timur">Banjarmasin Timur</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <button type="button" id="cariButton" class="btn btn-success shadow-sm">Cari </button> 
                                <button type="submit" id="exportButton" class="btn btn-export btn-success shadow-sm" disabled>Export</button>
                            </div>
                        </div>
                    </form>
                    
                </x-adminlte-card>
            </div>
        </div>

        <div class="row card-table d-none">
            <div class="col-md">
                <div class="card card-lime card-outline">
                    <div class="card-body">
                        <table id="tablePanen" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center" style="font-size: 14.5px;">Luas Lahan</th>
                                    <th class="text-center" style="font-size: 14.5px;">Kelompok Tani</th>
                                    <th class="text-center" style="font-size: 14.5px;">Petani</th>
                                    <th class="text-center" style="font-size: 14.5px;">Alamat Ubinan</th>
                                    <th class="text-center" style="font-size: 14.5px;">GKP</th>
                                    <th class="text-center" style="font-size: 14.5px;">GKG</th>
                                    <th class="text-center" style="font-size: 14.5px;">Status Verifikasi</th>
                                    <th class="text-center" style="font-size: 14.5px;">Hasil Produksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-10 text-ket">
                                Jumlah total semua hasil produksi panen
                            </div>
                            <div class="col text-right font-weight-bold text-total">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script>
$(document).ready(function() {

$('#cariButton').click(function(e) {
    e.preventDefault();

    var bulan = $('#pilih_bulan').val();
    var tahun = $('#pilih_tahun').val();
    var daerah = $('#pilih_export').val();

    if (!bulan || !tahun || !daerah) {
        alert('Semua kolom harus diisi!');
        return;
    }

    $.ajax({
        url: window.location.href + '/get-data',
        type: 'POST', // Metode HTTP POST
        data: {
            pilih_bulan: bulan,
            pilih_tahun: tahun,
            pilih_export: daerah,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {

            $('.card-table').removeClass('d-none');
            $('#exportButton').removeAttr('disabled');

            var list = response.data_panen.data;
            var template = '';
            var totalPanen = 0;

            if ($.fn.DataTable.isDataTable("#tablePanen")) {
                $('#tablePanen').DataTable().clear().destroy();
            }

            for (let index = 0; index < list.length; index++) {
                const data = list[index];

                totalPanen += Number(data.hasil_produksi);

                template += `
                    <tr>
                        <td class="text-center" style="font-size: 14px;">${data.luas_lahan}</td>
                        <td class="text-center" style="font-size: 14px;">${data.kelompok_tani}</td>
                        <td class="text-center" style="font-size: 14px;">${data.petani}</td>
                        <td class="text-center" style="font-size: 14px;">${data.alamat_ubinan}</td>
                        <td class="text-center" style="font-size: 14px;">${data.gkp} Kg</td>
                        <td class="text-center" style="font-size: 14px;">${data.gkg} Kg</td>
                        <td class="text-center" style="font-size: 14px;">${data.is_verified}</td>
                        <td class="text-center" style="font-size: 14px;">${data.hasil_produksi} Ton</td>
                    </tr>
                `;
            }

            var textKet = (response.data_panen.kecamatan == "seluruh daerah") ? `Jumlah total semua hasil produksi panen pada seluruh daerah dari bulan ${response.data_panen.bulan} tahun ${response.data_panen.tahun}` : `Jumlah total semua hasil produksi panen pada kecamatan ${response.data_panen.kecamatan} dari bulan ${response.data_panen.bulan} tahun ${response.data_panen.tahun}`;

            $('tbody').empty();
            $('tbody').append(template);
            $('.text-ket').empty();
            $('.text-ket').html(textKet);
            $('.text-total').empty();
            $('.text-total').html(totalPanen.toFixed(2) + " Ton");

            $("#tablePanen").DataTable();
        },
        error: function(xhr) {
            // Logika error handling
            alert('Terjadi kesalahan saat mengekspor data.');
        }
    });
});

});
</script>
@stop