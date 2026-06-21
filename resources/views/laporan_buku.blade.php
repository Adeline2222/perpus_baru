<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; }
        .judul { text-align: center; margin-bottom: 15px; }
        .judul h3, .judul h5 { margin: 2px 0; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="judul">
        <h3>LAPORAN DATA BUKU</h3>
        <h5>PERPUSTAKAAN</h5>
        <hr class="my-2">
    </div>

    <button onclick="window.print()" class="btn btn-success no-print btn-sm mb-3">Cetak</button>

    <table class="table table-bordered table-sm align-middle">
        <thead class="table-dark">
            <tr>
                <th width="50">No</th>
                <th>Kode Buku</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th width="80">Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buku as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode_buku }}</td>
                <td>{{ $item->judul_buku }}</td>
                <td>{{ $item->penulis }}</td>
                <td>{{ $item->stok }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end mt-4">
        <p class="small">Dicetak pada: {{ date('d-m-Y') }}</p>
    </div>
</div>

</body>
</html>