@extends('templates.dashboard-guest')

@section('title', $title ?? 'Profil')

@section('content')
    <div class="container my-4">
        <h2>Profil Dinas</h2>
        <ul class="nav nav-tabs mt-5">
            <li class="nav-item">
                <a class="nav-link text-dark active" aria-current="page" href="#profil-dinas"
                    onclick="showTab(event, 'profil-dinas')">Profil Dinas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#visi-misi" onclick="showTab(event, 'visi-misi')">Visi dan Misi</a>
            </li>
        </ul>

        {{-- Profil dinas --}}
        <div id="profil-dinas" class="tab-content">
            <img class="mt-4 w-100" src="{{ asset('img/profilee.jpg') }}" alt="Profile">
            <h4 class="mt-4">Tugas Pokok</h4>
            <p>Melaksanakan sebagian tugas Dinas Ketahanan Pangan Pertanian dan Perikanan dibidang Perikanan</p>

            <h4>Fungsi</h4>
            <ol>
                <li>Perumusan kebijakan teknis dalam bidang pangan pertanian dan perikanan sesuai dengan kebijakan umum yang
                    ditetapkan oleh Walikota.</li>
                <li>Penyelenggaraan urusan pemerintahan dan pelayanan umum di bidang pangan pertanian dan perikanan</li>
                <li>Perumusan dan penetapan kebijakan operasional pembinaan pengaturan pengendalian dan evaluasi terhadap
                    hal-hal yang berkaitan dengan perikanan</li>
            </ol>

            <h4>Tujuan</h4>
            <p>Tujuan yang hendak dicapai Dinas Kependudukan dan Pencatatan Sipil Yang <br> telah menyelaraskan apa yang
                harus dilaksanakan sesuai dengan sumber daya <br> dan kemampuan yang dimiliki serta kebijakan yang diambil.
            </p>
        </div>

        {{-- Visi dan Misi --}}
        <div id="visi-misi" class="tab-content" style="display: none;">
            <h4 class="mt-4">Visi</h4>
            <p>Terwujudnya ketahanan pangan, pertanian dan perikanan yang berkelanjutan, mandiri dan berdaya saing.</p>

            <h4>Misi</h4>
            <ol>
                <li>Meningkatkan produksi pangan, pertanian dan perikanan yang berkelanjutan, mandiri dan berdaya saing.
                </li>
                <li>Meningkatkan kualitas pangan, pertanian dan perikanan yang berkelanjutan, mandiri dan berdaya saing.
                </li>
                <li>Meningkatkan pelayanan pangan, pertanian dan perikanan yang berkelanjutan, mandiri dan berdaya saing.
                </li>
            </ol>
        </div>
    </div>
@endsection
