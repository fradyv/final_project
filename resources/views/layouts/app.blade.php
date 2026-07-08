<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'KindlyJAR')</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('dashboard.css') }}"/>
  <style>
    .page-wrap { max-width: 960px; margin: 2rem auto; padding: 0 1rem; font-family: Nunito, sans-serif; }
    .card { background: #fff; border-radius: 12px; padding: 1.5rem; margin-bottom: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
    .btn { display: inline-block; padding: .6rem 1.2rem; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; font-weight: 700; }
    .btn-primary { background: #e85d04; color: #fff; }
    .btn-danger { background: #dc3545; color: #fff; }
    .alert-success { background: #d4edda; color: #155724; padding: .75rem 1rem; border-radius: 8px; margin-bottom: 1rem; }
    .form-group { margin-bottom: 1rem; }
    .form-group label { display: block; font-weight: 600; margin-bottom: .35rem; }
    .form-group input, .form-group textarea, .form-group select { width: 100%; padding: .5rem .75rem; border: 1px solid #ddd; border-radius: 8px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: .75rem; border-bottom: 1px solid #eee; text-align: left; }
    .nav-links { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.5rem; }
    .nav-links a { color: #e85d04; text-decoration: none; font-weight: 600; }
  </style>
</head>
<body class="dashboard-body">
  <div class="page-wrap">
    <div class="nav-links">
      <a href="{{ route('dashboard') }}">Beranda</a>
      <a href="{{ route('products.index') }}">KindlyShop</a>
      <a href="{{ route('campaigns.index') }}">Program Donasi</a>
      <a href="{{ route('cart.index') }}">Keranjang</a>
      <a href="{{ route('orders.index') }}">Riwayat Pembelian</a>
      <a href="{{ route('profile.edit') }}">Profil</a>
      <a href="{{ route('settings.identity') }}">Pengaturan</a>
      @if(auth()->user()?->isPenggalang())
        <a href="{{ route('wallet.index') }}">Wallet</a>
      @endif
      @if(auth()->user()?->hasRole('admin'))
        <a href="{{ route('admin.dashboard') }}">Admin</a>
      @endif
    </div>

    @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
  </div>
</body>
</html>
