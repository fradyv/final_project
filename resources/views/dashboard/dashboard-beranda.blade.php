<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Beranda · KindlyJAR</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('dashboard.css') }}"/>
</head>
<body class="dashboard-body">

  <!-- ── SIDEBAR ── -->
  <aside class="sidebar">
    <div class="sidebar-top">
      <a class="logo sidebar-logo" href="{{ route('index') }}">
        <div class="logo-icon">
          <img src="{{ asset('assets/logo_putih.png') }}" alt="KindlyJAR" />
        </div>
        <span class="logo-name">KindlyJAR</span>
      </a>

      <p class="sidebar-label">Menu</p>

      <nav class="sidebar-nav">
        <a href="{{ route('dashboard.dashboard-beranda') }}" class="sidebar-link active">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
          Beranda
        </a>
        <a href="{{ route('campaigns.index') }}" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
            <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
          </svg>
          Program Donasi
        </a>
        <a href="{{ route('products.index') }}" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
            <line x1="3" y1="6" x2="21" y2="6"/>
            <path d="M16 10a4 4 0 0 1-8 0"/>
          </svg>
          KindlyShop
        </a>
        <a href="#" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
            <polyline points="7 10 12 15 17 10"/>
            <line x1="12" y1="15" x2="12" y2="3"/>
          </svg>
          Riwayat Pembelian
        </a>
        <a href="#" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
          </svg>
          Jejak Kebaikan
        </a>
        <a href="#" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M18 11V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0"/>
            <path d="M14 10V4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v2"/>
            <path d="M10 10.5V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v8"/>
            <path d="M18 8a2 2 0 1 1 4 0v6a8 8 0 0 1-8 8h-2c-2.8 0-4.5-.86-5.99-2.34l-3.6-3.6a2 2 0 0 1 2.83-2.82L7 15"/>
          </svg>
          Inisiasi Donasi
        </a>
      </nav>

      <div class="sidebar-cta">
        <button class="btn-join-hero">Gabung menjadi Hero!</button>
      </div>
    </div>
  </aside>

  <!-- ── KANAN: topbar (tidak scroll) + konten (scroll) ── -->
  <div class="dash-right">

    <!-- Topbar: selalu terlihat, tidak ikut scroll -->
    <div class="dash-topbar">
      <h1 class="dash-greeting">
        Selamat datang, <span class="dash-username" id="dashUsername">{{ $user->name }}</span>
      </h1>
      <div class="dash-topbar-right">
        <div class="notif-wrap">
          <button class="notif-btn" id="notifBtn" aria-label="Notifikasi">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
              <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
          </button>
        </div>
        <div class="profile-wrap">
          <div class="dash-profile" id="profileBtn">
            <img src="{{ asset('assets/pp dahsboard.jpg') }}" alt="{{ $user->name }}" class="dash-avatar" />
            <div>
              <p class="dash-profile-name" id="dashProfileName">{{ $user->name }}</p>
              <p class="dash-profile-email" id="dashProfileEmail">{{ $user->email }}</p>
            </div>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#b0b7c3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left:4px;flex-shrink:0">
              <polyline points="6 9 12 15 18 9"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

  <div class="verification-banner" id="verifyBanner">
    <div class="banner-content">
      <span class="banner-icon">⚠️</span>
      <p><strong>Akun Belum Terverifikasi:</strong> Silakan verifikasi identitasmu terlebih dahulu untuk membuka akses penuh penggalangan dana dan donasi secara aman.</p>
    </div>
    <div class="banner-actions">
      <a href="../verification/verify.html" class="banner-btn">Verifikasi Sekarang</a>
      <button class="banner-close" id="closeBannerBtn">&times;</button>
    </div>
  </div>

    <!-- Area yang scroll -->
    <main class="dash-scroll">

      <!-- Satu card besar berisi semua section -->
    <div class="dash-main-card">

      <!-- Section 1: Ringkasan -->
      <section class="dash-section">
        <h2 class="dash-card-title">Ringkasan Dampak Kebaikanmu</h2>
        <p class="dash-card-sub">Pantau terus perkembangan donasi dan performa karya kreatifmu di sini.</p>

        <div class="summary-row">
          <div class="summary-card primary">
            <p class="summary-value">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</p>
            <p class="summary-label">Total Donasi</p>
          </div>
          <div class="summary-card">
            <p class="summary-value">{{ $karyaTerjual }}</p>
            <p class="summary-label">Karya Terjual</p>
          </div>
          <div class="summary-card">
            <p class="summary-value">{{ $inisiasiProgram }}</p>
            <p class="summary-label">Inisiasi Program</p>
          </div>
          <div class="summary-card">
            <p class="summary-value">Rp {{ number_format($saldoWallet, 0, ',', '.') }}</p>
            <p class="summary-label">Saldo Dompet</p>
          </div>
        </div>
      </section>

      <!-- Section 2: Riwayat Aktivitas -->
      <section class="dash-section">
        <h2 class="dash-card-title">Riwayat Aktivitas Donasi</h2>
        
        <div class="history-box">
          <div class="table-wrap">
            <table class="activity-table">
              <thead>
                <tr>
                  <th>ID Donasi</th>
                  <th>Program Donasi</th>
                  <th>Tanggal</th>
                  <th>Jumlah</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="historyTableBody">
                @forelse ($donations as $donation)
                <tr>
                  <td>#KJ-{{ str_pad($donation->id, 4, '0', STR_PAD_LEFT) }}</td>
                  <td>{{ $donation->campaign->title ?? '-' }}</td>
                  <td>{{ $donation->created_at->translatedFormat('d F Y') }}</td>
                  <td>Rp {{ number_format($donation->total_amount, 0, ',', '.') }}</td>
                  <td>
                    <span class="badge {{ $donation->payment_status === \App\Enums\PaymentStatus::Paid ? 'berhasil' : 'gagal' }}">
                      &#9679; {{ $donation->payment_status === \App\Enums\PaymentStatus::Paid ? 'Berhasil' : 'Gagal' }}
                    </span>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" style="text-align:center; color:#718096; padding: 20px;">
                    Belum ada riwayat donasi.
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="history-pagination">
            <button class="page-nav-btn" id="prevBtn" disabled>&lt;</button>
            <span class="page-num-display" id="pageDisplay">1</span>
            <button class="page-nav-btn" id="nextBtn" disabled>&gt;</button>
          </div>
        </div>
      </section>

      <!-- Section 3: Trending -->
      <section class="dash-section dash-trending">
        <h2 class="dash-card-title">Paling Banyak Dibantu Pekan Ini</h2>
        <p class="dash-card-sub">Yuk, ikut berkontribusi di program yang sedang ramai didukung oleh Hero lainnya.</p>

        <div class="trending-grid">

          @forelse ($trendingCampaigns as $campaign)
          @php
            $pct = $campaign->target_amount > 0
              ? min(100, round(($campaign->current_amount / $campaign->target_amount) * 100))
              : 0;
          @endphp
          <div class="trending-card">
            <div class="trending-img">
              <img src="{{ asset('assets/program1.jpg') }}" alt="{{ $campaign->title }}" />
            </div>
            <div class="trending-body">
              <h3 class="trending-title">{{ $campaign->title }}</h3>
              <div class="t-progress">
                <div class="t-bar"><div class="t-fill" style="width:{{ $pct }}%"></div></div>
                <span class="t-pct">{{ $pct }}% Terpenuhi</span>
              </div>
              <button class="btn-t-donasi">Donasi!</button>
              <a href="#" class="t-detail">Lihat detail</a>
            </div>
          </div>
          @empty
          <p style="color:#718096; text-align:center; width:100%; padding: 20px 0;">
            Belum ada program donasi aktif.
          </p>
          @endforelse

        </div>
      </section>

    </div><!-- /.dash-main-card -->
    </main>

    <!-- Dropdowns: absolute dalam .dash-right, tidak ikut scroll sama sekali -->
    <div class="notif-dropdown" id="notifDropdown">
      <div class="notif-header">
        <span class="notif-title">Notifikasi</span>
        <span class="notif-badge">0 baru</span>
      </div>
      <div class="notif-empty">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#b0b7c3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
          <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
        </svg>
        <p>Belum ada notifikasi</p>
      </div>
    </div>

    <div class="profile-dropdown" id="profileDropdown">
  <div class="profile-dropdown-menu">
    <a href="#" class="profile-menu-item">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
        <circle cx="12" cy="7" r="4"/>
      </svg>
      Lihat Profil
    </a>
    <a href="#" class="profile-menu-item">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="3"/>
        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
      </svg>
      Pengaturan
    </a>
    <div class="profile-menu-divider"></div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="profile-menu-item danger" style="background:none;border:none;width:100%;text-align:left;cursor:pointer;padding:10px 16px;display:flex;align-items:center;gap:10px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
          <polyline points="16 17 21 12 16 7"/>
          <line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
        Keluar
      </button>
    </form>
  </div>
</div>

  </div><!-- .dash-right -->

  <script src="{{ asset('script.js') }}"></script>
  <script>
    const notifBtn      = document.getElementById('notifBtn');
    const notifDropdown = document.getElementById('notifDropdown');
    const profileBtn    = document.getElementById('profileBtn');
    const profileDropdown = document.getElementById('profileDropdown');
    const dashRight     = document.querySelector('.dash-right');

    function positionDropdown(dropdown, anchor) {
      const pr = dashRight.getBoundingClientRect();
      const ar = anchor.getBoundingClientRect();
      dropdown.style.top   = (ar.bottom - pr.top + 8) + 'px';
      dropdown.style.right = (pr.right - ar.right) + 'px';
      dropdown.style.left  = 'auto';
    }

    notifBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const opening = !notifDropdown.classList.contains('open');
      profileDropdown.classList.remove('open');
      if (opening) {
        positionDropdown(notifDropdown, notifBtn);
        notifDropdown.classList.add('open');
      } else {
        notifDropdown.classList.remove('open');
      }
    });

    profileBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const opening = !profileDropdown.classList.contains('open');
      notifDropdown.classList.remove('open');
      if (opening) {
        positionDropdown(profileDropdown, profileBtn);
        profileDropdown.classList.add('open');
      } else {
        profileDropdown.classList.remove('open');
      }
    });

    document.addEventListener('click', () => {
      notifDropdown.classList.remove('open');
      profileDropdown.classList.remove('open');
    });
  </script>
</body>
</html>
