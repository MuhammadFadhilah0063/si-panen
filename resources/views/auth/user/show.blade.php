@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{ $title }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md">
            <x-adminlte-card title="" theme="primary" icon="fa fa-lg fa-user">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md">
                            <label>Name</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="name" value="{{ $user->name }}" readonly>
                        </div>
                        <div class="col-md">
                            <label>Username</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="username" value="{{ $user->username }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label>Email</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="email" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="col-md">
                            <label>No. Telepon</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="telp" value="{{ $user->telp }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label>Roles</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="roles" value="{{ $roles }}" readonly>
                        </div>
                        <div class="col-md">
                            <label>Status</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="status" value="{{ $user->status }}" readonly>
                        </div>
                    </div>
                </div>
            </x-adminlte-card>
            <a href="{{ route('admin.user-config.index') }}" class="btn btn-secondary mb-3">Kembali</a>
        </div>
    </div>
@endsection