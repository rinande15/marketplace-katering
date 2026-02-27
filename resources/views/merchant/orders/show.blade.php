@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-4">Invoice Order #{{ $order->id }}</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>

            <hr>

            <table class="table">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->menu->name }}</td>
                        <td>Rp {{ number_format($item->price) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price * $item->quantity) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h4 class="text-end">
                Total: Rp {{ number_format($order->total_price) }}
            </h4>

        </div>
    </div>

</div>
@endsection