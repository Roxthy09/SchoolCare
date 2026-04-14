<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SchoolCare &mdash; Masuk</title>

  {{-- Vendor CSS --}}
  <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

  {{-- Google Font --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">

  <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo-schoolcare1.png') }}">

  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --brand: #1B4F8A;
      --brand-dark: #153D6B;
      --brand-light: #EBF2FB;
      --text-main: #111827;
      --text-sub: #6B7280;
      --text-hint: #9CA3AF;
      --border: rgba(0, 0, 0, 0.10);
      --surface: #F9FAFB;
      --white: #ffffff;
      --radius-sm: 8px;
      --radius-md: 12px;
      --radius-lg: 18px;
      --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
      --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
      --font: 'Plus Jakarta Sans', sans-serif;
    }

    html,
    body {
      height: 100%;
      font-family: var(--font);
      background: var(--surface);
      color: var(--text-main);
    }

    /* ── Page Layout ── */
    .sc-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1rem;
    }

    .sc-card {
      display: flex;
      width: 100%;
      max-width: 900px;
      min-height: 560px;
      border-radius: var(--radius-lg);
      overflow: hidden;
      box-shadow: var(--shadow-md);
    }

    /* ── Left Panel ── */
    .sc-left {
      flex: 0 0 42%;
      background: var(--brand);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      padding: 3rem 2.5rem;
      position: relative;
      overflow: hidden;
    }

    /* Decorative circles */
    .sc-left::before {
      content: '';
      position: absolute;
      width: 340px;
      height: 340px;
      border-radius: 50%;
      border: 1px solid rgba(255, 255, 255, 0.10);
      top: -100px;
      left: -100px;
      pointer-events: none;
    }

    .sc-left::after {
      content: '';
      position: absolute;
      width: 220px;
      height: 220px;
      border-radius: 50%;
      border: 1px solid rgba(255, 255, 255, 0.07);
      bottom: -70px;
      right: -50px;
      pointer-events: none;
    }

    .sc-logo-wrap {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 2.5rem;
      position: relative;
      z-index: 1;
    }

    .sc-logo-wrap img {
      width: 40px;
      height: 40px;
      object-fit: contain;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.15);
      padding: 4px;
    }

    .sc-logo-wrap span {
      font-size: 18px;
      font-weight: 600;
      color: #fff;
      letter-spacing: -0.3px;
    }

    .sc-left h1 {
      font-size: 22px;
      font-weight: 600;
      color: #fff;
      line-height: 1.35;
      margin-bottom: 0.75rem;
      position: relative;
      z-index: 1;
    }

    .sc-left p {
      font-size: 14px;
      color: rgba(255, 255, 255, 0.60);
      line-height: 1.65;
      max-width: 220px;
      position: relative;
      z-index: 1;
    }

    .sc-features {
      margin-top: 2.5rem;
      display: flex;
      flex-direction: column;
      gap: 14px;
      position: relative;
      z-index: 1;
    }

    .sc-feature {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .sc-feature-icon {
      width: 34px;
      height: 34px;
      border-radius: 9px;
      background: rgba(255, 255, 255, 0.13);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 15px;
      flex-shrink: 0;
    }

    .sc-feature span {
      font-size: 13px;
      color: rgba(255, 255, 255, 0.72);
      font-weight: 400;
    }

    /* ── Right Panel ── */
    .sc-right {
      flex: 1;
      background: var(--white);
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 3rem 2.75rem;
    }

    .sc-right h2 {
      font-size: 20px;
      font-weight: 600;
      color: var(--text-main);
      margin-bottom: 4px;
    }

    .sc-right .sc-subtitle {
      font-size: 14px;
      color: var(--text-sub);
      margin-bottom: 2rem;
    }

    /* Alert error */
    .sc-alert {
      background: #FEF2F2;
      border: 1px solid #FECACA;
      border-radius: var(--radius-sm);
      padding: 0.75rem 1rem;
      font-size: 13px;
      color: #B91C1C;
      margin-bottom: 1.25rem;
      display: flex;
      align-items: flex-start;
      gap: 8px;
    }

    .sc-alert i {
      margin-top: 1px;
      flex-shrink: 0;
    }

    /* Form fields */
    .sc-field {
      margin-bottom: 1.1rem;
    }

    .sc-field label {
      display: block;
      font-size: 13px;
      font-weight: 500;
      color: var(--text-sub);
      margin-bottom: 6px;
    }

    .sc-input-wrap {
      position: relative;
    }

    .sc-input-wrap i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 15px;
      color: var(--text-hint);
      pointer-events: none;
    }

    .sc-input {
      width: 100%;
      height: 44px;
      padding: 0 14px 0 38px;
      font-family: var(--font);
      font-size: 14px;
      color: var(--text-main);
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-sm);
      outline: none;
      transition: border-color 0.15s, box-shadow 0.15s;
    }

    .sc-input::placeholder {
      color: var(--text-hint);
    }

    .sc-input:focus {
      border-color: var(--brand);
      box-shadow: 0 0 0 3px rgba(27, 79, 138, 0.10);
      background: var(--white);
    }

    .sc-input.is-invalid {
      border-color: #EF4444;
      box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.10);
    }

    .sc-error-text {
      font-size: 12px;
      color: #EF4444;
      margin-top: 4px;
    }

    /* Password toggle */
    .sc-toggle-pass {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: var(--text-hint);
      padding: 0;
      font-size: 15px;
      line-height: 1;
    }

    .sc-toggle-pass:hover {
      color: var(--text-sub);
    }

    /* Forgot */
    .sc-forgot {
      display: block;
      text-align: right;
      font-size: 12px;
      color: var(--brand);
      margin-bottom: 1.5rem;
      text-decoration: none;
      font-weight: 500;
    }

    .sc-forgot:hover {
      text-decoration: underline;
    }

    /* Submit */
    .sc-btn {
      width: 100%;
      height: 44px;
      background: var(--brand);
      color: #fff;
      border: none;
      border-radius: var(--radius-sm);
      font-family: var(--font);
      font-size: 14px;
      font-weight: 600;
      letter-spacing: 0.2px;
      cursor: pointer;
      transition: background 0.15s, transform 0.1s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .sc-btn:hover {
      background: var(--brand-dark);
    }

    .sc-btn:active {
      transform: scale(0.99);
    }

    /* Divider */
    .sc-divider {
      display: flex;
      align-items: center;
      gap: 12px;
      margin: 1.5rem 0;
    }

    .sc-divider-line {
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    .sc-divider-label {
      font-size: 12px;
      color: var(--text-hint);
      white-space: nowrap;
    }

    /* Role badges */
    .sc-roles {
      display: flex;
      gap: 8px;
    }

    .sc-role {
      flex: 1;
      padding: 9px 6px;
      border-radius: var(--radius-sm);
      border: 1px solid var(--border);
      background: var(--surface);
      text-align: center;
      font-size: 12px;
      color: var(--text-sub);
      cursor: pointer;
      transition: border-color 0.15s, color 0.15s, background 0.15s;
      font-family: var(--font);
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
    }

    .sc-role:hover {
      border-color: var(--brand);
      color: var(--brand);
      background: var(--brand-light);
    }

    .sc-role i {
      font-size: 13px;
    }

    /* Footer */
    .sc-footer {
      margin-top: 2rem;
      font-size: 12px;
      color: var(--text-hint);
      text-align: center;
    }

    /* ── Responsive ── */
    @media (max-width: 640px) {
      .sc-left {
        display: none;
      }

      .sc-card {
        max-width: 440px;
      }

      .sc-right {
        padding: 2.5rem 1.75rem;
      }

      .sc-input-wrap {
        position: relative;
        /* wajib ada */
      }

      .sc-input-wrap .sc-input {
        width: 100%;
        padding-right: 45px;
        /* beri ruang untuk icon mata di kanan */
        box-sizing: border-box;
      }

      .sc-toggle-pass {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        z-index: 10;
        /* pastikan di atas input */
        padding: 0;
        line-height: 1;
      }
    }
  </style>
</head>

<body>

  <div class="sc-wrapper">
    <div class="sc-card">

      {{-- ── Left Panel ── --}}
      <div class="sc-left">
        <div class="sc-logo-wrap">
          <img src="{{ asset('admin/assets/images/logo-schoolcare1.png') }}" alt="SchoolCare">
          <span>SchoolCare</span>
        </div>

        <h1>Platform Manajemen Sekolah Terpadu</h1>
        <p>Kelola akademik, presensi, dan komunikasi sekolah dalam satu platform.</p>

        <div class="sc-features">
          <div class="sc-feature">
            <div class="sc-feature-icon">📊</div>
            <span>Laporan akademik real-time</span>
          </div>
          <div class="sc-feature">
            <div class="sc-feature-icon">📅</div>
            <span>Manajemen jadwal &amp; presensi</span>
          </div>
          <div class="sc-feature">
            <div class="sc-feature-icon">💬</div>
            <span>Komunikasi orang tua &amp; guru</span>
          </div>
        </div>
      </div>

      {{-- ── Right Panel ── --}}
      <div class="sc-right">
        <h2>Selamat datang kembali</h2>
        <p class="sc-subtitle">Masuk ke akun SchoolCare Anda untuk melanjutkan.</p>

        {{-- Flash error (general) --}}
        @if (session('error'))
        <div class="sc-alert">
          <i class="fa fa-exclamation-circle"></i>
          {{ session('error') }}
        </div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
        <div class="sc-alert">
          <i class="fa fa-exclamation-circle"></i>
          <div>
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
          </div>
        </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}" autocomplete="off">
          @csrf

          {{-- Email --}}
          <div class="sc-field">
            <label for="email">Email</label>
            <div class="sc-input-wrap">
              <i class="fa fa-envelope-o"></i>
              <input
                type="email"
                id="email"
                name="email"
                class="sc-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                placeholder="nama@sekolah.sch.id"
                value="{{ old('email') }}"
                required
                autofocus>
            </div>
            @error('email')
            <p class="sc-error-text">{{ $message }}</p>
            @enderror
          </div>

          {{-- Password --}}
          <div class="sc-field">
            <label for="password">Kata Sandi</label>
            <div style="position: relative; display: flex; align-items: center;">
              <i class="fa fa-lock" style="position: absolute; left: 14px; color: #aaa; z-index: 2; pointer-events: none;"></i>
              <input
                type="password"
                id="password"
                name="password"
                class="sc-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                placeholder="Masukkan kata sandi"
                required
                style="width: 100%; padding: 10px 45px 10px 40px; box-sizing: border-box;">
              <span
                id="toggleBtn"
                onclick="togglePassword()"
                style="position: absolute; right: 14px; cursor: pointer; z-index: 2; color: #aaa; user-select: none;">
                <i class="fa fa-eye" id="eyeIcon"></i>
              </span>
            </div>
            @error('password')
            <p class="sc-error-text">{{ $message }}</p>
            @enderror
          </div>


          <button type="submit" class="sc-btn">
            <i class="fa fa-sign-in"></i>
            Masuk
          </button>
        </form>

        <div class="sc-divider">
          <div class="sc-divider-line"></div>
          <span class="sc-divider-label">atau masuk sebagai</span>
          <div class="sc-divider-line"></div>
        </div>

        <div class="sc-roles">
          <button class="sc-role" onclick="fillRole('admin')">
            <i class="fa fa-user-circle-o"></i> Admin
          </button>
          <button class="sc-role" onclick="fillRole('petugas')">
            <i class="fa fa-graduation-cap"></i> Petugas
          </button>
        </div>

        <p class="sc-footer">&copy; {{ date('Y') }} SchoolCare &middot; Semua hak dilindungi</p>
      </div>

    </div>
  </div>

  {{-- Vendor JS --}}
  <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('admin/assets/js/misc.js') }}"></script>

  <script>
    // Toggle show/hide password
    function togglePassword() {
      var input = document.getElementById('password');
      var icon = document.getElementById('eyeIcon');
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }

    // Role shortcut — isi email sesuai peran
    // Sesuaikan placeholder email di bawah dengan email default masing-masing peran
    function fillRole(role) {
      var emailMap = {
        admin: 'admin@schoolcare.sch.id',
        petugas: 'petugas@schoolcare.sch.id',
      };
      var emailInput = document.getElementById('email');
      if (emailMap[role]) {
        emailInput.value = emailMap[role];
        emailInput.focus();
      }
    }
  </script>
  <script>
    function togglePassword() {
      const input = document.getElementById('password');
      const icon = document.getElementById('eyeIcon');

      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
  </script>

</body>

</html>