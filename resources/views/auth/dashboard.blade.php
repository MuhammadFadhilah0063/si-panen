@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1></h1>
@stop
<style>
    .ph--building-office {
        display: inline-block;
        width: 1em;
        height: 1em;
        --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 256 256'%3E%3Cpath fill='%23000' d='M248 208h-16V96a8 8 0 0 0 0-16h-48V48a8 8 0 0 0 0-16H40a8 8 0 0 0 0 16v160H24a8 8 0 0 0 0 16h224a8 8 0 0 0 0-16M216 96v112h-32V96ZM56 48h112v160h-24v-48a8 8 0 0 0-8-8H88a8 8 0 0 0-8 8v48H56Zm72 160H96v-40h32ZM72 80a8 8 0 0 1 8-8h16a8 8 0 0 1 0 16H80a8 8 0 0 1-8-8m48 0a8 8 0 0 1 8-8h16a8 8 0 0 1 0 16h-16a8 8 0 0 1-8-8m-48 40a8 8 0 0 1 8-8h16a8 8 0 0 1 0 16H80a8 8 0 0 1-8-8m48 0a8 8 0 0 1 8-8h16a8 8 0 0 1 0 16h-16a8 8 0 0 1-8-8'/%3E%3C/svg%3E");
        background-color: currentColor;
        -webkit-mask-image: var(--svg);
        mask-image: var(--svg);
        -webkit-mask-repeat: no-repeat;
        mask-repeat: no-repeat;
        -webkit-mask-size: 100% 100%;
        mask-size: 100% 100%;
    }

    .fluent--building-bank-24-filled {
        display: inline-block;
        width: 1em;
        height: 1em;
        --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M10.968 2.325a1.75 1.75 0 0 1 2.064 0l7.421 5.416c.977.712.474 2.257-.734 2.26H4.28c-1.208-.003-1.71-1.548-.734-2.26zM13 6.25a1 1 0 1 0-2 0a1 1 0 0 0 2 0M11.25 16h-2v-5h2zm3.5 0h-2v-5h2zm3.75 0h-2.25v-5h2.25zm.25 1H5.25A2.25 2.25 0 0 0 3 19.25v.5c0 .415.336.75.75.75h16.5a.75.75 0 0 0 .75-.75v-.5A2.25 2.25 0 0 0 18.75 17m-11-1H5.5v-5h2.25z'/%3E%3C/svg%3E");
        background-color: currentColor;
        -webkit-mask-image: var(--svg);
        mask-image: var(--svg);
        -webkit-mask-repeat: no-repeat;
        mask-repeat: no-repeat;
        -webkit-mask-size: 100% 100%;
        mask-size: 100% 100%;
    }

    .fluent--building-skyscraper-24-regular {
        display: inline-block;
        width: 1em;
        height: 1em;
        --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M12 11a1 1 0 1 1-2 0a1 1 0 0 1 2 0m-1 4a1 1 0 1 0 0-2a1 1 0 0 0 0 2m-2-4a1 1 0 1 1-2 0a1 1 0 0 1 2 0m-1 4a1 1 0 1 0 0-2a1 1 0 0 0 0 2m10 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0m-1 4a1 1 0 1 0 0-2a1 1 0 0 0 0 2M8.25 2.002a.75.75 0 0 0-.75.75V5H6.25a.75.75 0 0 0-.75.75V7.8A2.75 2.75 0 0 0 4 10.25v10.5c0 .415.336.75.75.75h15a.75.75 0 0 0 .75-.75v-5a5.75 5.75 0 0 0-5.51-5.745a2.75 2.75 0 0 0-1.487-2.203V5.75a.75.75 0 0 0-.75-.75H11.5V2.752a.75.75 0 0 0-.75-.75zM12.003 7.5H7v-1h5.003zM13.5 20H12v-2.75a.75.75 0 0 0-.75-.75h-3.5a.75.75 0 0 0-.75.75V20H5.5v-9.75C5.5 9.56 6.06 9 6.75 9h5.5c.69 0 1.25.56 1.25 1.25zm-5 0v-2h2v2zm6.5 0v-8.492a4.25 4.25 0 0 1 4 4.242V20zM10 5H9V3.502h1z'/%3E%3C/svg%3E");
        background-color: currentColor;
        -webkit-mask-image: var(--svg);
        mask-image: var(--svg);
        -webkit-mask-repeat: no-repeat;
        mask-repeat: no-repeat;
        -webkit-mask-size: 100% 100%;
        mask-size: 100% 100%;
    }

    .cil--library-building {
        display: inline-block;
        width: 1em;
        height: 1em;
        --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%23000' d='M247.759 14.358L16 125.946V184h480v-58.362ZM464 152H48v-5.946l200.241-96.412L464 146.362ZM16 496h480V392H16Zm32-72h416v40H48Zm24-216h32v160H72zm336 0h32v160h-32zm-224 0h32v160h-32zm112 0h32v160h-32z'/%3E%3C/svg%3E");
        background-color: currentColor;
        -webkit-mask-image: var(--svg);
        mask-image: var(--svg);
        -webkit-mask-repeat: no-repeat;
        mask-repeat: no-repeat;
        -webkit-mask-size: 100% 100%;
        mask-size: 100% 100%;
    }

    .fluent-emoji-high-contrast--classical-building {
        display: inline-block;
        width: 1em;
        height: 1em;
        --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Cpath fill='%23000' d='m28.773 10.17l-12.52-7.11a.542.542 0 0 0-.5 0l-12.52 7.11c-.22.13-.3.4-.17.62a.473.473 0 0 0 .497.21h.473v1.36c0 .35.28.63.63.63h.35v.19c0 .45.36.81.81.81H6v11.99h-.187c-.45 0-.81.36-.81.81v.18h-1.35c-.35 0-.63.28-.63.63v2.37h25.95V27.6c0-.35-.28-.63-.63-.63h-1.37v-.18c0-.45-.36-.81-.81-.81h-.19V13.99h.2c.45 0 .81-.36.81-.81v-.19h.38c.35 0 .63-.28.63-.63V11h.449a.53.53 0 0 0 .1.01c.16 0 .32-.08.4-.22c.13-.22.06-.5-.17-.62m-6.79 16.8h-.66v-.18c0-.45-.36-.81-.81-.81h-.2V13.99h.2c.45 0 .81-.36.81-.81v-.19h.67v.19c0 .45.36.81.81.81h.18v11.99h-.19c-.45 0-.81.36-.81.81zm-5.65 0h-.68v-.18c0-.45-.36-.81-.81-.81h-.19V13.99h.19c.45 0 .81-.36.81-.81v-.19h.68v.19c0 .45.36.81.81.81h.18v11.99h-.18c-.45 0-.81.36-.81.81zm-5.67 0h-.67v-.18c0-.45-.36-.81-.81-.81H9V13.99h.193c.45 0 .81-.36.81-.81v-.19h.66v.19c0 .45.36.81.81.81h.19v11.99h-.19c-.45 0-.81.36-.81.81zM6.106 10.99l9.897-5.577L25.9 10.99z'/%3E%3C/svg%3E");
        background-color: currentColor;
        -webkit-mask-image: var(--svg);
        mask-image: var(--svg);
        -webkit-mask-repeat: no-repeat;
        mask-repeat: no-repeat;
        -webkit-mask-size: 100% 100%;
        mask-size: 100% 100%;
    }
</style>
@section('content')

    <div class="container-fluid" style="max-height: 100vh; overflow-y: auto;">
        <div class="row">
            <div class="col-md text-center">
                <x-adminlte-callout theme="info">
                    <h3>Sistem Informasi Hasil Panen Petani Kota Banjarmasin</h3>
                </x-adminlte-callout>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <x-adminlte-card title="Total Hasil Panen Padi masing-masing daerah" theme="dark"
                    icon="fas fa-lg fa-seedling">
                    <div class="row">
                        <div class="col-md">
                            <x-adminlte-info-box title="{{ $data[0]['kecamatan'] }}" text="{{ $data[0]['total_produksi'] }} Ton"
                                icon="ph--building-office" icon-theme="purple" class="bg-light" />
                        </div>
                        <div class="col-md">
                            <x-adminlte-info-box title="{{ $data[1]['kecamatan'] }}" text="{{ $data[1]['total_produksi'] }} Ton"
                                icon="fluent--building-skyscraper-24-regular" icon-theme="yellow" class="bg-light" />
                        </div>
                        <div class="col-md">
                            <x-adminlte-info-box title="{{ $data[2]['kecamatan'] }}" text="{{ $data[2]['total_produksi'] }} Ton"
                                icon="cil--library-building" icon-theme="green" class="bg-light" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <x-adminlte-info-box title="{{ $data[3]['kecamatan'] }}" text="{{ $data[3]['total_produksi'] }} Ton"
                                icon="fluent--building-bank-24-filled" icon-theme="primary" class="bg-light" />
                        </div>
                        <div class="col-md">
                            <x-adminlte-info-box title="{{ $data[4]['kecamatan'] }}" text="{{ $data[4]['total_produksi'] }} Ton"
                                icon="fas fa-building" icon-theme="danger" class="bg-light" />
                        </div>
                    </div>
                </x-adminlte-card>
            </div>
        </div>
    
        {{-- Kecamatan Tertinggi --}}
        <div class="row">
            <div class="col-md">
                <x-adminlte-card title="Total Hasil Produksi Panen Padi Pada Kecamatan Tertinggi" theme="dark"
                    icon="fas fa-lg fa-seedling">
                    <div class="row">
                        <div class="col-md">
                            <x-adminlte-info-box title="{{ $produksiTertinggi->kecamatan->nama }}" text="{{ $produksiTertinggi->total_produksi }} Ton"
                                icon="fas fa-building" icon-theme="primary" class="bg-light" />
                        </div>
                    </div>
                </x-adminlte-card>
            </div>
        </div>

        {{-- Kecamatan Terendah --}}
        <div class="row">
            <div class="col-md">
                <x-adminlte-card title="Total Hasil Produksi Panen Padi Pada Kecamatan Terendah" theme="dark"
                    icon="fas fa-lg fa-seedling">
                    <div class="row">
                        <div class="col-md">
                            <x-adminlte-info-box title="{{ $produksiTerendah->kecamatan->nama }}" text="{{ $produksiTerendah->total_produksi }} Ton"
                                icon="fas fa-building" icon-theme="danger" class="bg-light" />
                        </div>
                    </div>
                </x-adminlte-card>
            </div>
        </div>

        {{-- Total Semua --}}
        <div class="row">
            <div class="col-md">
                <x-adminlte-card title="Total Hasil Produksi Panen Padi Semua Kecamatan" theme="dark"
                    icon="fas fa-lg fa-seedling">
                    <div class="row">
                        <div class="col-md">
                            <x-adminlte-info-box title="Semua Kecamatan" text="{{ $totalProduksi }} Ton"
                                icon="fas fa-building" icon-theme="success" class="bg-light" />
                        </div>
                    </div>
                </x-adminlte-card>
            </div>
        </div>
    </div>
@stop

@section('custom_css')
<style>
    .main-sidebar {
        padding-bottom: 100px;
    }
</style>
@stop

@section('js')

@stop
