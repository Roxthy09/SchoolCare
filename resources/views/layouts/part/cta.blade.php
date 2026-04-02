<section id="cta" class="cta_area mt-80">
        <div class="container">
            <div class="cta_inner d-lg-flex align-items-center justify-content-between p-5"
                style="background: linear-gradient(135deg, #6a11cb, #2575fc); border-radius:20px;">

                <!-- TEXT -->
                <div class="cta_content">
                    <h3 class="mb-3 text-white">Laporkan Keluhan Sekolah Anda</h3>
                    <p class="text-white">
                        Sampaikan pengaduan Anda dengan mudah dan cepat.
                        Sistem kami akan membantu memastikan laporan Anda
                        ditangani secara transparan oleh pihak sekolah.
                    </p>

                    <div class="mt-4">
                        @guest
                        <a href="{{ route('login') }}" class="main-btn">
                            Login Sekarang
                        </a>
                        @else
                        <a href="{{ route(auth()->user()->peran.'.pengaduan.create') }}" class="main-btn">
                            Buat Pengaduan
                        </a>
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