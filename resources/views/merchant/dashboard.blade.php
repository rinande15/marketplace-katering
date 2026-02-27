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
                    <h2 class="fw-bold">{{ $totalMenu }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Order</h6>
                    <h2 class="fw-bold">{{ $totalOrder }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Revenue</h6>
                    <h2 class="fw-bold">
                        Rp {{ number_format($totalRevenue) }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Pending Order</h6>
                    <h2 class="fw-bold text-warning">
                        {{ $pendingCount }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Pengelolaan Menu --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0">Menu</h4>
                <div>
                    <a href="{{ route('merchant.menus.create') }}"
                        class="btn btn-primary btn-sm">
                        + Tambah Menu
                    </a>

                    <a href="{{ route('merchant.menus.index') }}"
                        class="btn btn-outline-secondary btn-sm">
                        Lihat Semua
                    </a>
                </div>
            </div>

            <p class="text-muted">
                Total Menu: <strong>{{ $totalMenu }}</strong>
            </p>

            <h6 class="fw-bold mt-4 mb-3">🔥 5 Menu Terlaris</h6>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topMenus as $menu)
                        <tr>
                            <td>
                                @if($menu->photo)
                                <img src="{{ asset('storage/'.$menu->photo) }}"
                                    width="60"
                                    class="rounded">
                                @else
                                <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $menu->name }}</td>
                            <td>Rp {{ number_format($menu->price) }}</td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $menu->orders_count }}x
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada data penjualan.
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

            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Order Terbaru</h4>

                <a href="{{ route('merchant.orders.index') }}"
                    class="btn btn-outline-primary btn-sm">
                    Lihat Semua
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestOrders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>Rp {{ number_format($order->total_price) }}</td>
                            <td>
                                <span class="badge 
                                @if($order->status == 'pending') bg-warning
                                @elseif($order->status == 'completed') bg-success
                                @elseif($order->status == 'cancelled') bg-danger
                                @else bg-secondary
                                @endif">
                                    {{ $order->status ?? 'pending' }}
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