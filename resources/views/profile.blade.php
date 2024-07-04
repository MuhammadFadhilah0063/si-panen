@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h3>Profile</h3>
@endsection

@section('content')

    @if (session('success'))
        <div class="row">
            <div class="col-md">
                <x-adminlte-alert theme="success" title="Success" dismissable>
                    {{ session('success') }}
                </x-adminlte-alert>
            </div>
        </div>
    @endif
    @if (session('errors'))
        <div class="row">
            <div class="col-md">
                <x-adminlte-alert theme="danger" title="Success" dismissable>
                    {{ $errors->first() }}
                </x-adminlte-alert>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <x-adminlte-card theme="primary" icon="fas fa-user">
                <div class="row">
                    <div class="col-md">
                        <x-adminlte-profile-widget name="{{ auth()->user()->name }}"
                            desc="{{ auth()->user()->roles->implode('name', ', ') }}" theme="primary"
                            img="{{ '../' . auth()->user()->foto }}">
                            <x-adminlte-profile-col-item title="No. Telepon" text="{{ auth()->user()->telp }}"
                                size="12" />
                            <div class="col-12">
                                <div class="description-block">
                                    <h5 class="description-header">Email</h5>
                                    <p class="description-text" style="text-transform:lowercase"><span
                                            class="">{{ auth()->user()->email }}</span></p>
                                </div>
                            </div>
                        </x-adminlte-profile-widget>
                    </div>
                </div>
            </x-adminlte-card>
        </div>
        <div class="col-md">
            <x-adminlte-card theme="yellow" icon="fas fa-user" title="Edit">
                <div class="row">
                    <div class="col-md">
                        @php
                            $action = '';
                            if (auth()->user()->hasRole('admin')) {
                                $action = 'admin';
                            } elseif (auth()->user()->hasRole('penyuluh')) {
                                $action = 'penyuluh';
                            } elseif (auth()->user()->hasRole('kabid')) {
                                $action = 'kabid';
                            } elseif (auth()->user()->hasRole('petani')) {
                                $action = 'petani';
                            }

                        @endphp
                        <form action="{{ route($action . '.profile.update', auth()->user()->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <label for="">Ganti Foto</label>
                            <div class="input-group mb-3" id="fotoColumn">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-lightblue">
                                        <i class="fas fa-upload"></i>
                                    </div>
                                </div>
                                <div class="custom-file">
                                    <input type="file" id="inputFile_1" name="foto" class="custom-file-input"
                                        onchange="changeLabelInputFile(this)" accept="image/*">
                                    <label class="custom-file-label text-truncate" for="inputFile_1">
                                        Pilih File...
                                    </label>
                                </div>
                            </div>
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control shadow-sm mb-3"
                                value="{{ auth()->user()->username }}">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control shadow-sm mb-3"
                                value="{{ auth()->user()->name }}">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control shadow-sm mb-3"
                                value="{{ auth()->user()->email }}">
                            <label for="telp">No. Telepon</label>
                            <input type="number" name="telp" id="telp" class="form-control shadow-sm mb-3"
                                value="{{ auth()->user()->telp }}">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control shadow-sm mb-3">
                            <label for="password2">Ketik Ulang Password</label>
                            <input type="password" name="password2" id="password2" class="form-control shadow-sm mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </x-adminlte-card>
        </div>
    </div>
@endsection

@section('contentasdasd')
    <div class="row">
        <div class="col-md">
            <x-adminlte-card theme="dark" icon="fas fa-lg fa-user">
                <section style="background-color: #f4f5f7;">
                    <div class="container">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col col-lg-6 mb-4 mb-lg-0">
                                <div class="card mb-3" style="border-radius: .5rem;">
                                    <div class="row g-0">
                                        <div class="col-md-4 gradient-custom text-center text-white"
                                            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                            <img src="img/user-solid.svg" alt="Avatar" class="img-fluid my-5"
                                                style="width: 80px;" />
                                            <h5>{{ auth()->user()->name }}</h5>
                                            <p>{{ auth()->user()->nama_jabatan }}</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body p-4">
                                                <h6>Informasi</h6>
                                                <hr class="mt-0 mb-4">
                                                <div class="row pt-1">
                                                    <div class="col-6 mb-3">
                                                        <h6>Username</h6>
                                                        <p class="text-muted">{{ auth()->user()->username }}</p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6>Email</h6>
                                                        <p class="text-muted">{{ auth()->user()->email }}</p>
                                                    </div>
                                                </div>
                                                <div class="row pt-1">
                                                    <div class="col-6 mb-3">
                                                        <h6>Roles</h6>
                                                        <p class="text-muted">{{ auth()->user()->roles }}</p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6>No. Telpon</h6>
                                                        <p class="text-muted">{{ auth()->user()->telp }}</p>
                                                    </div>
                                                </div>
                                                {{-- <h6>Projects</h6>
                                                <hr class="mt-0 mb-4">
                                                <div class="row pt-1">
                                                    <div class="col-6 mb-3">
                                                        <h6>Recent</h6>
                                                        <p class="text-muted">Lorem ipsum</p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6>Most Viewed</h6>
                                                        <p class="text-muted">Dolor sit amet</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-start">
                                                    <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                                    <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                                    <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </x-adminlte-card>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #f6d365;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }
    </style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
