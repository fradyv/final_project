<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Program Donasi · KindlyJAR</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('dashboard.css') }}"/>
</head>
<body class="dashboard-body">

  <!-- ── SIDEBAR ── -->
  <aside class="sidebar">
    <div class="sidebar-top">
      <a class="logo sidebar-logo" href="../landing-page/index.html">
        <div class="logo-icon">
          <img src="{{ asset('assets/logo_putih.png') }}" alt="KindlyJAR" />
        </div>
        <span class="logo-name">KindlyJAR</span>
      </a>

      <p class="sidebar-label">Menu</p>

      <nav class="sidebar-nav">
        <a href="../dashboard/dashboard-beranda.html" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
          Beranda
        </a>
        <a href="../dashboard-donasi/program-donasi.html" class="sidebar-link active">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
            <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
          </svg>
          Program Donasi
        </a>
        <a href="../dashboard-shop/kindlyshop.html" class="sidebar-link">
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
      
      <!-- SEARCH BAR BARU -->
      <div class="dash-search-container">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#718096" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="search-icon">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" id="donationSearchInput" placeholder="Jelajahi Program Donasi" class="dash-search-input" />
      </div>

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
            <img src="{{ asset('assets/pp dahsboard.jpg') }}" alt="{{ auth()->user()->name }}" class="dash-avatar" />
            <div>
              <p class="dash-profile-name" id="dashProfileName">{{ auth()->user()->name }}</p>
              <p class="dash-profile-email" id="dashProfileEmail">{{ auth()->user()->email }}</p>
            </div>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#b0b7c3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left:4px;flex-shrink:0">
              <polyline points="6 9 12 15 18 9"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Banner Warning Tetap Muncul -->
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

    <!-- AREA SCROLL BOX UTAMA -->
    <main class="dash-scroll">

      <!-- Satu card besar pembungkus utama konten kosong -->
      <div class="dash-main-card">
        <section class="donation-header-banner">
        <div class="banner-text-content">
          <h2>Ubah Masa Depan Lewat Bentangan Kebaikan</h2>
          <p>Salurkan bantuanmu secara transparan untuk memfasilitasi sekolah, guru, dan siswa di seluruh pelosok Nusantara.</p>
        </div>
        <div class="banner-image-container">
          <img src="{{ asset('assets/header-donation-pic.jpg') }}" alt="Bentangan Kebaikan" class="banner-fade-img" />
        </div>
      </section>
      <!-- Area Tombol Kategori yang sudah ada sebelumnya -->
        <div class="category-filter-row">
        <!-- Tombol-tombol kategorimu berada di sini... -->
        </div>

        <!-- ── TAMBAHKAN SECTION INI DI BAWAHNYA ── -->
        <section class="dash-section dash-trending">
        <h2 class="dash-card-title">Paling Banyak Dibantu Pekan Ini</h2>
        <p class="dash-card-sub">Yuk, ikut berkontribusi di program yang sedang ramai didukung oleh Hero lainnya.</p>

        <div class="trending-grid">

          @forelse ($trendingCampaigns as $campaign)
          @php
            $pct = $campaign->target_amount > 0
              ? min(100, round(($campaign->current_amount / $campaign->target_amount) * 100))
              : 0;
            $programImgs = [asset('assets/program1.jpg'), asset('assets/program2.jpg'), asset('assets/program3.jpg'), asset('assets/program4.jpg')];
            $img = $programImgs[$loop->index % 4];
          @endphp
          <div class="trending-card" data-category="pendidikan" data-title="{{ strtolower($campaign->title) }}">
            <div class="trending-img">
              <img src="{{ $img }}" alt="{{ $campaign->title }}" />
            </div>
            <div class="trending-body">
              <h3 class="trending-title">{{ $campaign->title }}</h3>
              <p class="trending-desc" style="font-family: 'Open Sans', sans-serif; font-size: 0.85rem; color: #718096; margin-bottom: 10px; line-height: 1.4;">
                {{ Str::limit($campaign->description, 100) }}
              </p>
              <div class="t-progress">
                <div class="t-bar"><div class="t-fill" style="width:{{ $pct }}%"></div></div>
                <span class="t-pct">{{ $pct }}% Terpenuhi</span>
              </div>
              <button class="btn-t-donasi">Donasi!</button>
              <a href="#" class="t-detail">Lihat detail</a>
            </div>
          </div>
          @empty
          <p style="color:#718096; text-align:center; width:100%; padding: 20px 0;">Belum ada program donasi aktif.</p>
          @endforelse

        </div>
        </section>

        <!-- ── SECTION: BARU DILUNCURKAN ── -->
      <section class="dash-trending">
        <h2 class="dash-card-title">Baru Diluncurkan, Menanti Uluran Tangan</h2>
        <p class="dash-card-sub">Program-program ini baru saja hadir dan masih butuh dorongan awal darimu.</p>
        
        <div class="trending-grid">

          @forelse ($newCampaigns as $campaign)
          @php
            $pct = $campaign->target_amount > 0
              ? min(100, round(($campaign->current_amount / $campaign->target_amount) * 100))
              : 0;
            $baruImgs = [asset('assets/baru1.jpg'), asset('assets/baru2.jpg'), asset('assets/baru3.jpg'), asset('assets/baru4.jpg')];
            $img = $baruImgs[$loop->index % 4];
          @endphp
          <div class="trending-card" data-category="pendidikan" data-title="{{ strtolower($campaign->title) }}">
            <div class="trending-img">
              <img src="{{ $img }}" alt="{{ $campaign->title }}" />
            </div>
            <div class="trending-body">
              <h3 class="trending-title">{{ $campaign->title }}</h3>
              <p class="trending-desc" style="font-family: 'Open Sans', sans-serif; font-size: 0.85rem; color: #718096; margin-bottom: 10px; line-height: 1.4;">
                {{ Str::limit($campaign->description, 100) }}
              </p>
              <div class="t-progress">
                <div class="t-bar"><div class="t-fill" style="width:{{ $pct }}%"></div></div>
                <span class="t-pct">{{ $pct }}% Terpenuhi</span>
              </div>
              <button class="btn-t-donasi">Donasi!</button>
              <a href="#" class="t-detail">Lihat detail</a>
            </div>
          </div>
          @empty
          <p style="color:#718096; text-align:center; width:100%; padding: 20px 0;">Belum ada program baru.</p>
          @endforelse

        </div><!-- /.trending-grid -->
      </section>
      <div class="category-filter-row" id="donationCategoryRow">
          <!-- Semua -->
          <button class="btn-category-pill active" data-filter="semua">
            <span>Semua</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>

          <!-- Pendidikan -->
          <button class="btn-category-pill" data-filter="pendidikan">
            <span>Pendidikan</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>

          <!-- Infrastruktur & Akses -->
          <button class="btn-category-pill" data-filter="infrastruktur-akses">
            <span>Infrastruktur & Akses</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>

          <!-- Lingkungan -->
          <button class="btn-category-pill" data-filter="lingkungan">
            <span>Lingkungan</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>

          <!-- Inklusi & Kesetaraan -->
          <button class="btn-category-pill" data-filter="inklusi-kesetaraan">
            <span>Inklusi & Kesetaraan</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>

          <!-- Lainnya -->
          <button class="btn-category-pill" data-filter="lainnya">
            <span>Lainnya</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
        </div>

        <!-- ── SECTION: DAFTAR DONASI HORIZONTAL ── -->
        <section class="horizontal-donation-section">
        <div class="horizontal-donation-list">

          @forelse ($campaigns as $campaign)
          @php
            $pct = $campaign->target_amount > 0
              ? min(100, round(($campaign->current_amount / $campaign->target_amount) * 100))
              : 0;
            $horiImgs = [asset('assets/hori1.jpg'), asset('assets/hori2.jpg'), asset('assets/hori3.jpg'), asset('assets/hori4.jpg')];
            $img = $horiImgs[$loop->index % 4];
          @endphp
          <div class="donation-card-horizontal" data-category="pendidikan" data-title="{{ strtolower($campaign->title) }}">
            <div class="card-horizontal-img">
              <img src="{{ $img }}" alt="{{ $campaign->title }}" />
            </div>
            <div class="card-horizontal-body">
              <h3 class="card-horizontal-title">{{ $campaign->title }}</h3>

              <div class="card-horizontal-badges">
                <button class="btn-category-pill">
                  <span>Donasi</span>
                  <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
              </div>

              <div class="card-horizontal-meta">
                <div class="meta-item">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#21A3FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                  <span>{{ $campaign->fundraiser->user->name ?? 'Penggalang Dana' }}</span>
                </div>
                <div class="meta-item">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#21A3FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                  <span>{{ $campaign->donations_count }} Membantu</span>
                </div>
              </div>

              <div class="card-horizontal-progress">
                <div class="progress-bar-bg">
                  <div class="progress-bar-fill" style="width: {{ $pct }}%;"></div>
                </div>
                <span class="progress-target">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }} / {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
              </div>

              <div class="card-horizontal-actions">
                <button class="btn-horizontal-donasi">Donasi!</button>
                <a href="#" class="horizontal-detail-link">Lihat detail</a>
              </div>
            </div>
          </div>
          @empty
          <p style="color:#718096; text-align:center; width:100%; padding: 30px 0;">Belum ada program donasi tersedia.</p>
          @endforelse

        </div>
        </section>

        <p class="shop-empty-state" id="donationEmptyState" style="display:none;">Program tidak ditemukan.</p>

      </div><!-- /.dash-main-card -->
    </main>

    <!-- Dropdowns (Tetap Berfungsi) -->
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
        <a href="../landing-page/index.html" class="profile-menu-item danger">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
            <polyline points="16 17 21 12 16 7"/>
            <line x1="21" y1="12" x2="9" y2="12"/>
          </svg>
          Keluar
        </a>
      </div>
    </div>

  </div><!-- .dash-right -->

  <script src="{{ asset('script.js') }}"></script>
  <script>
    // Logic Dropdown bawaan template agar fungsionalitas topbar tidak rusak
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

    // Filter kategori + search Program Donasi
    const donationCategoryRow = document.getElementById('donationCategoryRow');
    const donationCards       = Array.from(document.querySelectorAll('.trending-card, .donation-card-horizontal'));
    const donationSearchInput = document.getElementById('donationSearchInput');
    const donationEmptyState  = document.getElementById('donationEmptyState');
    let activeDonationFilter = 'semua';

    function applyDonationFilter() {
      const query = donationSearchInput.value.trim().toLowerCase();
      let visibleCount = 0;

      donationCards.forEach((card) => {
        const matchesCategory = activeDonationFilter === 'semua' || card.dataset.category === activeDonationFilter;
        const matchesSearch = !query || card.dataset.title.includes(query);
        const show = matchesCategory && matchesSearch;
        card.style.display = show ? '' : 'none';
        if (show) visibleCount++;
      });

      donationEmptyState.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    donationCategoryRow.addEventListener('click', (e) => {
      const pill = e.target.closest('.btn-category-pill');
      if (!pill) return;
      donationCategoryRow.querySelectorAll('.btn-category-pill').forEach((p) => p.classList.remove('active'));
      pill.classList.add('active');
      activeDonationFilter = pill.dataset.filter;
      applyDonationFilter();
    });

    donationSearchInput.addEventListener('input', applyDonationFilter);
  </script>
</body>
</html>
