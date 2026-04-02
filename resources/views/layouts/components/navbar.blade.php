<nav class="navbar default-layout-navbar fixed-top d-flex flex-row shadow-sm">
    <!-- LOGO -->
    <div class="navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo" href="@if(auth()->user()->peran === 'admin')
                        {{ route('admin.dashboard') }}
                    @elseif(auth()->user()->peran === 'petugas')
                        {{ route('petugas.dashboard') }}
                    @elseif(auth()->user()->peran === 'orangtua')
                        {{ route('orangtua.dashboard') }}
                    @endif">
            <img src="{{ asset('admin/assets/images/schoolcare.png') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="@if(auth()->user()->peran === 'admin')
                        {{ route('admin.dashboard') }}
                    @elseif(auth()->user()->peran === 'petugas')
                        {{ route('petugas.dashboard') }}
                    @elseif(auth()->user()->peran === 'orangtua')
                        {{ route('orangtua.dashboard') }}
                    @endif">
            <img src="{{ asset('admin/assets/images/logo-schoolcare1.png') }}" alt="logo" />
        </a>
    </div>

    <!-- RIGHT MENU -->
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

        <!-- TOGGLE SIDEBAR -->
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right align-items-center">

            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle"
                    href="#" data-bs-toggle="dropdown">
                    <i class="mdi mdi-bell-outline fs-5"></i>

                    @if($notifCount > 0)
                    <span class="count-symbol bg-danger"></span>
                    @endif
                </a>

                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list">

                    {{-- HEADER --}}
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <h6 class="mb-0 fw-bold">Notifikasi</h6>

                        <div class="d-flex gap-2">
                            <button onclick="markAllRead()" class="btn btn-sm btn-light">
                                Tandai semua
                            </button>

                            <button onclick="hapusSemuaNotif()" class="btn btn-sm btn-danger">
                                Hapus Semua
                            </button>
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>

                    {{-- LIST --}}
                    @forelse($notifications as $notif)
                    <a href="{{ route(auth()->user()->peran.'.pengaduan.show', $notif->pengaduan_id) }}"
                        class="dropdown-item preview-item d-flex justify-content-between align-items-start {{ !$notif->sudah_dibaca ? 'bg-light' : '' }}"
                        onclick="event.preventDefault(); tandaiDibaca({{ $notif->notifikasi_id }}, this.href)">

                        <div class="d-flex">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-primary">
                                    <i class="mdi mdi-bell-ring-outline"></i>
                                </div>
                            </div>

                            <div class="preview-item-content ms-2">
                                <p class="mb-1 fw-semibold">{{ $notif->pesan }}</p>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($notif->tanggal_dikirim)->diffForHumans() }}
                                </small>
                            </div>
                        </div>

                        {{-- ❌ DELETE --}}
                        <button onclick="hapusNotif(event, {{ $notif->notifikasi_id }})"
                            class="btn btn-sm text-danger">
                            ✕
                        </button>

                    </a>
                    @empty
                    <p class="text-center text-muted py-3 mb-0">
                        Tidak ada notifikasi
                    </p>
                    @endforelse

                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                    href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('admin/assets/images/faces/face1.jpg') }}"
                        class="rounded-circle" width="32" height="32">
                    <span class="fw-semibold d-none d-md-inline">
                        {{ auth()->user()->name }}
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-end navbar-dropdown">
                    <span class="dropdown-item-text fw-bold text-center">
                        {{ auth()->user()->role }}
                    </span>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                        <i class="mdi mdi-account me-2 text-primary"></i> Profil
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger">
                            <i class="mdi mdi-logout me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>

        </ul>
    </div>
</nav>

<script>
    function tandaiDibaca(id, url) {
        fetch(`/notifikasi/baca/${id}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        }).then(() => {
            window.location.href = url;
        });
    }

    function markAllRead() {
        fetch("{{ route('notifikasi.bacaSemua') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        }).then(() => location.reload());
    }

    function hapusSemuaNotif() {
        if (!confirm('Yakin ingin menghapus SEMUA notifikasi?')) return;

        fetch("{{ route('notifikasi.hapusSemua') }}", {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        }).then(() => location.reload());
    }

    function hapusNotif(e, id) {
        e.stopPropagation();

        if (!confirm('Hapus notifikasi ini?')) return;

        fetch(`/notifikasi/${id}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        }).then(() => location.reload());
    }
</script>