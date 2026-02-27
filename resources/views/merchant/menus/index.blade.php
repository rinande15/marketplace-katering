@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Menu</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('merchant.menus.create') }}" class="btn btn-primary mb-3">
        Tambah Menu
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr>
                <td>
                    @if($menu->photo)
                    <img src="{{ asset('storage/'.$menu->photo) }}" width="80">
                    @endif
                </td>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->description }}</td>
                <td>Rp {{ number_format($menu->price) }}</td>
                <td>
                    <a href="{{ route('merchant.menus.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('merchant.menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $menus->links() }}

    <a href="{{ route('merchant.dashboard') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection