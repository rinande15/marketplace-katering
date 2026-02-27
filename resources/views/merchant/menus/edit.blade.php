@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Menu</h2>

    <form action="{{ route('merchant.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" name="name" class="form-control" value="{{ $menu->name }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" required>{{ $menu->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="price" class="form-control" value="{{ $menu->price }}" required>
        </div>

        <div class="mb-3">
            <label>Foto Sekarang</label><br>
            @if($menu->photo)
            <img src="{{ asset('storage/'.$menu->photo) }}" width="120">
            @endif
        </div>

        <div class="mb-3">
            <label>Ganti Foto</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('merchant.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection