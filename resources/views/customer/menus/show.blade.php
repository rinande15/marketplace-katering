<form action="{{ route('customer.orders.store', $menu->id) }}" method="POST">
    @csrf

    <label>Jumlah Porsi</label>
    <input type="number" name="quantity" min="1" required>

    <label>Tanggal Pengiriman</label>
    <input type="date" name="delivery_date" required>

    <button type="submit">Pesan</button>
</form>