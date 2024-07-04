@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{ $title }}</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="row">
            <div class="col-md">
                <x-adminlte-alert theme="success" title="Sukses">
                    {{ session('success') }}
                </x-adminlte-alert>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md">
            <x-adminlte-card title="" theme="primary" icon="fa fa-lg fa-user">
                <form action="{{ route('admin.user-config.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md">
                                <label>Name</label>
                                <input type="text" class="form-control shadow-sm mb-3" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="col-md">
                                <label>Username</label>
                                <input type="text" class="form-control shadow-sm mb-3" name="username" value="{{ $user->username }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label>Email</label>
                                <input type="email" class="form-control shadow-sm mb-3" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="col-md">
                                <label>No. Telepon</label>
                                <input type="text" class="form-control shadow-sm mb-3" name="telp" value="{{ $user->telp }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label>Roles</label>
                                <select name="roles" id="" class="custom-select shadow-sm mb-3">
                                    <option value="admin" {{ $roles == "admin" ? "selected" : '' }}>Admin</option>
                                    <option value="penyuluh" {{ $roles == "penyuluh" ? "selected" : '' }}>Penyuluh</option>
                                    <option value="petani" {{ $roles == "petani" ? "selected" : '' }}>Petani</option>
                                    <option value="kabid" {{ $roles == "kabid" ? "selected" : '' }}>Kabid</option>
                                </select>
                            </div>
                            <div class="col-md">
                                <label>Status</label>
                                <select name="status" id="" class="custom-select shadow-sm mb-3">
                                    <option value="Aktif" {{ $user->status == "Aktif" ? "selected" : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ $user->status == "Tidak Aktif" ? "selected" : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <hr style="border: 1px solid rgb(105, 105, 105)">
                        <div class="row">
                            <div class="col-md">
                                <h5><b>Ganti Password</b></h5>
                                <p class="text-muted">Masukkan Password jika ingin mengganti Password</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label>Password</label>
                                <input type="password" class="form-control shadow-sm mb-3" name="password" placeholder="Password">
                            </div>
                            <div class="col-md">
                                <label>Ketik Ulang Password</label>
                                <input type="password" class="form-control shadow-sm mb-3" name="password_2" placeholder="Password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <button type="submit" class="btn btn-sm btn-success my-2">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </x-adminlte-card>
            <a href="{{ route('admin.user-config.index') }}" class="btn btn-secondary mb-3">Kembali</a>
        </div>
    </div>
@endsection