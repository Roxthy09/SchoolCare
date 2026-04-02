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

            <div class="col-lg-4 col-md-8">
                <div class="single_blog mt-30"
                    data-toggle="modal"
                    data-target="#modalPengaduan{{ $p->pengaduan_id }}"
                    style="cursor:pointer;">

                    {{-- GAMBAR --}}
                    <div class="blog_image">
                        @if($p->lampiran)
                        <img src="{{ asset('storage/'.$p->lampiran) }}"
                            style="height:200px; width:100%; object-fit:cover;">
                        @else
                        <img src="{{ asset('landing/assets/images/blog-1.jpg') }}">
                        @endif
                    </div>

                    {{-- KONTEN --}}
                    <div class="blog_content">
                        <span>
                            {{ \Carbon\Carbon::parse($p->tanggal_dibuat)->translatedFormat('d M Y') }}
                        </span>

                        <h4>{{ $p->judul }}</h4>

                        <p>{{ Str::limit($p->deskripsi, 80) }}</p>
                    </div>
                </div>
            </div>

            {{-- ================= MODAL ================= --}}
            <div class="modal fade" id="modalPengaduan{{ $p->pengaduan_id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                        {{-- HEADER --}}
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $p->judul }}</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>

                        {{-- BODY --}}
                        <div class="modal-body">

                            {{-- GAMBAR --}}
                            @if($p->lampiran)
                            <img src="{{ asset('storage/'.$p->lampiran) }}"
                                class="img-fluid mb-3">
                            @endif

                            {{-- TANGGAL --}}
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($p->tanggal_dibuat)->translatedFormat('d M Y') }}
                            </small>

                            {{-- DESKRIPSI --}}
                            <p class="mt-2">{{ $p->deskripsi }}</p>

                            <hr>

                            {{-- STATUS --}}
                            <p>
                                Status:
                                <span class="badge badge-{{ 
                        $p->status == 'selesai' ? 'success' : 
                        ($p->status == 'dalam_proses' ? 'warning' : 
                        ($p->status == 'dibatalkan' ? 'danger' : 'secondary')) 
                    }}">
                                    {{ ucfirst(str_replace('_',' ',$p->status)) }}
                                </span>
                            </p>

                            {{-- ================= REVIEW ================= --}}
                            @if($p->rating)
                            <hr>
                            <h6>Review Orang Tua</h6>

                            <p>⭐ {{ $p->rating->nilai }}/5</p>

                            <p>"{{ $p->rating->komentar }}"</p>
                            @endif

                            {{-- ================= FORM RATING ================= --}}
                            @auth
                            @if($p->status == 'selesai' && !$p->rating)
                            <hr>
                            <h6>Beri Penilaian</h6>

                            <form action="{{ route('rating.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="pengaduan_id" value="{{ $p->pengaduan_id }}">

                                <div class="form-group">
                                    <label>Rating</label>
                                    <select name="nilai" class="form-control" required>
                                        <option value="">Pilih Rating</option>
                                        <option value="5">⭐⭐⭐⭐⭐</option>
                                        <option value="4">⭐⭐⭐⭐</option>
                                        <option value="3">⭐⭐⭐</option>
                                        <option value="2">⭐⭐</option>
                                        <option value="1">⭐</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Komentar</label>
                                    <textarea name="komentar" class="form-control"
                                        placeholder="Tulis komentar..."></textarea>
                                </div>

                                <button class="btn btn-primary btn-sm">
                                    Kirim Review
                                </button>
                            </form>
                            @endif
                            @endauth

                        </div>

                        {{-- FOOTER --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Tutup
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            @endforeach
            @else
            <p class="text-center">Belum ada pengaduan</p>
            @endif
        </div>
    </div>
</section>