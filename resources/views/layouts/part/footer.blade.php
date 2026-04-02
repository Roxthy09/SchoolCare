<section id="footer" class="footer_area pt-75 pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <!-- AJAKAN -->
                <div class="footer_subscribe text-center">
                    <h3 class="subscribe_title">Sampaikan Pengaduan Anda</h3>
                    <p>
                        Punya keluhan atau saran untuk sekolah? 
                        Sampaikan langsung melalui sistem pengaduan SchoolCare 
                        agar segera ditindaklanjuti.
                    </p>

                    <div class="">
                        @auth
                            <a href="{{ route(auth()->user()->peran.'.pengaduan.index') }}" class="main-btn">
                                Lihat Pengaduan Saya
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="main-btn">
                                Login untuk Mengadu
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- SOSIAL -->
                <div class="footer_social text-center mt-60">
                    <ul>
                        <li><a href="#"><span class="lni lni-facebook-filled"></span></a></li>
                        <li><a href="#"><span class="lni lni-instagram-filled"></span></a></li>
                        <li><a href="#"><span class="lni lni-youtube"></span></a></li>
                        <li><a href="#"><span class="lni lni-envelope"></span></a></li>
                    </ul>
                </div>

                <!-- COPYRIGHT -->
                <div class="footer_copyright text-center mt-55">
                    <p>
                        © {{ date('Y') }} <strong>SchoolCare</strong> - Sistem Pengaduan Sekolah <br>
                        Dibuat untuk meningkatkan komunikasi antara orang tua dan pihak sekolah.
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>