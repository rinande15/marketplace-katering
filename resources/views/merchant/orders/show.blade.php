@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pesanan</h2>

    <div class="card p-4">
        <h4>Invoice: {{ $order->invoice_number }}</h4>
        <hr>

        <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
        <p><strong>Tanggal Kirim:</strong> {{ $order->delivery_date }}</p>

        <hr>

        <h5>Detail Menu</h5>
        <p><strong>Menu:</strong> {{ $order->menu->name }}</p>
        <p><strong>Harga:</strong> Rp {{ number_format($order->menu->price) }}</p>
        <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>

        <hr>

        <h4>Total: Rp {{ number_format($order->total_price) }}</h4>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    </div>
</div>
@endsection