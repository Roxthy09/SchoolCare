<div class="card mt-4">
    <div class="card-header">
        <strong>Tanggapan</strong>
    </div>

    <div class="card-body">
        @forelse ($pengaduan->tanggapans as $tanggapan)
            <div class="border rounded p-3 mb-3">
                <div class="d-flex justify-content-between">
                    <strong>{{ $tanggapan->pengguna->name }}</strong>
                    <small class="text-muted">
                        {{ $tanggapan->tanggal_tanggapan->format('d M Y H:i') }}
                    </small>
                </div>

                <p class="mt-2 mb-0">
                    {{ $tanggapan->teks_tanggapan }}
                </p>
            </div>
        @empty
            <p class="text-muted">Belum ada tanggapan.</p>
        @endforelse
    </div>
</div>
