@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-4">Dashboard Merchant</h2>

    {{-- Info Merchant --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h4 class="fw-bold mb-1">{{ $merchant->company_name }}</h4>
                    <p class="text-muted mb-1">
                        <i class="bi bi-geo-alt"></i> {{ $merchant->address }}
                    </p>
                    <p class="text-muted mb-1">
                        <i class="bi bi-telephone"></i> {{ $merchant->phone }}
                    </p>
                    <p class="mt-2">
                        {{ $merchant->description ?? 'Belum ada deskripsi.' }}
                    </p>
                </div>

                <div>
                    <a href="{{ route('merchant.profile.edit') }}"
                        class="btn btn-outline-warning btn-sm">
                        ✏ Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <h5 class="text-muted">Total Menu</h5>
                    <h2 class="fw-bold">{{ $menus->count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <h5 class="text-muted">Total Order</h5>
                    <h2 class="fw-bold">{{ $orders->count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Pengelolaan Menu --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Pengelolaan Menu</h4>
                <a href="{{ route('merchant.menus.create') }}"
                    class="btn btn-primary btn-sm">
                    + Tambah Menu
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $menu)
                        <tr>
                            <td>
                                @if($menu->photo)
                                <img src="{{ asset('storage/'.$menu->photo) }}"
                                    class="rounded"
                                    width="60">
                                @else
                                <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $menu->name }}</td>
                            <td>Rp {{ number_format($menu->price) }}</td>
                            <td>
                                <a href="{{ route('merchant.menus.edit', $menu->id) }}"
                                    class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('merchant.menus.destroy', $menu->id) }}"
                                    method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada menu.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Daftar Order --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-bold mb-3">Daftar Order</h4>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th width="100">Invoice</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>Rp {{ number_format($order->total_price) }}</td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $order->status ?? 'Pending' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('merchant.orders.show', $order->id) }}"
                                    class="btn btn-sm btn-info">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Belum ada order.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection