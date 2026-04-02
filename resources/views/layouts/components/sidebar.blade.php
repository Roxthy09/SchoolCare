<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav d-flex flex-column h-100">

        {{-- PROFILE --}}
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('admin/assets/images/faces/face1.jpg') }}" alt="profile" />
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">
                        {{ auth()->user()->name }}
                    </span>
                    <span clasAVAs="text-secondary text-small text-capitalize">
                        {{ auth()->user()->peran }}
                    </span>
                </div>
                <i class="mdi mdi-account-check text-success nav-profile-badge"></i>
            </a>
        </li>

        {{-- DASHBOARD --}}
        <li class="nav-item">
            <a class="nav-link"
                href="
                    @if(auth()->user()->peran === 'admin')
                        {{ route('admin.dashboard') }}
                    @elseif(auth()->user()->peran === 'petugas')
                        {{ route('petugas.dashboard') }}
                    @elseif(auth()->user()->peran === 'orangtua')
                        {{ route('orangtua.dashboard') }}
                    @endif
                ">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        {{-- MENU ADMIN --}}
        @if(auth()->user()->peran === 'admin')
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#admin-menu">
                <span class="menu-title">Manajemen Data</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-database menu-icon"></i>
            </a>
            <div class="collapse" id="admin-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kategori.index') }}">
                            Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pengaduan.index') }}">
                            Pengaduan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orangtua.index') }}">
                            Orang Tua
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link"
                href="{{ route('users.index') }}">
                <span class="menu-title">User</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @endif

        {{-- MENU PETUGAS --}}
        @if(auth()->user()->peran === 'petugas')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('petugas.pengaduan.index') }}">
                <span class="menu-title">Pengaduan Masuk</span>
                <i class="mdi mdi-email-alert menu-icon"></i>
            </a>
        </li>
        @endif

        {{-- MENU ORANG TUA --}}
        @if(auth()->user()->peran === 'orangtua')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('orangtua.pengaduan.index') }}">
                <span class="menu-title">Pengaduan Saya</span>
                <i class="mdi mdi-file-document menu-icon"></i>
            </a>
        </li>
        @endif
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('welcome') }}">
                <span class="menu-title">Landing Page</span>
                <i class="mdi mdi-web menu-icon"></i>
            </a>
        </li>

    </ul>
</nav>