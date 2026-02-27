@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard Customer</h2>

    {{-- ORDER TERBARU --}}
    <h4>5 Order Terbaru</h4>

    <ul>
        @forelse($orders as $order)
        <li>
            Invoice: {{ $order->invoice_number }} |
            Total: Rp {{ number_format($order->total_price) }}
        </li>
        @empty
        <li>Belum ada order.</li>
        @endforelse
    </ul>
</div>
@endsection