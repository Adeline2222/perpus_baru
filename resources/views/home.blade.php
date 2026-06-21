<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan App</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body{
            background-color:#f4f6f9;
            font-family:'Segoe UI',sans-serif;
        }

        .sidebar{
            width:260px;
            min-height:100vh;
            background:#fff;
            border-right:1px solid #dee2e6;
            position:fixed;
        }

        .sidebar-brand{
            padding:20px;
            font-weight:bold;
            color:#0d6efd;
            font-size:20px;
        }

        .nav-link-custom{
            display:block;
            padding:10px 15px;
            margin:5px 10px;
            border-radius:8px;
            text-decoration:none;
            color:#495057;
            transition:.2s;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active{
            background:#e7f1ff;
            color:#0d6efd;
        }

        .topbar{
            height:70px;
            background:#fff;
            border-bottom:1px solid #dee2e6;
            padding:0 20px;
            position:sticky;
            top:0;
            z-index:10;
        }

        .main-content{
            margin-left:260px;
            padding:20px;
        }
    </style>
</head>

<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="sidebar-brand">
            📚 Perpustakaan App
        </div>

        <a href="/beranda"
        class="nav-link-custom {{ ($page ?? '') == 'beranda' ? 'active' : '' }}">
            <i class="fa fa-home me-2"></i>
            Dashboard
        </a>

        <a href="/anggota"
        class="nav-link-custom {{ ($page ?? '') == 'dataanggota' ? 'active' : '' }}">
            <i class="fa fa-users me-2"></i>
            Data Anggota
        </a>

        <a href="/buku"
        class="nav-link-custom {{ ($page ?? '') == 'databuku' ? 'active' : '' }}">
            <i class="fa fa-book me-2"></i>
            Data Buku
        </a>

        <a href="/peminjaman"
        class="nav-link-custom {{ ($page ?? '') == 'peminjaman' ? 'active' : '' }}">
            <i class="fa fa-right-left me-2"></i>
            Data Peminjaman
        </a>

    </div>

    <!-- MAIN -->
    <div class="flex-grow-1">

        <div class="topbar d-flex justify-content-between align-items-center">

            <div>
                <h5 class="mb-0">

                    @if(($page ?? '') == 'beranda')
                        Dashboard

                    @elseif(($page ?? '') == 'dataanggota')
                        Data Anggota

                    @elseif(($page ?? '') == 'databuku')
                        Data Buku

                    @elseif(($page ?? '') == 'peminjaman')
                        Data Peminjaman

                    @else
                        Halaman
                    @endif

                </h5>

                <small class="text-muted">
                    Login sebagai : {{ Auth::user()->role }}
                </small>
            </div>

            <form action="/logout" method="POST">
                @csrf
                <button class="btn btn-danger btn-sm">
                    <i class="fa fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>

        </div>

        <div class="main-content">

            @if(isset($page))
                @include($page)
            @endif

        </div>

    </div>

</div>

</body>
</html>