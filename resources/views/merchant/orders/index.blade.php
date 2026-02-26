@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pesanan Masuk</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Invoice</th>
                <th>Customer</th>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->invoice_number }}</td>
                <td>{{ $order->customer->name }}</td>
                <td>{{ $order->menu->name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>Rp {{ number_format($order->total_price) }}</td>
                <td>
                    <span class="badge bg-info">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('merchant.orders.show', $order->id) }}" class="btn btn-primary btn-sm">
                        Detail
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection