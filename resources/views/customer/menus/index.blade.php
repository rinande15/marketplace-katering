@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Menu Katering</h2>

    @foreach($menus as $menu)
    <div class="card mb-3 p-3">
        <h4>{{ $menu->name }}</h4>
        <p>{{ $menu->description }}</p>
        <p><strong>Rp {{ number_format($menu->price) }}</strong></p>

        @if($menu->photo)
        <img src="{{ asset('storage/'.$menu->photo) }}" width="150">
        @endif

        <hr>

        <form action="{{ route('customer.checkout', $menu->id) }}" method="POST">
            @csrf

            <div class="mb-2">
                <label>Jumlah</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Tanggal Pengiriman</label>
                <input type="date" name="delivery_date" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">
                Pesan Sekarang
            </button>
        </form>
    </div>
    @endforeach
</div>
@endsection