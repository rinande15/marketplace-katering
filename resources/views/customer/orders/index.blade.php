@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Invoice Saya</h2>

    @if($orders->count())
    <table border="1" width="100%" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Invoice</th>
                <th>Merchant</th>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal Kirim</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->invoice_number }}</td>
                <td>{{ $order->merchant->name }}</td>
                <td>{{ $order->menu->name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>{{ $order->delivery_date }}</td>
                <td>
                    <a href="{{ route('customer.orders.show', $order->id) }}">
                        Lihat Detail
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    {{ $orders->links() }}

    @else
    <p>Belum ada invoice.</p>
    @endif
</div>
@endsection