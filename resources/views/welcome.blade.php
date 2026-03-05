<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Marketplace Katering</title>

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            background: #f3f4f6;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .logo {
            font-size: 22px;
            font-weight: 700;
            color: #16a34a;
        }

        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-height: 70vh;
            padding: 40px;
        }

        .hero h1 {
            font-size: 42px;
            margin-bottom: 10px;
            color: #111827;
        }

        .hero p {
            color: #6b7280;
            max-width: 600px;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-primary {
            background: #16a34a;
            color: white;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #111827;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            padding: 40px;
            max-width: 1100px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
        }
    </style>

</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">

        <div class="logo">
            🍱 KateringKu
        </div>

        @if (Route::has('login'))
        <div>

            @auth

            @if(auth()->user()->role == 'merchant')
            <a href="{{ url('/merchant/dashboard') }}" class="btn btn-secondary">
                Dashboard
            </a>

            @elseif(auth()->user()->role == 'customer')
            <a href="{{ url('/customer/dashboard') }}" class="btn btn-secondary">
                Dashboard
            </a>

            @endif

            @else
            <a href="{{ route('login') }}" class="btn btn-secondary">
                Login
            </a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-primary">
                Register
            </a>
            @endif

            @endauth

        </div>
        @endif

    </div>


    <!-- HERO -->
    <div class="hero">

        <h1>Marketplace Katering Terbaik</h1>

        <p>
            Temukan berbagai pilihan katering rumahan, prasmanan, hingga catering harian
            langsung dari merchant terpercaya.
        </p>

        @if (Route::has('login'))
        @auth

        @if(auth()->user()->role == 'merchant')
        <a href="{{ url('/merchant/dashboard') }}" class="btn btn-primary">
            Masuk ke Dashboard Merchant
        </a>

        @elseif(auth()->user()->role == 'customer')
        <a href="{{ url('/customer/dashboard') }}" class="btn btn-primary">
            Masuk ke Dashboard Customer
        </a>
        @endif

        @else

        <a href="{{ route('register') }}" class="btn btn-primary">
            Mulai Pesan Katering
        </a>

        @endauth
        @endif

    </div>


    <!-- FITUR -->
    <div class="features">

        <div class="card">
            <h3>🍽 Banyak Pilihan Menu</h3>
            <p>Ratusan merchant menyediakan berbagai jenis makanan.</p>
        </div>

        <div class="card">
            <h3>🚚 Pengiriman Mudah</h3>
            <p>Pesanan katering langsung dikirim ke alamat anda.</p>
        </div>

        <div class="card">
            <h3>⭐ Merchant Terpercaya</h3>
            <p>Rating dan review dari pelanggan membantu memilih katering terbaik.</p>
        </div>

        <div class="card">
            <h3>📦 Pesan untuk Event</h3>
            <p>Cocok untuk acara kantor, pesta, maupun kebutuhan harian.</p>
        </div>

    </div>


    <!-- FOOTER -->
    <div class="footer">

        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})

    </div>

</body>

</html>