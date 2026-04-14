<div id="home" class="header_hero d-lg-flex align-items-center">
        <img class="shape shape-1" src="{{asset('landing/assets/images/shape-1.svg')}}" alt="shape">
        <img class="shape shape-2" src="{{asset('landing/assets/images/shape-2.svg')}}" alt="shape">
        <img class="shape shape-3" src="{{asset('landing/assets/images/shape-3.svg')}}" alt="shape">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="header_hero_content mt-45">

                        <h2 class="header_title wow fadeInLeftBig"
                            data-wow-duration="1.3s"
                            data-wow-delay="0.2s">

                            Sistem Pengaduan Sekolah <br>
                            <span class="text-primary">Cepat, Transparan, dan Terpercaya</span>
                        </h2>

                        <p class="wow fadeInLeftBig"
                            data-wow-duration="1.3s"
                            data-wow-delay="0.6s">

                            Sampaikan keluhan, saran, atau laporan terkait sekolah dengan mudah.
                            Orang tua dapat memantau status pengaduan secara real-time,
                            sementara pihak sekolah dapat merespon dengan cepat dan terstruktur.

                        </p>

                        <ul class="d-flex flex-wrap gap-2">

                            {{-- 🔐 BELUM LOGIN --}}
                            @guest
                            <li>
                                <a class="main-btn wow fadeInUp"
                                    data-wow-duration="1.3s"
                                    data-wow-delay="1s"
                                    href="{{ route('login') }}">
                                    Laporkan Sekarang
                                </a>
                            </li>
                            @endguest

                            {{-- ✅ SUDAH LOGIN --}}
                            @auth
                            <li>
                                <a class="main-btn wow fadeInUp"
                                    data-wow-duration="1.3s"
                                    data-wow-delay="1s"
                                    href="
                           @if(auth()->user()->peran === 'admin')
                               {{ route('admin.dashboard') }}
                           @elseif(auth()->user()->peran === 'petugas')
                               {{ route('petugas.dashboard') }}
                           @elseif(auth()->user()->peran === 'orangtua')
                               {{ route('orangtua.dashboard') }}
                           @endif
                           ">
                                    Ke Dashboard
                                </a>
                            </li>
                            @endauth

                            <li>
                                <a class="main-btn main-btn-2 page-scroll"
                                    href="#features">
                                    Pelajari Fitur
                                </a>
                            </li>

                        </ul>

                    </div>
                </div>
            </div>
        </div> <!-- container -->
        <div class="header_image d-flex align-items-end">
            <div class="image wow fadeInRightBig" data-wow-duration="1.3s" data-wow-delay="1.8s">
                <img src="{{asset('landing/assets/images/hape-landing.png')}}" alt="header App">
                <img src="{{asset('landing/assets/images/dots.svg')}}" alt="dots" class="dots">
            </div> <!-- image -->
        </div> <!-- header image -->
</div> <!-- header hero -->