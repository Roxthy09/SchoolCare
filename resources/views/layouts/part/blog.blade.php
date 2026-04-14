<section id="blog" class="blog_area pt-80 pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section_title text-center pb-25">
                    <h4 class="title">Pengaduan Terbaru</h4>
                    <p>Lihat beberapa pengaduan terbaru dari orang tua</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            @if(isset($pengaduanTerbaru) && $pengaduanTerbaru->count())
            @foreach($pengaduanTerbaru as $p)
            <div class="col-lg-4 col-md-6">
                @auth
                <a href="{{ route('pengaduan.detail', $p->pengaduan_id) }}" class="pg-card-link">
                    @else
                    <a href="javascript:void(0);" class="pg-card-link guest-detail-notice" data-message="Silakan login dulu untuk melihat detail pengaduan">
                        @endauth
                        <div class="pg-card mt-30">

                            {{-- GAMBAR --}}
                            <div class="pg-card-image">
                                @if($p->lampiran)
                                <img src="{{ asset('storage/'.$p->lampiran) }}" alt="{{ $p->judul }}">
                                @else
                                <div class="pg-card-image-placeholder">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                @endif

                                {{-- STATUS BADGE di atas gambar --}}
                                <span class="pg-status-badge pg-status-{{ $p->status }}">
                                    @if($p->status == 'selesai') ✓ Selesai
                                    @elseif($p->status == 'dalam_proses') ⟳ Dalam Proses
                                    @elseif($p->status == 'dibatalkan') ✕ Dibatalkan
                                    @else 🕐 Menunggu
                                    @endif
                                </span>
                            </div>

                            {{-- KONTEN --}}
                            <div class="pg-card-body">
                                <div class="pg-card-date">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($p->tanggal_dibuat)->translatedFormat('d M Y') }}
                                </div>

                                <h5 class="pg-card-title">{{ $p->judul }}</h5>
                                <p class="pg-card-desc">{{ Str::limit($p->deskripsi, 90) }}</p>

                                <div class="pg-card-footer">
                                    @if($p->rating)
                                    <div class="pg-card-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="{{ $i <= $p->rating->nilai ? 'star-filled' : 'star-empty' }}">★</span>
                                            @endfor
                                    </div>
                                    @endif
                                    <span class="pg-card-cta">
                                        @auth
                                            Lihat Detail
                                        @else
                                            Login dulu
                                        @endauth
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="5" y1="12" x2="19" y2="12" />
                                            <polyline points="12 5 19 12 12 19" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
            </div>
            @endforeach
            @else
            <div class="col-12 text-center py-5">
                <div class="pg-empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p>Belum ada pengaduan</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>


{{-- ====================== CSS ====================== --}}
<style>
    /* ---- Card Link ---- */
    .pg-card-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .pg-card-link:hover {
        text-decoration: none;
        color: inherit;
    }

    /* ---- Card ---- */
    .pg-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        border: 1px solid #f0f0f0;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .pg-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
    }

    /* ---- Image ---- */
    .pg-card-image {
        position: relative;
        height: 180px;
        overflow: hidden;
        background: #f5f7fa;
    }

    .pg-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .pg-card:hover .pg-card-image img {
        transform: scale(1.05);
    }

    .pg-card-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e8f4fd 0%, #d1e8f7 100%);
        color: #90b8d4;
    }

    /* ---- Status Badge ---- */
    .pg-status-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 99px;
        letter-spacing: 0.3px;
        backdrop-filter: blur(8px);
    }

    .pg-status-selesai {
        background: rgba(39, 183, 95, 0.15);
        color: #1a7a42;
        border: 1px solid rgba(39, 183, 95, 0.3);
    }

    .pg-status-dalam_proses {
        background: rgba(59, 130, 246, 0.15);
        color: #1d4ed8;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .pg-status-dibatalkan {
        background: rgba(239, 68, 68, 0.15);
        color: #b91c1c;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .pg-status-menunggu {
        background: rgba(245, 158, 11, 0.15);
        color: #92400e;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    /* ---- Body ---- */
    .pg-card-body {
        padding: 18px 20px 20px;
    }

    .pg-card-date {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        color: #9ca3af;
        margin-bottom: 8px;
    }

    .pg-card-title {
        font-size: 15px;
        font-weight: 600;
        color: #111827;
        line-height: 1.45;
        margin: 0 0 8px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .pg-card-desc {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.6;
        margin: 0 0 16px;
    }

    /* ---- Footer ---- */
    .pg-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #f3f4f6;
        padding-top: 12px;
    }

    .pg-card-stars {
        display: flex;
        gap: 2px;
        font-size: 13px;
    }

    .star-filled {
        color: #f59e0b;
    }

    .star-empty {
        color: #e5e7eb;
    }

    .pg-card-cta {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        font-weight: 600;
        color: #3b82f6;
        margin-left: auto;
        transition: gap 0.2s;
    }

    .pg-card:hover .pg-card-cta {
        gap: 8px;
    }

    /* ---- Empty State ---- */
    .pg-empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        color: #9ca3af;
        padding: 40px 0;
    }

    .pg-empty-state p {
        margin: 0;
        font-size: 15px;
    }

    /* ---- Button Outline ---- */
    .pg-btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        border: 2px solid #3b82f6;
        color: #3b82f6;
        border-radius: 99px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }

    .pg-btn-outline:hover {
        background: #3b82f6;
        color: #fff;
        text-decoration: none;
    }

    .mt-40 {
        margin-top: 40px;
    }
</style>


{{-- Modal overlay --}}
@guest
<div id="guest-modal-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
  <div style="background:#fff; border-radius:12px; padding:2rem; width:100%; max-width:360px; margin:1rem; text-align:center;">
    <div style="width:48px; height:48px; border-radius:50%; background:#FFF3CD; display:flex; align-items:center; justify-content:center; margin:0 auto 1rem;">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
        <path d="M12 2a5 5 0 1 1 0 10A5 5 0 0 1 12 2zm0 12c5 0 9 2 9 4.5V21H3v-2.5C3 16 7 14 12 14z" fill="#c07a00"/>
      </svg>
    </div>
    <p style="font-weight:600; margin:0 0 6px;">Login Diperlukan</p>
    <p id="guest-modal-message" style="font-size:13px; color:#666; margin:0 0 1.5rem;"></p>
    <div style="display:flex; gap:8px;">
      <button id="guest-modal-close" style="flex:1; padding:9px; border:1px solid #ddd; border-radius:8px; background:#f5f5f5; cursor:pointer;">Tutup</button>
      <a href="{{ route('login') }}" style="flex:2; padding:9px; border-radius:8px; background:#0d6efd; color:#fff; text-decoration:none; font-weight:500; display:flex; align-items:center; justify-content:center;">Masuk Sekarang</a>
    </div>
  </div>
</div>

<script>
  const overlay = document.getElementById('guest-modal-overlay');
  const msgEl  = document.getElementById('guest-modal-message');

  document.querySelectorAll('.guest-detail-notice').forEach(el => {
    el.addEventListener('click', function(e) {
      e.preventDefault();
      msgEl.textContent = this.dataset.message;
      overlay.style.display = 'flex';
    });
  });

  document.getElementById('guest-modal-close').onclick = () => overlay.style.display = 'none';
  overlay.onclick = (e) => { if (e.target === overlay) overlay.style.display = 'none'; };
</script>
@endguest