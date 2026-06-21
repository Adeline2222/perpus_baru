<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            border: none;
            border-radius: 16px;
        }
        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
            padding: 10px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
            transform: translateY(-1px);
        }
        .form-control {
            border-radius: 8px;
            padding: 10px 12px;
        }
        .form-control:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        .input-group-text {
            border-radius: 8px;
            background-color: #f8f9fc;
            color: #a3b6cc;
        }
    </style>
</head>
<body>

<div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="row justify-content-center w-100">
        <div class="col-md-5 col-lg-4">
            
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3 border-0 shadow-sm" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card login-card shadow-sm p-3 p-md-4 bg-white">
                <div class="card-body">
                    
                    <div class="text-center mb-4">
                        <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fa-solid fa-book-open fa-2xl"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-1">Perpustakaan</h4>                        
                    </div>

                    <form action="/login/proses" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0"><i class="fa-regular fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control border-start-0" placeholder="nama@sekolah.sch.id" required autofocus>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-secondary">Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control border-start-0" placeholder="••••••••" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 shadow-sm">Login <i class="fa-solid fa-right-to-bracket ms-1"></i></button>
                    </form>

                </div>
            </div>
            
            <div class="text-center mt-4">
                <p class="text-muted small">&copy; 2026 Aplikasi Perpustakaan Sekolah</p>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>