@extends('templates.dashboard-guest')

@section('title', $title ?? "Dashboard")


@section('content')
    <div class="container-fluid text-center mt-4">
        <div class="row d-flex justify-content-center" style="padding: 0 100px">
            <h1>{{$berita->judul_berita}}</h1>
            <small>{{ $berita->created_at->isoFormat('dddd, D MMMM YYYY HH:mm [WITA]') }}</small>
            <img style="width: 300px;height: 300px" src="{{ "../".$berita->foto }}" class="my-2 align-self-center object-fit-cover"/>
            <p class="text-start mt-4">
                {{$berita->isi_berita}}
            </p>
        </div>
    </div>
@endsection


