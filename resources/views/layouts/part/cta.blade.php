<section id="cta" class="cta_area mt-80">
    <div class="container">
        <div class="cta_inner d-lg-flex align-items-center justify-content-between p-5"
            style="background: linear-gradient(135deg, #6a11cb, #2575fc); border-radius:20px;">

            <!-- TEXT -->
            <div class="cta_content">
                @guest
                <h3 class="mb-3 text-white">Laporkan Keluhan Sekolah Anda</h3>
                <p class="text-white">
                    Sampaikan pengaduan Anda dengan mudah dan cepat.
                    Sistem kami akan membantu memastikan laporan Anda
                    ditangani secara transparan oleh pihak sekolah.
                </p>
                @else
                @if(auth()->user()->peran === 'orangtua')
                <h3 class="mb-3 text-white">Buat Pengaduan Sekarang</h3>
                <p class="text-white">
                    Laporkan keluhan sekolah Anda dengan cepat dan aman.
                    Tim sekolah akan menerima laporan Anda dan menindaklanjuti
                    sesuai proses yang berlaku.
                </p>
                @elseif(auth()->user()->peran === 'admin')
                <h3 class="mb-3 text-white">Kelola Pengaduan Sekolah</h3>
                <p class="text-white">
                    Akses dashboard admin untuk memantau semua pengaduan,
                    mengatur status, dan memastikan setiap laporan ditangani
                    dengan baik.
                </p>
                @elseif(auth()->user()->peran === 'petugas')
                <h3 class="mb-3 text-white">Tindaklanjuti Pengaduan</h3>
                <p class="text-white">
                    Lihat daftar pengaduan dan kelola penanganan secara cepat
                    agar solusi bisa diberikan pada siswa dan orangtua.
                </p>
                @else
                <h3 class="mb-3 text-white">Akses Dashboard Anda</h3>
                <p class="text-white">
                    Masuk ke area pengguna untuk melihat informasi dan
                    pengaduan yang sesuai peran Anda.
                </p>
                @endif
                @endguest

                <div class="mt-4">
                    @guest
                    <a href="{{ route('login') }}" class="main-btn">
                        Login Sekarang
                    </a>
                    @else
                    @if(auth()->user()->peran === 'orangtua')
                    <a href="{{ route('orangtua.pengaduan.create') }}" class="main-btn">
                        Buat Pengaduan
                    </a>
                    @elseif(auth()->user()->peran === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="main-btn">
                        Dashboard Admin
                    </a>
                    @elseif(auth()->user()->peran === 'petugas')
                    <a href="{{ route('petugas.pengaduan.index') }}" class="main-btn">
                        Daftar Pengaduan
                    </a>
                    @else
                    <a href="{{ route('home') }}" class="main-btn">
                        Dashboard
                    </a>
                    @endif
                    @endguest
                </div>
            </div>

            <!-- GAMBAR -->
            <div class="cta_image d-none d-lg-block">
                <img src="{{ asset('landing/assets/images/hape-page.png') }}"
                    style="max-height:300px;">
            </div>

        </div>
    </div>
</section>