@extends('layouts.landing-page')

@section('title', $pengaduan->judul . ' | Pengaduan')

@section('content')

<div id="home" class="header_hero d-lg-flex align-items-center">
    <img class="shape shape-1" src="{{asset('landing/assets/images/shape-1.svg')}}" alt="shape">
    <img class="shape shape-2" src="{{asset('landing/assets/images/shape-2.svg')}}" alt="shape">
    <img class="shape shape-3" src="{{asset('landing/assets/images/shape-3.svg')}}" alt="shape">
</div>


<div class="pg-detail-page">
    <div class="container">
        <div class="pg-detail-layout">

            {{-- ===== KOLOM KIRI - KONTEN UTAMA ===== --}}
            <div class="pg-detail-main">

                {{-- HEADER --}}
                <div class="pg-detail-header">
                    <div class="pg-detail-meta-top">
                        <span class="pg-status-pill pg-status-{{ $pengaduan->status }}">
                            @if($pengaduan->status == 'selesai')
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            Selesai
                            @elseif($pengaduan->status == 'dalam_proses')
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="23 4 23 10 17 10" />
                                <polyline points="1 20 1 14 7 14" />
                                <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15" />
                            </svg>
                            Dalam Proses
                            @elseif($pengaduan->status == 'dibatalkan')
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                            Dibatalkan
                            @else
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            Menunggu
                            @endif
                        </span>
                        <span class="pg-detail-date">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            {{ \Carbon\Carbon::parse($pengaduan->tanggal_dibuat)->translatedFormat('d F Y') }}
                        </span>
                    </div>
                    <h1 class="pg-detail-title">{{ $pengaduan->judul }}</h1>
                </div>

                {{-- GAMBAR --}}
                @if($pengaduan->lampiran)
                <div class="pg-detail-image-wrap">
                    <img src="{{ asset('storage/'.$pengaduan->lampiran) }}"
                        alt="{{ $pengaduan->judul }}"
                        class="pg-detail-image">
                </div>
                @endif

                {{-- DESKRIPSI --}}
                <div class="pg-detail-card">
                    <div class="pg-detail-card-label">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                            <polyline points="10 9 9 9 8 9" />
                        </svg>
                        Deskripsi Pengaduan
                    </div>
                    <div class="pg-detail-desc">
                        {!! nl2br(e($pengaduan->deskripsi)) !!}
                    </div>
                </div>

                {{-- TIMELINE STATUS --}}
                <div class="pg-detail-card">
                    <div class="pg-detail-card-label">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                        </svg>
                        Riwayat Status
                    </div>
                    <div class="pg-timeline">
                        <div class="pg-timeline-item pg-tl-done">
                            <div class="pg-tl-dot"></div>
                            <div class="pg-tl-content">
                                <span class="pg-tl-title">Pengaduan Dikirim</span>
                                <span class="pg-tl-date">{{ \Carbon\Carbon::parse($pengaduan->tanggal_dibuat)->translatedFormat('d M Y, H:i') }}</span>
                            </div>
                        </div>
                        <div class="pg-timeline-item {{ in_array($pengaduan->status, ['dalam_proses','selesai']) ? 'pg-tl-done' : 'pg-tl-pending' }}">
                            <div class="pg-tl-dot"></div>
                            <div class="pg-tl-content">
                                <span class="pg-tl-title">Sedang Diproses</span>
                                <span class="pg-tl-date">
                                    @if(in_array($pengaduan->status, ['dalam_proses','selesai']))
                                    Pengaduan sedang ditangani
                                    @else
                                    Menunggu diproses
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="pg-timeline-item {{ $pengaduan->status == 'selesai' ? 'pg-tl-done' : 'pg-tl-pending' }}">
                            <div class="pg-tl-dot"></div>
                            <div class="pg-tl-content">
                                <span class="pg-tl-title">Selesai</span>
                                <span class="pg-tl-date">
                                    @if($pengaduan->status == 'selesai')
                                    Pengaduan telah diselesaikan
                                    @else
                                    Belum selesai
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== KONFIRMASI ORANGTUA ===== --}}
                @auth
                @if($pengaduan->status == 'selesai' && $pengaduan->user_id == auth()->id() && ($pengaduan->konfirmasi_orangtua == 'menunggu' || is_null($pengaduan->konfirmasi_orangtua)))
                <div class="pg-detail-card pg-konfirmasi-card">
                    <div class="pg-detail-card-label">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                        Konfirmasi Pengaduan
                    </div>
                    <p class="pg-konfirmasi-desc">Apakah hasil penanganan pengaduan ini sudah sesuai?</p>
                    <form action="{{ route('pengaduan.konfirmasi', $pengaduan->pengaduan_id) }}" method="POST">
                        @csrf
                        <div class="pg-konfirmasi-actions">
                            <button name="konfirmasi" value="sesuai" class="pg-btn-konfirmasi pg-btn-sesuai">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                                Sesuai
                            </button>
                            <button name="konfirmasi" value="tidak_sesuai" class="pg-btn-konfirmasi pg-btn-tidak-sesuai">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                                Tidak Sesuai
                            </button>
                        </div>
                    </form>
                </div>
                @endif
                @endauth

                {{-- ===== SECTION RATING ===== --}}
                @auth
                @if($pengaduan->status == 'selesai' && $pengaduan->konfirmasi_orangtua == 'sesuai' && $pengaduan->user_id == auth()->id())

                @if($pengaduan->rating)
                {{-- SUDAH ADA RATING - TAMPILKAN HASIL --}}
                <div class="pg-detail-card pg-review-card">
                    <div class="pg-detail-card-label">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                        </svg>
                        Penilaian Anda
                    </div>
                    <div class="pg-review-body">
                        <div class="pg-review-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <svg width="22" height="22" viewBox="0 0 24 24"
                                fill="{{ $i <= $pengaduan->rating->rating ? '#f59e0b' : '#e5e7eb' }}"
                                stroke="{{ $i <= $pengaduan->rating->rating ? '#f59e0b' : '#d1d5db' }}"
                                stroke-width="1">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                </svg>
                                @endfor
                                <span class="pg-review-score">{{ $pengaduan->rating->rating }}/5</span>
                        </div>
                        @if($pengaduan->rating->komentar)
                        <blockquote class="pg-review-quote">
                            "{{ $pengaduan->rating->komentar }}"
                        </blockquote>
                        @endif
                    </div>
                </div>

                @else
                {{-- BELUM ADA RATING - TAMPILKAN FORM --}}
                <div class="pg-detail-card pg-form-card" id="form-rating">
                    <div class="pg-detail-card-label">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                        </svg>
                        Beri Penilaian
                    </div>

                    @if(session('success'))
                    <div class="pg-alert pg-alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="pg-alert pg-alert-error">
                        {{ session('error') }}
                    </div>
                    @endif
                    {{-- ERROR KATA KASAR --}}
                    @if($errors->has('komentar'))
                    <div class="pg-badword-card" id="badwordCard">
                        <div class="pg-badword-card-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                        </div>
                        <div class="pg-badword-card-body">
                            <div class="pg-badword-card-title">Komentar Tidak Dapat Dikirim</div>
                            <div class="pg-badword-card-desc">{{ $errors->first('komentar') }}</div>
                        </div>
                        <button type="button" class="pg-badword-card-close" onclick="document.getElementById('badwordCard').style.display='none'">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                        </button>
                    </div>
                    @endif

                    <form action="{{ route('rating.store', $pengaduan->pengaduan_id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->pengaduan_id }}">

                        <div class="pg-form-group">
                            <label class="pg-form-label">Rating Kepuasan</label>
                            <div class="pg-star-input" id="starInput">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" class="pg-star-btn" data-val="{{ $i }}" onclick="setRating({{ $i }})">
                                    <svg width="32" height="32" viewBox="0 0 24 24"
                                        fill="#e5e7eb" stroke="#d1d5db" stroke-width="1"
                                        class="pg-star-svg" id="star-{{ $i }}">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                    </svg>
                                    </button>
                                    @endfor
                            </div>
                            <input type="hidden" name="rating" id="ratingValue" required>
                            <p class="pg-star-hint" id="starHint">Pilih bintang untuk menilai</p>
                            @error('rating')
                            <span class="pg-form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="pg-form-group">
                            <label class="pg-form-label">Komentar <span class="pg-form-optional">(opsional)</span></label>
                            <textarea
                                name="komentar"
                                class="pg-form-textarea @error('komentar') is-error @enderror"
                                rows="4"
                                placeholder="Bagikan pengalaman Anda mengenai penanganan pengaduan ini...">{{ old('komentar') }}</textarea>

                            {{-- WARNING KATA KASAR --}}
                            <div id="badWordWarning" class="pg-badword-warning" style="display:none;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />
                                </svg>
                                Komentar mengandung kata yang tidak pantas. Mohon gunakan bahasa yang sopan.
                            </div>

                            @error('komentar')
                            <span class="pg-form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="pg-btn-primary" id="submitBtn" disabled>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="22" y1="2" x2="11" y2="13" />
                                <polygon points="22 2 15 22 11 13 2 9 22 2" />
                            </svg>
                            Kirim Penilaian
                        </button>
                    </form>
                </div>
                @endif

                @endif
                @endauth

                {{-- BACK BUTTON --}}
                <div class="pg-back-section">
                    <a href="{{ url()->previous() }}" class="pg-btn-back">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="19" y1="12" x2="5" y2="12" />
                            <polyline points="12 19 5 12 12 5" />
                        </svg>
                        Kembali
                    </a>
                </div>

            </div>{{-- end main --}}

            {{-- ===== KOLOM KANAN - SIDEBAR ===== --}}
            <div class="pg-detail-sidebar">

                {{-- INFO CARD --}}
                <div class="pg-sidebar-card">
                    <div class="pg-sidebar-card-title">Informasi Pengaduan</div>
                    <div class="pg-info-list">
                        <div class="pg-info-item">
                            <span class="pg-info-label">ID Pengaduan</span>
                            <span class="pg-info-value pg-info-mono">#{{ str_pad($pengaduan->pengaduan_id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="pg-info-item">
                            <span class="pg-info-label">Status</span>
                            <span class="pg-status-pill pg-status-{{ $pengaduan->status }} pg-status-sm">
                                {{ ucfirst(str_replace('_',' ',$pengaduan->status)) }}
                            </span>
                        </div>
                        <div class="pg-info-item">
                            <span class="pg-info-label">Tanggal Dibuat</span>
                            <span class="pg-info-value">{{ \Carbon\Carbon::parse($pengaduan->tanggal_dibuat)->translatedFormat('d M Y') }}</span>
                        </div>
                        <div class="pg-info-item">
                            <span class="pg-info-label">Konfirmasi</span>
                            <span class="pg-info-value">
                                @if($pengaduan->konfirmasi_orangtua == 'sesuai')
                                <span style="color:#15803d;font-weight:600;">✔ Sesuai</span>
                                @elseif($pengaduan->konfirmasi_orangtua == 'tidak_sesuai')
                                <span style="color:#b91c1c;font-weight:600;">✘ Tidak Sesuai</span>
                                @else
                                <span style="color:#9ca3af;">Menunggu</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                {{-- HASIL RATING DI SIDEBAR --}}
                @if($pengaduan->rating)
                <div class="pg-sidebar-card">
                    <div class="pg-sidebar-card-title">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:middle;margin-right:4px;">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                        </svg>
                        Hasil Review
                    </div>
                    <div class="pg-review-body">
                        <div class="pg-review-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <svg width="20" height="20" viewBox="0 0 24 24"
                                fill="{{ $i <= $pengaduan->rating->rating ? '#f59e0b' : '#e5e7eb' }}"
                                stroke="{{ $i <= $pengaduan->rating->rating ? '#f59e0b' : '#d1d5db' }}"
                                stroke-width="1">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                </svg>
                                @endfor
                                <span class="pg-review-score">{{ $pengaduan->rating->rating }}/5</span>
                        </div>
                        @if($pengaduan->rating->komentar)
                        <blockquote class="pg-review-quote">
                            "{{ $pengaduan->rating->komentar }}"
                        </blockquote>
                        @endif
                    </div>
                </div>
                @endif

                {{-- PENGADUAN LAINNYA --}}
                @if(isset($pengaduanLain) && $pengaduanLain->count())
                <div class="pg-sidebar-card">
                    <div class="pg-sidebar-card-title">Pengaduan Lainnya</div>
                    <div class="pg-related-list">
                        @foreach($pengaduanLain as $lain)
                        <a href="{{ route('pengaduan.show', $lain->pengaduan_id) }}" class="pg-related-item">
                            <div class="pg-related-dot pg-status-dot-{{ $lain->status }}"></div>
                            <div class="pg-related-content">
                                <span class="pg-related-title">{{ Str::limit($lain->judul, 50) }}</span>
                                <span class="pg-related-date">{{ \Carbon\Carbon::parse($lain->tanggal_dibuat)->translatedFormat('d M Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>{{-- end sidebar --}}

        </div>{{-- end layout --}}
    </div>
</div>

{{-- ===================== CSS ===================== --}}
<style>
    /* Bad Word Card */
.pg-badword-card {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    background: #fff7ed;
    border: 1.5px solid #fed7aa;
    border-left: 5px solid #f97316;
    border-radius: 14px;
    padding: 18px 20px;
    margin-bottom: 20px;
    position: relative;
    animation: pg-shake 0.4s ease;
}

@keyframes pg-shake {
    0%   { transform: translateX(0); }
    20%  { transform: translateX(-6px); }
    40%  { transform: translateX(6px); }
    60%  { transform: translateX(-4px); }
    80%  { transform: translateX(4px); }
    100% { transform: translateX(0); }
}

.pg-badword-card-icon {
    color: #f97316;
    flex-shrink: 0;
    margin-top: 2px;
}

.pg-badword-card-body {
    flex: 1;
}

.pg-badword-card-title {
    font-size: 14px;
    font-weight: 700;
    color: #c2410c;
    margin-bottom: 4px;
}

.pg-badword-card-desc {
    font-size: 13px;
    color: #9a3412;
    line-height: 1.6;
}

.pg-badword-card-close {
    background: none;
    border: none;
    color: #f97316;
    cursor: pointer;
    padding: 0;
    flex-shrink: 0;
    opacity: 0.7;
    transition: opacity 0.15s;
}

.pg-badword-card-close:hover {
    opacity: 1;
}

/* Warning real-time */
.pg-badword-warning {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 8px;
    padding: 10px 14px;
    background: #fff7ed;
    border: 1px solid #fed7aa;
    border-radius: 8px;
    font-size: 13px;
    color: #c2410c;
}

    

    /* Page Heading */
    .pg-page-heading {
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        padding: 20px 0;
    }

    .pg-page-heading-title {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 4px 0;
    }

    .pg-page-heading-sub {
        font-size: 14px;
        color: #6b7280;
        margin: 0;
    }

    .pg-detail-page {
        background: transparent;
        min-height: 100vh;
        padding-bottom: 60px;
    }

    /* Layout */
    .pg-detail-layout {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 24px;
        margin-top: 32px;
    }

    @media (max-width: 900px) {
        .pg-detail-layout {
            grid-template-columns: 1fr;
        }

        .pg-detail-sidebar {
            order: -1;
        }
    }

    /* Header */
    .pg-detail-header {
        background: #fff;
        border-radius: 16px;
        padding: 28px 32px;
        margin-bottom: 20px;
        border: 1px solid #e5e7eb;
    }

    .pg-detail-meta-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .pg-detail-date {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        color: #9ca3af;
    }

    .pg-detail-title {
        font-size: 22px;
        font-weight: 700;
        color: #111827;
        line-height: 1.4;
        margin: 0;
    }

    /* Status Pill */
    .pg-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 99px;
        letter-spacing: 0.2px;
    }

    .pg-status-pill.pg-status-sm {
        font-size: 11px;
        padding: 3px 10px;
    }

    .pg-status-selesai {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .pg-status-dalam_proses {
        background: #dbeafe;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }

    .pg-status-dibatalkan {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .pg-status-menunggu {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }

    /* Image */
    .pg-detail-image-wrap {
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 20px;
        border: 1px solid #e5e7eb;
        max-height: 400px;
    }

    .pg-detail-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Cards */
    .pg-detail-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px 28px;
        margin-bottom: 20px;
        border: 1px solid #e5e7eb;
    }

    .pg-detail-card-label {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f3f4f6;
    }

    .pg-detail-desc {
        font-size: 15px;
        color: #374151;
        line-height: 1.8;
    }

    /* Timeline */
    .pg-timeline {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .pg-timeline-item {
        display: flex;
        gap: 16px;
        padding-bottom: 24px;
        position: relative;
    }

    .pg-timeline-item:last-child {
        padding-bottom: 0;
    }

    .pg-timeline-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 7px;
        top: 20px;
        bottom: 0;
        width: 2px;
        background: #e5e7eb;
    }

    .pg-tl-done:not(:last-child)::before {
        background: #bbf7d0;
    }

    .pg-tl-dot {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 2px solid #e5e7eb;
        background: #fff;
        flex-shrink: 0;
        margin-top: 2px;
        position: relative;
        z-index: 1;
    }

    .pg-tl-done .pg-tl-dot {
        background: #22c55e;
        border-color: #22c55e;
    }

    .pg-tl-pending .pg-tl-dot {
        background: #fff;
        border-color: #d1d5db;
    }

    .pg-tl-content {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .pg-tl-title {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
    }

    .pg-tl-pending .pg-tl-title {
        color: #9ca3af;
    }

    .pg-tl-date {
        font-size: 12px;
        color: #9ca3af;
    }

    /* Review */
    .pg-review-body {
        padding-top: 4px;
    }

    .pg-review-stars {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 12px;
    }

    .pg-review-score {
        font-size: 14px;
        font-weight: 600;
        color: #f59e0b;
        margin-left: 6px;
    }

    .pg-review-quote {
        font-size: 15px;
        color: #374151;
        font-style: italic;
        line-height: 1.7;
        border-left: 3px solid #e5e7eb;
        padding-left: 16px;
        margin: 0;
    }

    /* Form */
    .pg-form-group {
        margin-bottom: 20px;
    }

    .pg-form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .pg-form-optional {
        font-weight: 400;
        color: #9ca3af;
    }

    .pg-star-input {
        display: flex;
        gap: 6px;
        margin-bottom: 8px;
    }

    .pg-star-btn {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        transition: transform 0.15s;
    }

    .pg-star-btn:hover {
        transform: scale(1.15);
    }

    .pg-star-hint {
        font-size: 12px;
        color: #9ca3af;
        margin: 0;
    }

    .pg-form-textarea {
        width: 100%;
        border: 1.5px solid #e5e7eb;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 14px;
        color: #374151;
        line-height: 1.6;
        resize: vertical;
        transition: border-color 0.2s;
        font-family: inherit;
        box-sizing: border-box;
    }

    .pg-form-textarea:focus {
        outline: none;
        border-color: #3b82f6;
    }

    .pg-form-textarea.is-error {
        border-color: #ef4444;
    }

    .pg-form-error {
        font-size: 12px;
        color: #ef4444;
        margin-top: 4px;
        display: block;
    }

    .pg-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: #3b82f6;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, opacity 0.2s, transform 0.15s;
    }

    .pg-btn-primary:hover:not(:disabled) {
        background: #2563eb;
        transform: translateY(-1px);
    }

    .pg-btn-primary:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Alert */
    .pg-alert {
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 14px;
        margin-bottom: 16px;
    }

    .pg-alert-success {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .pg-alert-error {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    /* Back */
    .pg-back-section {
        margin-top: 8px;
    }

    .pg-btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #6b7280;
        text-decoration: none;
        transition: color 0.15s;
    }

    .pg-btn-back:hover {
        color: #3b82f6;
    }

    /* Sidebar */
    .pg-sidebar-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e5e7eb;
        margin-bottom: 20px;
    }

    .pg-sidebar-card-title {
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f3f4f6;
    }

    .pg-info-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .pg-info-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .pg-info-label {
        font-size: 13px;
        color: #9ca3af;
    }

    .pg-info-value {
        font-size: 13px;
        font-weight: 500;
        color: #374151;
    }

    .pg-info-mono {
        font-family: monospace;
        font-size: 12px;
        background: #f3f4f6;
        padding: 2px 8px;
        border-radius: 6px;
    }

    /* Related */
    .pg-related-list {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .pg-related-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 10px 0;
        text-decoration: none;
        border-bottom: 1px solid #f3f4f6;
        transition: opacity 0.15s;
    }

    .pg-related-item:last-child {
        border-bottom: none;
    }

    .pg-related-item:hover {
        opacity: 0.7;
    }

    .pg-related-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 5px;
    }

    .pg-status-dot-selesai {
        background: #22c55e;
    }

    .pg-status-dot-dalam_proses {
        background: #3b82f6;
    }

    .pg-status-dot-dibatalkan {
        background: #ef4444;
    }

    .pg-status-dot-menunggu {
        background: #f59e0b;
    }

    .pg-related-content {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .pg-related-title {
        font-size: 13px;
        color: #374151;
        font-weight: 500;
        line-height: 1.4;
    }

    .pg-related-date {
        font-size: 11px;
        color: #9ca3af;
    }


    /* Konfirmasi */
    .pg-konfirmasi-card {
        border-left: 4px solid #f59e0b;
    }

    .pg-konfirmasi-desc {
        font-size: 15px;
        color: #374151;
        margin: 0 0 20px 0;
    }

    .pg-konfirmasi-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .pg-btn-konfirmasi {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.15s;
    }

    .pg-btn-konfirmasi:hover {
        opacity: 0.85;
        transform: translateY(-1px);
    }

    .pg-btn-sesuai {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .pg-btn-sesuai:hover {
        background: #bbf7d0;
    }

    .pg-btn-tidak-sesuai {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .pg-btn-tidak-sesuai:hover {
        background: #fecaca;
    }
</style>

{{-- ===================== JS ===================== --}}
<script>
    const labels = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'];

    function setRating(val) {
        document.getElementById('ratingValue').value = val;
        document.getElementById('starHint').textContent = labels[val];
        document.getElementById('submitBtn').disabled = false;

        for (let i = 1; i <= 5; i++) {
            const svg = document.getElementById('star-' + i);
            if (i <= val) {
                svg.setAttribute('fill', '#f59e0b');
                svg.setAttribute('stroke', '#f59e0b');
            } else {
                svg.setAttribute('fill', '#e5e7eb');
                svg.setAttribute('stroke', '#d1d5db');
            }
        }
    }

    document.querySelectorAll('.pg-star-btn').forEach(btn => {
        const val = parseInt(btn.dataset.val);
        btn.addEventListener('mouseenter', () => {
            for (let i = 1; i <= 5; i++) {
                const svg = document.getElementById('star-' + i);
                if (!svg) return;
                if (i <= val) {
                    svg.setAttribute('fill', '#fcd34d');
                    svg.setAttribute('stroke', '#fcd34d');
                } else {
                    const current = parseInt(document.getElementById('ratingValue').value || 0);
                    svg.setAttribute('fill', i <= current ? '#f59e0b' : '#e5e7eb');
                    svg.setAttribute('stroke', i <= current ? '#f59e0b' : '#d1d5db');
                }
            }
        });
        btn.addEventListener('mouseleave', () => {
            const current = parseInt(document.getElementById('ratingValue').value || 0);
            for (let i = 1; i <= 5; i++) {
                const svg = document.getElementById('star-' + i);
                if (!svg) return;
                svg.setAttribute('fill', i <= current ? '#f59e0b' : '#e5e7eb');
                svg.setAttribute('stroke', i <= current ? '#f59e0b' : '#d1d5db');
            }
        });
    });

const badWords = [
    'anjing', 'bangsat', 'babi', 'bajingan', 'goblok',
    'tolol', 'idiot', 'bodoh', 'kampret', 'keparat',
    'kontol', 'memek', 'ngentot', 'brengsek', 'sialan',
    'asu', 'jancok', 'dancok', 'cok', 'jangkrik',
    'celeng', 'monyet', 'bedebah', 'setan', 'iblis',
];

function containsBadWord(text) {
    const lower = text.toLowerCase();
    return badWords.some(word => lower.includes(word.toLowerCase()));
}

const komentarTextarea = document.querySelector('textarea[name="komentar"]');
const submitBtn = document.getElementById('submitBtn');
const badWordWarning = document.getElementById('badWordWarning');

if (komentarTextarea) {
    komentarTextarea.addEventListener('input', function () {
        const hasBadWord = containsBadWord(this.value);

        if (hasBadWord) {
            // Tampilkan warning real-time
            if (badWordWarning) badWordWarning.style.display = 'flex';

            // Highlight textarea merah
            this.style.borderColor = '#ef4444';

            // Nonaktifkan tombol kirim
            submitBtn.disabled = true;
        } else {
            // Sembunyikan warning
            if (badWordWarning) badWordWarning.style.display = 'none';

            // Kembalikan border normal
            this.style.borderColor = '#e5e7eb';

            // Aktifkan tombol jika rating sudah dipilih
            const ratingVal = document.getElementById('ratingValue').value;
            if (ratingVal) submitBtn.disabled = false;
        }
    });

    // Blokir submit jika masih ada kata kasar (double check)
    const form = komentarTextarea.closest('form');
    if (form) {
        form.addEventListener('submit', function (e) {
            if (containsBadWord(komentarTextarea.value)) {
                e.preventDefault();

                // Tampilkan card error paksa
                let existing = document.getElementById('badwordCardForce');
                if (!existing) {
                    const card = document.createElement('div');
                    card.id = 'badwordCardForce';
                    card.className = 'pg-badword-card';
                    card.style.marginBottom = '16px';
                    card.innerHTML = `
                        <div class="pg-badword-card-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="8" x2="12" y2="12"/>
                                <line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                        </div>
                        <div class="pg-badword-card-body">
                            <div class="pg-badword-card-title">Komentar Tidak Dapat Dikirim</div>
                            <div class="pg-badword-card-desc">Komentar mengandung kata yang tidak pantas. Mohon gunakan bahasa yang sopan sebelum mengirim.</div>
                        </div>
                        <button type="button" class="pg-badword-card-close" onclick="document.getElementById('badwordCardForce').remove()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"/>
                                <line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    `;
                    form.insertBefore(card, form.firstChild);
                }

                // Scroll ke card error
                form.scrollIntoView({ behavior: 'smooth', block: 'start' });
                return false;
            }
        });
    }
}
</script>

@endsection