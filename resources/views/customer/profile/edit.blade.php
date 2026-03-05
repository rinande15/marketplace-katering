@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile Customer</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('customer.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text"
                name="nama"
                class="form-control"
                maxlength="255"
                value="{{ old('nama', $customer->nama ?? '') }}"
                required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat"
                class="form-control"
                maxlength="500"
                required>{{ old('alamat', $customer->alamat ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Kontak</label>
            <input type="text"
                name="kontak"
                class="form-control"
                maxlength="20"
                value="{{ old('kontak', $customer->kontak ?? '') }}"
                required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi"
                class="form-control"
                maxlength="1000">{{ old('deskripsi', $customer->deskripsi ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            Update Profile
        </button>
        <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection