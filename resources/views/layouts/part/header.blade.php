<section class="header_area">
    <div class="header_navbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav w-100 d-flex align-items-center justify-content-between">

                                <!-- KIRI -->
                                <li class="active text-start brand-item">
                                    <a href="#" class="brand-text">
                                        <span class="school">School</span><span class="care">care</span>
                                    </a>
                                </li>

                                <!-- KANAN -->
                                <div class="d-flex align-items-center menu-kanan">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="#home">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#features">Feature</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#about">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#pricing">Alur Pengaduan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#blog">Info</a>
                                    </li>
                                    @guest
                                    <li class="ms-3">
                                        <a href="{{ route('login') }}" class="main-btn">
                                            Login
                                        </a>
                                    </li>
                                    @endguest

                                    @auth
                                    <li class=" ms-3">
                                        <a href=" @if(auth()->user()->peran === 'admin')
                                                        {{ route('admin.dashboard') }}
                                                    @elseif(auth()->user()->peran === 'petugas')
                                                        {{ route('petugas.dashboard') }}
                                                    @elseif(auth()->user()->peran === 'orangtua')
                                                        {{ route('orangtua.dashboard') }}
                                                    @endif
                                                " class="main-btn main-btn-2">
                                            <span class="dashboard">Dashboard</span>
                                        </a>
                                    </li>
                                    @endauth

                                </div>

                            </ul>
                        </div> <!-- navbar collapse -->
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- header navbar -->

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
</section>