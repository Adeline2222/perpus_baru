<div class="container-fluid mt-4">
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-medium">Total Anggota</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalAnggota }}</h3>
                    </div>
                    <div class="bg-primary-subtle text-primary rounded p-3 fs-3">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-medium">Total Koleksi Buku</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalBuku }}</h3>
                    </div>
                    <div class="bg-success-subtle text-success rounded p-3 fs-3">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-medium">Total Peminjaman</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalPeminjaman }}</h3>
                    </div>
                    <div class="bg-warning-subtle text-warning rounded p-3 fs-3">
                        <i class="fas fa-arrow-right-arrow-left"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-medium">Peminjaman Aktif</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalAktif }}</h3>
                    </div>
                    <div class="bg-danger-subtle text-danger rounded p-3 fs-3">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-4">
            <h4 class="mb-2 fw-bold text-dark">
                <i class="fa-solid fa-circle-check text-success me-2"></i>Selamat Datang di Sistem Perpustakaan
            </h4>
            <p class="text-muted mb-0 lead fs-6">
                Sistem ini siap digunakan untuk memantau data anggota, manajemen koleksi buku, sirkulasi transaksi peminjaman, serta penyusunan laporan perpustakaan secara real-time.
            </p>
        </div>
    </div>
</div>