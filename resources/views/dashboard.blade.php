@extends('templates.dashboard-guest')

@section('title', $title ?? 'Dashboard')

@push('css')
    <style>
        .bg-hero {
            background-image: url("{{ asset('img/hero2.jpeg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: brightness(0.5);
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;

        }

        .row {
            margin: 0;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid text-center">
        <div class="row">
            <div class="row bg-hero">
            </div>
            <div class="row" style="position: relative; color: white;">
                <div class="col-md-12 py-3">
                    <h1>Selamat datang di SI Pelaporan Hasil Produksi Panen Padi</h1>
                </div>
                <div class="col-md-12 py-3">
                    <img src="{{ asset('img/logo dkp.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-md-12-8">
                    <h5>Sistem informasi ini digunakan untuk memonitoring hasil produksi panen padi yang ada di wilayah kota
                        Banjarmasin.</h5>
                </div>
            </div>
        </div>
    </div>
        <div class="row d-flex" style="margin: 250px 0">
            <h1>Berita</h1>

            <div class="row row-cols-1 row-cols-md-3 g-4" style="padding: 0 50px">
                @foreach ($beritas as $berita)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $berita->judul_berita }}</h5>
                                <img src="{{ $berita->foto }}" class="my-2 object-fit-cover" height="200px">
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($berita->isi_berita, 60) }}</p>
                                <small class="text-muted d-block">{{ $berita->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('berita.show', $berita->slug) }}" class="btn btn-primary">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endsection
