<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body d-flex justify-content-between align-items-center py-3">
            <div>
                <h4 class="mb-1 fw-bold text-dark"><i class="fa-solid fa-users text-primary me-2"></i>Data Anggota Perpustakaan</h4>
                <p class="text-muted small mb-0">Kelola dan lihat daftar siswa yang terdaftar sebagai anggota aktif</p>
            </div>
            <div>
                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">
                    <i class="fa-solid fa-user-shield me-1"></i> Login: {{ Auth::user()->role }}
                </span>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-medium">Total Anggota Terdaftar</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $anggota->count() }} Siswa</h3>
                    </div>
                    <div class="bg-primary-subtle text-primary rounded p-3 fs-3">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-medium">Otoritas Akses</h6>
                        <h4 class="fw-bold mb-0 text-dark">{{ Auth::user()->role }}</h4>
                    </div>
                    <div class="bg-warning-subtle text-warning rounded p-3 fs-3">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-md-6 col-lg-7">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control bg-light border-start-0 ps-0" placeholder="Cari nama siswa...">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 d-flex gap-2 justify-content-md-end">
                    <a href="/laporan/anggota" target="_blank" class="btn btn-outline-success fw-medium w-100 w-md-auto">
                        <i class="fa fa-print me-1"></i> Cetak Laporan
                    </a>
                    @if(Auth::user()->role == 'Admin')
                    <button class="btn btn-primary fw-medium w-100 w-md-auto text-nowrap" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="fa-solid fa-user-plus me-1"></i> Tambah Anggota
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 overflow-hidden">
        <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-bold text-dark">Daftar Anggota</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted small uppercase fw-bold">
                    <tr>
                        <th class="ps-3" width="60">No</th>
                        <th>NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th class="pe-3" width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="border-top-0">
                    @foreach($anggota->sortBy('nama') as $item)
                    <tr>
                        <td class="ps-3 text-muted fw-medium">{{ $loop->index + 1 }}</td>
                        <td><span class="badge bg-light text-dark border px-2 py-1">{{ $item->nis }}</span></td>
                        <td class="nama fw-semibold text-dark">{{ $item->nama }}</td>
                        <td><span class="text-secondary fw-medium">{{ $item->kelas }}</span></td>
                        <td class="pe-3">
                            @if(Auth::user()->role == 'Admin')
                            <div class="d-flex gap-1">
                                <button class="btn btn-light btn-sm text-warning border" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <form action="/anggota/hapus/{{ $item->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light btn-sm text-danger border" onclick="return confirm('Hapus data ini?')" title="Hapus">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </button>
                                </form>
                            </div>
                            @else
                            <span class="badge bg-secondary-subtle text-secondary px-2 py-1">Hanya Baca</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@if(Auth::user()->role == 'Admin')
@foreach($anggota as $item)
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold">Modifikasi Data Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/anggota/update/{{ $item->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body py-3">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nomor Induk Siswa (NIS)</label>
                        <input type="text" name="nis" value="{{ $item->nis }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ $item->nama }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kelas</label>
                        <input type="text" name="kelas" value="{{ $item->kelas }}" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endif

@if(Auth::user()->role == 'Admin')
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold">Tambah Anggota Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/anggota/store" method="POST">
                @csrf
                <div class="modal-body py-3">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nomor Induk Siswa (NIS)</label>
                        <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS siswa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap siswa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kelas</label>
                        <input type="text" name="kelas" class="form-control" placeholder="Contoh: XI-RPL 1" required>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#tableBody tr');

    rows.forEach(function(row){
        let nama = row.querySelector('.nama').innerText.toLowerCase();

        if (nama.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>

</body>
</html>