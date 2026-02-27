@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Invoice {{ $order->invoice_number }}</h2>

    <hr>

    <p><strong>Merchant:</strong> {{ $order->merchant->name }}</p>
    <p><strong>Menu:</strong> {{ $order->menu->name }}</p>
    <p><strong>Harga Satuan:</strong> Rp {{ number_format($order->menu->price, 0, ',', '.') }}</p>
    <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
    <p><strong>Tanggal Kirim:</strong> {{ $order->delivery_date }}</p>

    <hr>

    <p><strong>Total:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

    <br>
    <a href="{{ route('customer.orders.index') }}">Kembali</a>
</div>
@endsection