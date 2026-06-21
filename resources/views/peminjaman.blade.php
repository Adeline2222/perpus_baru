<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Absensi & Peminjaman Perpustakaan</h4>
            <p class="text-muted small mb-0">Pengunjung boleh hanya berkunjung atau meminjam buku</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="/laporan-peminjaman" target="_blank" class="btn btn-outline-success btn-sm fw-medium">
                <i class="fa fa-print me-1"></i> Cetak Laporan
            </a>
            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">
                {{ Auth::user()->role }}
            </span>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-medium">Total Kunjungan</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $peminjaman->count() }}</h3>
                    </div>
                    <div class="bg-primary-subtle text-primary rounded p-3 fs-4"><i class="fas fa-users"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-medium">Masih Di Dalam</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $peminjaman->where('status','Masuk')->count() }}</h3>
                    </div>
                    <div class="bg-warning-subtle text-warning rounded p-3 fs-4"><i class="fas fa-door-open"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-medium">Sudah Keluar</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $peminjaman->where('status','Selesai')->count() }}</h3>
                    </div>
                    <div class="bg-success-subtle text-success rounded p-3 fs-4"><i class="fas fa-door-closed"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-medium">Kartu Ditahan</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $peminjaman->where('status_kartu','Ditahan')->count() }}</h3>
                    </div>
                    <div class="bg-danger-subtle text-danger rounded p-3 fs-4"><i class="fas fa-id-card-clip"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold py-3">Tambah Kunjungan</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show small" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="/peminjaman/store" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Anggota</label>
                            <input type="text" name="anggota_input" class="form-control" list="listAnggota" placeholder="Ketik nama anggota..." required>
                            <datalist id="listAnggota">
                                @foreach($anggota as $a)
                                    <option value="{{ $a->nis }} - {{ $a->nama }}">
                                @endforeach
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Buku (Opsional)</label>
                            <input type="text" name="buku_input" class="form-control" list="listBuku" placeholder="Kosongkan jika hanya berkunjung">
                            <datalist id="listBuku">
                                @foreach($buku as $b)
                                    <option value="{{ $b->judul_buku }}">
                                @endforeach
                            </datalist>
                        </div>
                        <button class="btn btn-primary w-100 fw-medium">Simpan Kunjungan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold text-dark">Data Kunjungan</h5>
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" id="searchInput" class="form-control bg-light border-start-0 ps-0" placeholder="Cari nama anggota atau buku...">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-sm align-middle mb-0">
                            <thead class="table-light text-muted small fw-bold">
                                <tr>
                                    <th width="40">No</th>
                                    <th>Nama</th>
                                    <th>Buku</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                    <th>Kartu</th>
                                    <th>Status</th>
                                    <th width="150" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach($peminjaman as $item)
                                <tr>
                                    <td class="text-muted fw-medium">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold text-dark">{{ $item->anggota->nama ?? '-' }}</td>
                                    <td>
                                        @php
                                            $namaBuku = 'Hanya Berkunjung';
                                            foreach($buku as $bk){
                                                if($bk->id == $item->buku_id){
                                                    $namaBuku = $bk->judul_buku;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <span class="{{ $namaBuku == 'Hanya Berkunjung' ? 'text-muted small italic' : 'fw-medium' }}">{{ $namaBuku }}</span>
                                    </td>
                                    <td class="small">{{ $item->jam_masuk }}</td>
                                    <td class="small">{{ $item->jam_keluar ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $item->status_kartu == 'Ditahan' ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success' }} px-2 py-1">
                                            {{ $item->status_kartu == 'Ditahan' ? 'Ditahan' : 'Kembali' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $item->status == 'Masuk' ? 'bg-warning text-dark' : 'bg-success-subtle text-success' }} px-2 py-1 fw-semibold">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                            @if($item->status == 'Masuk')
                                            <form action="/peminjaman/keluar/{{ $item->id }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-success px-2 py-1 small">Keluar</button>
                                            </form>
                                            <button class="btn btn-sm btn-light border text-warning px-2 py-1 small" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}">Edit</button>
                                            @endif
                                            <form action="/peminjaman/hapus/{{ $item->id }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Hapus data?')" class="btn btn-sm btn-light border text-danger px-2 py-1 small">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header border-bottom-0 pb-0">
                                                <h5 class="fw-bold">Modifikasi Log Buku</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/peminjaman/update/{{ $item->id }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body py-3">
                                                    <label class="form-label small fw-bold">Judul Buku</label>
                                                    <select name="buku_id" class="form-select">
                                                        <option value="">Tidak Meminjam Buku (Hanya Berkunjung)</option>
                                                        @foreach($buku as $b)
                                                            <option value="{{ $b->id }}" {{ $item->buku_id == $b->id ? 'selected' : '' }}>{{ $b->judul_buku }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer border-top-0 pt-0">
                                                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-sm px-3">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function(){
    let value = this.value.toLowerCase();
    document.querySelectorAll('#tableBody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
    });
});
</script>