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

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">

                                <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            @if(Auth::user()->role === 'merchant')
                            <x-dropdown-link :href="route('merchant.dashboard')">
                                Dashboard Merchant
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('merchant.profile.show')">
                                Profile Merchant
                            </x-dropdown-link>
                            @endif

                            @if(Auth::user()->role === 'customer')
                            <x-dropdown-link :href="route('customer.dashboard')">
                                Dashboard Customer
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('customer.profile.show')">
                                Profile Saya
                            </x-dropdown-link>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>


        <!-- STAT -->
        <div class="grid md:grid-cols-4 gap-6 mb-10">

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Total Order</p>
                <h2 class="text-3xl font-bold text-indigo-600">
                    {{ $totalOrder }}
                </h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Revenue</p>
                <h2 class="text-3xl font-bold text-green-600">
                    Rp {{ number_format($totalRevenue,0,',','.') }}
                </h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Menu Aktif</p>
                <h2 class="text-3xl font-bold">
                    {{ $totalMenu }}
                </h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Rating</p>
                <h2 class="text-3xl font-bold text-yellow-500">
                    ⭐ {{ number_format($rating,1) }}
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
                    <tr class="border-b">
                        <th class="py-2">Menu</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($topMenus as $menu)
                    <tr class="border-b">
                        <td class="py-2">{{ $menu->name }}</td>
                        <td>Rp {{ number_format($menu->price,0,',','.') }}</td>
                        <td>{{ $menu->stock }}</td>
                        <td class="text-green-600">{{ $menu->status }}</td>
                    </tr>
                    @endforeach
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
                    @foreach($latestOrders as $order)
                    <tr class="border-b">
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->menu->name }}</td>
                        <td class="text-blue-500">{{ $order->status }}</td>
                        <td>Rp {{ number_format($order->total_price,0,',','.') }}</td>
                    </tr>
                    @endforeach
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

<script>
    const revenueData = @json($weeklyRevenue);

    const labels = revenueData.map(item => item.date);
    const totals = revenueData.map(item => item.total);

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue Mingguan',
                data: totals,
                borderWidth: 2
            }]
        }
    });
</script>

<script>
    const orderData = @json($orderStats);

    new Chart(document.getElementById('orderChart'), {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Diproses', 'Selesai'],
            datasets: [{
                data: [
                    orderData.pending,
                    orderData.diproses,
                    orderData.selesai
                ]
            }]
        }
    });
</script>

@endsection