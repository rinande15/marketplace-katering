@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-4">Daftar Order</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">

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
    <a href="{{ route('merchant.dashboard') }}" class="btn btn-secondary">Kembali</a>

</div>
@endsection