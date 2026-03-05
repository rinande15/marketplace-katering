@extends('layouts.app')

@section('content')

<div class="flex h-screen bg-gray-100">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white shadow-lg flex flex-col">

        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-indigo-600">
                🍱 Katering Admin
            </h2>
        </div>

        <nav class="flex-1 p-4 space-y-2 text-sm">

            <a href="/merchant/dashboard" class="block px-4 py-2 rounded-lg bg-indigo-100 text-indigo-600">
                📊 Dashboard
            </a>

            <a href="/merchant/menus" class="block px-4 py-2 rounded-lg hover:bg-gray-100">
                🍱 Menu
            </a>

            <a href="/merchant/orders" class="block px-4 py-2 rounded-lg hover:bg-gray-100">
                📦 Orders
            </a>

            <a href="/merchant/transaksi" class="block px-4 py-2 rounded-lg hover:bg-gray-100">
                💳 Transaksi
            </a>

            <a href="/merchant/laporan" class="block px-4 py-2 rounded-lg hover:bg-gray-100">
                📑 Laporan
            </a>

        </nav>

    </aside>


    <!-- CONTENT -->
    <main class="flex-1 overflow-y-auto p-8">

        <!-- TOPBAR -->
        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Dashboard Merchant
                </h1>

                <p class="text-gray-500">
                    Pantau performa katering kamu
                </p>
            </div>

            <div class="flex items-center gap-4">

                <div id="notification" class="hidden bg-green-100 text-green-800 px-4 py-2 rounded-lg">
                    🔔 Order baru masuk!
                </div>

                <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">

            </div>

        </div>


        <!-- STAT -->
        <div class="grid md:grid-cols-4 gap-6 mb-10">

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Total Order</p>
                <h2 class="text-3xl font-bold text-indigo-600">
                    120
                </h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Revenue</p>
                <h2 class="text-3xl font-bold text-green-600">
                    Rp 12.500.000
                </h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Menu Aktif</p>
                <h2 class="text-3xl font-bold">
                    25
                </h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Rating</p>
                <h2 class="text-3xl font-bold text-yellow-500">
                    ⭐ 4.8
                </h2>
            </div>

        </div>


        <!-- CHART -->
        <div class="grid md:grid-cols-2 gap-6 mb-10">

            <div class="bg-white p-6 rounded-xl shadow">

                <h3 class="font-semibold mb-4 text-gray-700">
                    Revenue Mingguan
                </h3>

                <canvas id="revenueChart"></canvas>

            </div>


            <div class="bg-white p-6 rounded-xl shadow">

                <h3 class="font-semibold mb-4 text-gray-700">
                    Order Statistik
                </h3>

                <canvas id="orderChart"></canvas>

            </div>

        </div>


        <!-- MENU -->
        <div class="bg-white p-6 rounded-xl shadow mb-10">

            <div class="flex justify-between mb-4">

                <h3 class="font-semibold text-lg">
                    Menu Management
                </h3>

                <a href="/merchant/menus/create"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
                    + Tambah Menu
                </a>

            </div>

            <table class="w-full text-sm">

                <thead>
                    <tr class="border-b text-left">
                        <th class="py-2">Menu</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="border-b">
                        <td class="py-2">Nasi Kotak Ayam</td>
                        <td>Rp 25.000</td>
                        <td>50</td>
                        <td class="text-green-600">Aktif</td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-2">Snack Box</td>
                        <td>Rp 15.000</td>
                        <td>80</td>
                        <td class="text-green-600">Aktif</td>
                    </tr>

                </tbody>

            </table>

        </div>


        <!-- ORDER -->
        <div class="bg-white p-6 rounded-xl shadow">

            <h3 class="font-semibold mb-4">
                Recent Orders
            </h3>

            <table class="w-full text-sm">

                <thead>
                    <tr class="border-b">
                        <th class="py-2">Customer</th>
                        <th>Menu</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="border-b">
                        <td>PT Telkom</td>
                        <td>Nasi Kotak</td>
                        <td class="text-blue-500">Diproses</td>
                        <td>Rp 2.500.000</td>
                    </tr>

                    <tr class="border-b">
                        <td>Bank BRI</td>
                        <td>Snack Box</td>
                        <td class="text-yellow-500">Pending</td>
                        <td>Rp 800.000</td>
                    </tr>

                </tbody>

            </table>

        </div>

    </main>

</div>

@endsection


@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    new Chart(document.getElementById('revenueChart'), {

        type: 'line',

        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Revenue',
                data: [2000000, 3000000, 2500000, 4000000, 3500000, 4500000, 3000000],
                borderColor: '#6366F1',
                backgroundColor: 'rgba(99,102,241,0.2)',
                fill: true,
                tension: 0.4
            }]
        }

    })

    new Chart(document.getElementById('orderChart'), {

        type: 'doughnut',

        data: {
            labels: ['Pending', 'Diproses', 'Dikirim', 'Selesai'],
            datasets: [{
                data: [12, 19, 8, 30],
                backgroundColor: ['#FACC15', '#3B82F6', '#A855F7', '#22C55E']
            }]
        }

    })

    setTimeout(() => {
        document.getElementById('notification').classList.remove('hidden')
    }, 3000)
</script>

@endsection