<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 Multi Auth</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(-45deg, #f1f5f9, #bfdbfe, #bae6fd, #bbf7d0, #ecfdf5);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .shape-1, .shape-2, .shape-3, .shape-4, .shape-5 {
            position: fixed;
            pointer-events: none;
            z-index: 1;
        }

        .shape-1 {
            top: 10%; left: 10%; width: 100px; height: 100px;
            background: rgba(255, 255, 255, 0.2); border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape-2 {
            top: 20%; right: 15%; width: 80px; height: 80px;
            background: rgba(33, 150, 243, 0.15); transform: rotate(45deg);
            animation: float 8s ease-in-out infinite reverse;
        }

        .shape-3 {
            bottom: 20%; left: 20%; width: 120px; height: 120px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation: float 10s ease-in-out infinite;
        }

        .shape-4 {
            bottom: 30%; right: 10%; width: 60px; height: 60px;
            background: rgba(25, 118, 210, 0.2);
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
            animation: float 7s ease-in-out infinite reverse;
        }

        .shape-5 {
            top: 60%; left: 5%; width: 90px; height: 90px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            animation: float 9s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }

        .main-content {
            position: relative;
            z-index: 10;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1976d2, #0d47a1);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(25, 118, 210, 0.4);
        }
    </style>
</head>
<body>
<div class="shape-1"></div>
<div class="shape-2"></div>
<div class="shape-3"></div>
<div class="shape-4"></div>
<div class="shape-5"></div>

<section class="p-3 p-md-4 p-xl-5 main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                <div class="card border border-light-subtle rounded-4 shadow login-card">
                    <div class="card-body p-3 p-md-4 p-xl-5">
                        <div class="mb-5">
                            <h4 class="text-center">Daftar disini</h4>
                        </div>

                        <form action="{{ route('account.processRegister') }}" method="post" id="registerForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input 
                                    type="text" 
                                    class="form-control rounded-pill bg-light @error('name') is-invalid @enderror" 
                                    name="name" 
                                    id="name" 
                                    value="{{ old('name') }}"
                                >
                                <div class="text-danger mt-1 d-none" id="nameError">Nama maksimal 50 karakter</div>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input 
                                    type="email" 
                                    class="form-control rounded-pill bg-light @error('email') is-invalid @enderror" 
                                    name="email" 
                                    id="email" 
                                    value="{{ old('email') }}"
                                >
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 position-relative">
                                <label for="password" class="form-label">Password</label>
                                <input 
                                    type="password" 
                                    class="form-control rounded-pill bg-light @error('password') is-invalid @enderror" 
                                    name="password" 
                                    id="password"
                                >
                                <div class="text-danger mt-1 d-none" id="passwordError">Password maksimal 24 karakter</div>
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input 
                                    type="password" 
                                    class="form-control rounded-pill bg-light" 
                                    name="password_confirmation" 
                                    id="password_confirmation"
                                >
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary rounded-pill py-2">Daftar Sekarang</button>
                            </div>
                        </form>

                        <div class="row mt-4">
                            <div class="col-12">
                                <hr class="mb-4 border-secondary-subtle">
                                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-center">
                                    <a href="{{ route('account.login') }}" class="link-secondary text-decoration-none">Tekan disini untuk Masuk</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const nameInput = document.getElementById('name');
    const passwordInput = document.getElementById('password');
    const nameError = document.getElementById('nameError');
    const passwordError = document.getElementById('passwordError');

    nameInput.addEventListener('input', function () {
        if (this.value.length > 50) {
            nameError.classList.remove('d-none');
        } else {
            nameError.classList.add('d-none');
        }
    });

    passwordInput.addEventListener('input', function () {
        if (this.value.length > 24) {
            passwordError.classList.remove('d-none');
        } else {
            passwordError.classList.add('d-none');
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
