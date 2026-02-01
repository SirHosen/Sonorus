<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonorus Admin - @yield('title')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* Cinematic Dark Palette */
            --bg-body: #0f172a; /* Deep Slate Blue */
            --bg-sidebar: rgba(22, 30, 46, 0.85);
            --bg-card: rgba(30, 41, 59, 0.7);
            
            --text-primary: #e2e8f0;
            --text-secondary: #94a3b8;
            --text-accent: #fcd34d; /* Gold */
            
            --primary-accent: #fcd34d;
            --primary-glow: rgba(252, 211, 77, 0.3);
            
            --glass-border: 1px solid rgba(255, 255, 255, 0.1);
            --glass-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            background-image: 
                radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%);
            background-attachment: fixed;
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* Scroller */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0f172a; 
        }
        ::-webkit-scrollbar-thumb {
            background: #334155; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #475569; 
        }

        h1, h2, h3, h4, h5, h6, .brand-font {
            font-family: 'Playfair Display', serif;
            color: var(--text-primary);
        }

        /* Glassmorphism Classes */
        .glass-panel {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: var(--glass-border);
            border-radius: 16px;
            box-shadow: var(--glass-shadow);
        }

        /* Sidebar Styling */
        .sidebar {
            background: var(--bg-sidebar);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            min-height: 100vh;
            border-right: var(--glass-border);
            position: fixed;
            top: 0;
            left: 0;
            width: 270px;
            z-index: 1000;
            transition: var(--transition-smooth);
        }

        .sidebar-brand {
            padding: 2.5rem 1.5rem;
            position: relative;
            overflow: hidden;
        }
        
        /* Brand Glow Effect */
        .sidebar-brand::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100px;
            height: 100px;
            background: var(--primary-accent);
            filter: blur(60px);
            opacity: 0.1;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .sidebar-brand h2 {
            font-weight: 700;
            margin: 0;
            letter-spacing: 0.5px;
            text-shadow: 0 0 20px rgba(252, 211, 77, 0.2);
        }

        .sidebar-brand span {
            color: var(--primary-accent);
        }

        .sidebar-menu {
            padding: 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            color: var(--text-secondary);
            padding: 1rem 1.25rem;
            margin-bottom: 0.5rem;
            border-radius: 12px;
            transition: var(--transition-smooth);
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover {
            color: var(--text-primary);
            background: rgba(255, 255, 255, 0.03);
            transform: translateX(5px);
        }

        .nav-link.active {
            color: var(--bg-body);
            background: linear-gradient(135deg, #fcd34d 0%, #d97706 100%);
            font-weight: 600;
            box-shadow: 0 0 20px rgba(217, 119, 6, 0.4);
        }
        
        .nav-link.active i {
            color: var(--bg-body);
        }

        .nav-link i {
            width: 24px;
            margin-right: 12px;
            font-size: 1.1rem;
            transition: var(--transition-smooth);
        }

        /* Main Content */
        .main-wrapper {
            margin-left: 270px;
            width: calc(100% - 270px);
            transition: var(--transition-smooth);
            min-height: 100vh;
            position: relative;
        }

        /* Navbar */
        .top-navbar {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(10px);
            border-bottom: var(--glass-border);
            padding: 1.25rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 900;
            width: 100%;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-dropdown .dropdown-toggle {
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            padding: 0.5rem;
            border-radius: 12px;
            transition: var(--transition-smooth);
        }
        
        .user-dropdown .dropdown-toggle:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #fcd34d 0%, #d97706 100%);
            color: var(--bg-body);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
            box-shadow: 0 0 15px rgba(217, 119, 6, 0.3);
        }

        /* Content Area */
        .content-container {
            padding: 2.5rem;
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Common Components - Overrides */
        .card {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: var(--glass-border);
            border-radius: 16px;
            box-shadow: var(--glass-shadow);
            margin-bottom: 30px;
            color: var(--text-primary);
        }
        
        .card-header {
            background: transparent;
            border-bottom: var(--glass-border);
            padding: 1.5rem;
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--primary-accent);
        }
        
        .card-body {
            padding: 2rem;
        }

        /* Form Controls */
        .form-control, .form-select {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: var(--transition-smooth);
        }
        
        .form-control:focus, .form-select:focus {
            background: rgba(15, 23, 42, 0.8);
            border-color: var(--primary-accent);
            box-shadow: 0 0 0 4px rgba(252, 211, 77, 0.1);
            color: var(--text-primary);
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }
        
        .form-label {
            color: var(--text-secondary);
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .input-group-text {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-secondary);
        }

        /* Custom File Input */
        /* Custom File Upload Widget */
        .file-upload-wrapper {
            position: relative;
            width: 100%;
            min-height: 120px;
            border: 2px dashed rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.02);
            transition: all 0.3s ease;
            cursor: pointer;
            overflow: hidden;
            text-align: center;
            padding: 1.5rem;
        }

        .file-upload-wrapper:hover {
            border-color: var(--primary-accent);
            background: rgba(252, 211, 77, 0.05);
            box-shadow: 0 0 20px rgba(252, 211, 77, 0.1);
        }

        .file-upload-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 10;
        }

        .file-upload-content {
            z-index: 1;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .file-upload-icon {
            font-size: 2.5rem;
            color: var(--text-secondary);
            margin-bottom: 0.75rem;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .file-upload-wrapper:hover .file-upload-icon {
            transform: translateY(-5px);
            color: var(--primary-accent);
        }

        .file-upload-text {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .file-upload-hint {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.3);
        }

        .file-selected .file-upload-icon {
            color: #10b981; /* Success Green */
        }
        
        .file-selected .file-upload-text {
            color: #fff;
            font-weight: 500;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #fcd34d 0%, #d97706 100%);
            border: none;
            color: var(--bg-body);
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 8px;
            transition: var(--transition-smooth);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(217, 119, 6, 0.4);
            background: linear-gradient(135deg, #fbbf24 0%, #b45309 100%);
            color: var(--bg-body);
        }
        
        .btn-secondary, .btn-outline-secondary {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
            transition: var(--transition-smooth);
        }
        
        .btn-secondary:hover, .btn-outline-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            transform: translateY(-2px);
        }

        /* Alerts */
        .alert {
            background: rgba(16, 185, 129, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399;
            border-radius: 12px;
        }
        
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-wrapper {
                margin-left: 0;
                width: 100%;
            }
            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-brand d-flex align-items-center gap-3">
            <img src="{{ asset('images/classical-illustration.png') }}" alt="Sonorus" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; border: 2px solid var(--primary-accent); box-shadow: 0 0 15px var(--primary-glow);">
            <div>
                <h2 style="font-size: 1.5rem; margin-bottom: 0;">Sonorus<span>.</span></h2>
                <p class="text-white mb-0 small" style="letter-spacing: 2px; font-size: 0.6rem; opacity: 0.7;">ADMINISTRATOR</p>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> 
                <span>Dashboard</span>
            </a>
            
            <p class="small fw-bold text-uppercase mt-4 mb-3 ps-3" style="color: var(--text-secondary); font-size: 0.7rem; letter-spacing: 1px;">Management</p>
            
            <a href="{{ route('admin.composers.index') }}" class="nav-link {{ request()->routeIs('admin.composers.*') ? 'active' : '' }}">
                <i class="fas fa-feather-alt"></i> 
                <span>Composers</span>
            </a>
            <a href="{{ route('admin.songs.index') }}" class="nav-link {{ request()->routeIs('admin.songs.*') ? 'active' : '' }}">
                <i class="fas fa-music"></i> 
                <span>Songs</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> 
                <span>Users</span>
            </a>
            
            <div style="position: absolute; bottom: 30px; width: calc(100% - 2rem);">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-danger" style="background: rgba(239, 68, 68, 0.1);">
                    <i class="fas fa-sign-out-alt"></i> 
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-link d-md-none text-light me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="page-title">@yield('title')</h1>
            </div>
            
            <div class="user-dropdown">
                <a href="#" class="dropdown-toggle">
                    <div class="text-end me-2 d-none d-sm-block">
                        <div class="fw-bold small">{{ Auth::user()->name }}</div>
                        <div class="small" style="color: var(--primary-accent); font-size: 0.75rem;">Administrator</div>
                    </div>
                    <div class="user-avatar">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </a>
            </div>
        </header>

        <!-- Page Content -->
        <div class="content-container">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div class="ms-2">{{ session('success') }}</div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <div class="ms-2">{{ session('error') }}</div>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Toggle Sidebar for Mobile
        $(document).ready(function() {
            // Sidebar Toggle
            $('#sidebarToggle').on('click', function() {
                $('.sidebar').toggleClass('show');
            });

            // Cinematic File Upload Interaction
            $(document).on('change', '.file-upload-input', function() {
                const file = this.files[0];
                const wrapper = $(this).closest('.file-upload-wrapper');
                const content = wrapper.find('.file-upload-content');
                const icon = wrapper.find('.file-upload-icon');
                const text = wrapper.find('.file-upload-text');
                const hint = wrapper.find('.file-upload-hint');

                if (file) {
                    wrapper.addClass('file-selected');
                    // Change icon to file type or checkmark
                    if (file.type.startsWith('image/')) {
                         icon.removeClass().addClass('fas fa-image file-upload-icon');
                    } else if (file.type.startsWith('audio/')) {
                         icon.removeClass().addClass('fas fa-music file-upload-icon');
                    } else {
                         icon.removeClass().addClass('fas fa-check-circle file-upload-icon');
                    }
                    
                    text.text(file.name);
                    hint.text('Click to change file');
                } else {
                    // Reset
                    wrapper.removeClass('file-selected');
                    icon.removeClass().addClass('fas fa-cloud-upload-alt file-upload-icon');
                    text.text('Click to upload or drag file here');
                    hint.text('Supported files only');
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
