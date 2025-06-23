<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SILAMPAS - BPOM Service')</title>
    
    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #64748b;
            --success-color: #059669;
            --warning-color: #d97706;
            --danger-color: #dc2626;
            --info-color: #0891b2;
            --light-bg: #f8fafc;
            --white: #ffffff;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --sidebar-width: 280px;
            --navbar-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Navbar Styles */
        .main-navbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--navbar-height);
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 999;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            box-shadow: var(--shadow-md);
        }

        .navbar-user {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            font-weight: 500;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-1px);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: white;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: var(--shadow-lg);
        }

        .sidebar-logo small {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.8);
        display: block;
        margin-top: 0.5rem;
    }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-logo img {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
        }

        .sidebar-logo h3 {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar-nav {
            padding: 1.5rem 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.875rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.8) 0%, rgba(59, 130, 246, 0.8) 100%);
            transition: width 0.3s ease;
            z-index: -1;
        }

        .nav-link:hover {
            color: white;
            transform: translateX(4px);
        }

        .nav-link:hover::before {
            width: 100%;
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
            color: white;
            box-shadow: var(--shadow-md);
        }

        .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .nav-badge {
            background: var(--danger-color);
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-weight: 600;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--navbar-height);
            padding: 2rem;
            min-height: calc(100vh - var(--navbar-height));
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            :root {
                --sidebar-width: 250px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-navbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .navbar-user {
                gap: 0.5rem;
            }

            .user-info span {
                display: none;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header d-flex align-items-center text-white p-3">
        <img src="/image/lloka.png" alt="Logo SILAMPAS" class="me-2" style="height: 50px;" onerror="this.style.display='none'">

        <div class="d-flex flex-column">
            <h3 class="fw-bold m-0">SILAMPAS</h3>
            <small>Sistem Informasi Ticketing Layanan Masyarakat di Loka POM Toba</small>
        </div>
        </div>


        <nav class="sidebar-nav">
            <div class="nav-item">
                <a class="nav-link {{ request()->routeIs('account.dashboard') ? 'active' : '' }}" href="/account/dashboard">
                    <span><i class="bi bi-speedometer2"></i> Dashboard</span>
                </a>
            </div>

            <div class="nav-item">
                <a class="nav-link {{ request()->routeIs('umkms.*') ? 'active' : '' }}" href="{{ route('umkms.index') }}">
                    <span><i class="bi bi-ticket-perforated"></i> Tiket</span>
                    @if(isset($tiketBaru) && $tiketBaru > 0)
                        <span class="nav-badge">{{ $tiketBaru }}</span>
                    @endif
                </a>
            </div>
            
            <div class="nav-item">
                <a class="nav-link {{ request()->is('layanans*') ? 'active' : '' }}" href="/layanans">
                    <span><i class="bi bi-journal-check"></i> Layanan</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a class="nav-link {{ request()->is('surveys*') ? 'active' : '' }}" href="/surveys">
                    <span><i class="bi bi-check-circle"></i> Survey</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a class="nav-link {{ request()->is('chart-layanan*') ? 'active' : '' }}" href="/chart-layanan">
                    <span><i class="bi bi-bar-chart-line"></i> Statistik</span>
                </a>
            </div>

            <div class="nav-item">
                <a class="nav-link {{ request()->is('account/change-password') ? 'active' : '' }}" href="{{ route('account.change-password') }}">
                    <span><i class="bi bi-lock"></i> Ganti Password</span>
                </a>
            </div>

            @php
                $user = Auth::user();
            @endphp

            @if ($user && $user->role === 'admin')
                <div class="nav-item">
                    <a class="nav-link {{ request()->is('account/create-petugas') ? 'active' : '' }}" href="{{ route('account.create-petugas') }}">
                        <span><i class="bi bi-person-plus"></i> Buat Akun Petugas</span>
                    </a>
                </div>
            @endif

            <div class="text-center text-white py-3 small mb-7" style="border-top: 1px solid rgba(255,255,255,0.1); font-size: 0.75rem;">
                <strong>Copyright</strong> &copy; 2024–2025 PSI02 All rights reserved
            </div>

        </nav>
    </aside>

    <!-- Main Navbar -->
    <header class="main-navbar">
        <button class="btn btn-link d-md-none text-white" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="navbar-user">
            <div class="user-info">
                <div class="user-avatar">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <span>Hello, {{ Auth::user()->name }}</span>
            </div>
            <a class="logout-btn" href="{{ route('account.logout') }}">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle for mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !sidebarToggle?.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
            }
        });
    </script>

    @stack('scripts')
    @yield('scripts')
</body>
</html>