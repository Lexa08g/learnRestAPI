<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #ffffff;
            color: #111827;
        }

        /* Top Bar Header */
        .header {
            background-color: #1a6cf0;
            color: #ffffff;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .brand {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: -0.3px;
        }

        .header .nav-links {
            display: flex;
            gap: 20px;
        }

        .header .nav-links a {
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .header .nav-links a:hover {
            opacity: 0.85;
        }

        /* Search & Filter Bar */
        .filter-section {
            background-color: #f1f3f4;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-box {
            width: 250px;
            padding: 6px 12px;
            font-size: 13.5px;
            border: 1px solid #757575;
            border-radius: 6px;
            background-color: #ffffff;
            outline: none;
            color: #333333;
        }

        .search-box::placeholder {
            color: #757575;
        }

        .search-box:focus {
            border-color: #1a6cf0;
        }

        .category-select {
            padding: 6px 10px;
            font-size: 13.5px;
            border: 1.5px solid #222222;
            border-radius: 4px;
            background-color: #ffffff;
            outline: none;
            cursor: pointer;
            color: #111111;
        }

        /* Main Container */
        .main-container {
            max-width: 1100px;
            margin: 0;
            padding: 24px;
        }

        .page-title {
            font-size: 20px;
            font-weight: 800;
            color: #000000;
            margin-bottom: 20px;
            letter-spacing: -0.2px;
        }

        /* Product Cards Grid */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        @media (max-width: 768px) {
            .card-grid {
                grid-template-columns: 1fr;
            }
            .filter-section {
                flex-direction: column;
                gap: 10px;
                align-items: stretch;
            }
            .search-box {
                width: 100%;
            }
        }

        .product-card {
            background-color: #ffffff;
            border: 1.5px solid #4b5563;
            border-radius: 8px;
            padding: 16px 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 140px;
        }

        .product-card h3 {
            font-size: 16px;
            font-weight: 700;
            color: #000000;
            margin-bottom: 2px;
        }

        .product-card .artist-name {
            font-size: 13px;
            font-weight: 600;
            color: #1a6cf0;
            margin-bottom: 2px;
        }

        .product-card .format-badge {
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 6px;
        }

        .product-card p {
            font-size: 13px;
            color: #4b5563;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .product-card .price {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 12px;
        }

        .product-card a {
            color: #1a6cf0;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            width: fit-content;
        }

        .product-card a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <header class="header">
        <a href="{{ url('/') }}" class="brand">MyShop</a>
        <nav class="nav-links">
            <a href="{{ url('/') }}">Katalog Toko</a>
            <a href="{{ url('/admin') }}">Admin</a>
        </nav>
    </header>

    <!-- Search & Filter Bar -->
    <form method="GET" action="{{ url('/') }}" class="filter-section">
        <input 
            type="text" 
            name="search" 
            class="search-box" 
            placeholder="Cari produk..." 
            value="{{ request('search') }}"
        >
        <select name="category" class="category-select" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @if(isset($categories))
                @foreach ($categories as $cat)
                    <option value="{{ $cat->category_id }}" {{ request('category') == $cat->category_id ? 'selected' : '' }}>
                        {{ $cat->category }}
                    </option>
                @endforeach
            @endif
        </select>
    </form>

    <!-- Main Content -->
    <main class="main-container">
        <h1 class="page-title">Dashboard Produk</h1>

        <div class="card-grid">
            @if(isset($products) && $products->count() > 0)
                @foreach ($products as $item)
                    <div class="product-card">
                        <div>
                            <h3>{{ $item->name }}</h3>
                            @if($item->artist)
                                <div class="artist-name">{{ $item->artist }}</div>
                            @endif
                            @if($item->format)
                                <div class="format-badge">{{ $item->format }}</div>
                            @endif
                            <p>{{ $item->description ?? 'Deskripsi singkat ' . strtolower($item->name) }}</p>
                            <div class="price">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </div>
                        </div>
                        <a href="#">Lihat Detail</a>
                    </div>
                @endforeach
            @else
                <div class="product-card">
                    <div>
                        <h3>Produk 1</h3>
                        <p>Deskripsi singkat produk 1</p>
                    </div>
                    <a href="#">Lihat Detail</a>
                </div>
            @endif
        </div>
    </main>

</body>
</html>
