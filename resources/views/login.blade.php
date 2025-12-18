<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Sistem Diskominfotik NTB</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6610f2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .login-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            padding: 40px 35px;
            width: 100%;
            max-width: 420px;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-weight: 700;
            color: #333;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #6610f2);
            border: none;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056d2, #520dc2);
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 12px;
        }

        .footer-text {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            color: white;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .alert {
            border-radius: 10px;
        }

        img.logo {
            display: block;
            margin: 0 auto 2px;
            width: 120px;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <img src="{{ asset('images/Gambar Diskominfotik.jpg') }}" alt="Logo" class="logo">
        
        <h2>Login</h2>
        <p class="subtitle">Silakan login untuk melanjutkan</p>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email anda" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <div class="footer-text">
        © 2025 Diskominfotik NTB. All rights reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>