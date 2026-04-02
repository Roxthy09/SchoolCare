<div class="card mt-4">
    <div class="card-header">
        <strong>Riwayat Status</strong>
    </div>

    <div class="card-body">
        @forelse($pengaduan->riwayatStatuses as $riwayat)
            <div class="mb-3 border-bottom pb-2">
                <strong>{{ $riwayat->pengguna->name }}</strong>
                mengubah status menjadi
                <span class="badge bg-primary">
                    {{ str_replace('_',' ', $riwayat->status) }}
                </span>
                <br>
                <small class="text-muted">
                    {{ $riwayat->tanggal_ubah->format('d M Y H:i') }}
                </small>
            </div>
        @empty
            <p class="text-muted">Belum ada riwayat status.</p>
        @endforelse
    </div>
</div>
