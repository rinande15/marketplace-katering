@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Cari Katering</h2>

    <form method="GET" action="{{ route('customer.merchants.index') }}" class="mb-4">
        <div style="display:flex; gap:10px; align-items:center;">

            <input
                type="text"
                name="address"
                placeholder="Lokasi"
                value="{{ request('address') }}">

            <input
                type="text"
                name="name"
                placeholder="Nama Menu"
                value="{{ request('name') }}">

            <button type="submit">Cari</button>
            <a href="{{ route('customer.merchants.index') }}">Reset</a>

        </div>
    </form>

    <hr>

    @if($merchants->count() > 0)
    <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:20px;">
        @foreach($merchants as $merchant)
        <div style="border:1px solid #ddd; padding:15px; border-radius:8px;">
            <h4>{{ $merchant->name }}</h4>
            <p><strong>Lokasi:</strong> {{ request('address') }}</p>
            <p><strong>Menu:</strong> {{ request('name') }}</p>

            <a href="{{ route('customer.merchants.show', $merchant->id) }}">
                Lihat Detail
            </a>
        </div>
        @endforeach
    </div>

    <div style="margin-top:20px;">
        {{ $merchants->links() }}
    </div>

    @else
    <p>Tidak ada katering ditemukan.</p>
    @endif

</div>
@endsection