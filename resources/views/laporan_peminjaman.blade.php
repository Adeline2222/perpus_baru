<!DOCTYPE html>

<html>
<head>
    <title>Laporan Kunjungan Perpustakaan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body{
        padding:30px;
    }

    @media print{
        .no-print{
            display:none;
        }
    }
</style>

</head>
<body>

<div class="d-flex justify-content-between mb-4">

<div>
    <h2>Laporan Kunjungan Perpustakaan</h2>
    <p>Tanggal Cetak : {{ date('d-m-Y H:i') }}</p>
</div>

<div class="no-print">
    <button onclick="window.print()" class="btn btn-success">
        Cetak
    </button>
</div>

</div>

<table class="table table-bordered">
<thead class="table-dark">
    <tr>
        <th>No</th>
        <th>ID Anggota</th>
        <th>ID Buku</th>
        <th>Jam Masuk</th>
        <th>Jam Keluar</th>
        <th>Status</th>
    </tr>
</thead>

<tbody>

@foreach($data as $item)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->anggota_id }}</td>
        <td>{{ $item->buku_id ?? '-' }}</td>
        <td>{{ $item->jam_masuk }}</td>
        <td>{{ $item->jam_keluar ?? '-' }}</td>
        <td>{{ $item->status }}</td>
    </tr>

@endforeach

</tbody>

</table>

</body>
</html>
