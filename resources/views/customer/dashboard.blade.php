<div class="container">

    <h2>Dashboard Customer</h2>

    <div class="row">

        <div class="col-md-4">
            <div class="card p-4">
                <h5>Pesanan Aktif</h5>
                <h2>{{ $activeOrders }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4">
                <h5>Riwayat Order</h5>
                <h2>{{ $totalOrders }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4">
                <h5>Total Pengeluaran</h5>
                <h2>Rp {{ number_format($totalSpent) }}</h2>
            </div>
        </div>

    </div>

</div>