<div class="card mt-4">
    <div class="card-header">
        <strong>Tambah Tanggapan</strong>
    </div>

    <div class="card-body">
        <form action="{{ route(auth()->user()->peran.'.tanggapan.store') }}" method="POST">
            @csrf

            <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->pengaduan_id }}">

            <div class="mb-3">
                <label class="form-label">Tanggapan</label>
                <textarea name="teks_tanggapan"
                          class="form-control @error('teks_tanggapan') is-invalid @enderror"
                          rows="4"
                          required></textarea>

                @error('teks_tanggapan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary">
                Kirim Tanggapan
            </button>
        </form>
    </div>
</div>
