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
                                        <a class="page-scroll" href="#home">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#features">Fitur</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#about">Tentang</a>
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

</section>