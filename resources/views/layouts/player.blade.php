<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sonorus - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #9B59B6;
            --secondary-color: #8E44AD;
            --accent-color: #D6BCFA;
            --dark-color: #1A202C;
            --light-color: #F7FAFC;
            --gray-color: #CBD5E0;
            --light-gray: #E2E8F0;
            --gradient-start: #9B59B6;
            --gradient-end: #3498DB;
            --text-color: #FFFFFF;
            --text-muted: #CBD5E0;
            --bg-dark: #0F172A;
            --bg-card: #1E293B;
            --bg-card-hover: #2D3748;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-color);
            transition: all 0.3s ease;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            color: var(--text-color);
        }
        
        p {
            color: var(--text-color);
        }
        
        .text-muted {
            color: var(--text-muted) !important;
        }
        
        .sidebar {
            background: linear-gradient(to bottom, #1E293B, #0F172A);
            color: var(--text-color);
            height: 100vh;
            position: fixed;
            padding-top: 20px;
            width: 250px;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
            z-index: 100;
        }
        
        .sidebar-logo {
            padding: 0 20px;
            margin-bottom: 30px;
        }
        
        .sidebar-logo h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 28px;
            background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            text-align: center;
        }
        
        .sidebar-logo p {
            text-align: center;
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 5px;
        }
        
        .sidebar-nav {
            margin-top: 20px;
        }
        
        .sidebar-nav a {
            color: var(--text-muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 20px;
            transition: all 0.3s;
            border-left: 3px solid transparent;
            margin-bottom: 5px;
        }
        
        .sidebar-nav a i {
            margin-right: 15px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }
        
        .sidebar-nav a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 3px solid var(--primary-color);
        }
        
        .sidebar-nav a.active {
            background-color: rgba(142, 68, 173, 0.2);
            color: white;
            border-left: 3px solid var(--primary-color);
        }
        
        .content {
            margin-left: 250px;
            padding: 30px;
            padding-bottom: 120px; /* Space for player */
        }
        
        .search-box {
            position: relative;
            margin-bottom: 30px;
            max-width: 600px;
        }
        
        .search-box input {
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            padding: 15px 20px;
            padding-left: 50px;
            border-radius: 30px;
            width: 100%;
            font-size: 16px;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .search-box input:focus {
            background-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            outline: none;
        }
        
        .search-box .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 18px;
        }
        
        .section-title {
            font-size: 28px;
            margin-bottom: 25px;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
            color: var(--text-color);
            width: 100%;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
            border-radius: 3px;
        }
        
        .card {
            background: linear-gradient(145deg, #1E293B, #1A1E2E);
            border: none;
            border-radius: 15px;
            margin-bottom: 25px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 20px rgba(0, 0, 0, 0.3);
        }
        
        .card-header {
            background: rgba(142, 68, 173, 0.1);
            color: var(--text-color);
            border-bottom: none;
            padding: 20px;
            font-family: 'Playfair Display', serif;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .song-card {
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .song-card .image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 10px 10px 0 0;
        }
        
        .song-card img {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            transition: all 0.5s ease;
            display: block;
        }
        
        .song-card:hover img {
            transform: scale(1.05);
        }
        
        .song-card .card-body {
            padding: 15px;
            background: rgba(30, 41, 59, 0.95);
            z-index: 2;
        }
        
        .song-card h5 {
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 18px;
            color: var(--text-color);
            transition: color 0.3s ease;
        }
        
        .song-card p {
            margin: 5px 0 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 14px;
            color: var(--text-muted);
        }
        
        .song-card .play-hover {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background: rgba(142, 68, 173, 0.85);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            cursor: pointer;
            z-index: 10;
        }
        
        .song-card .image-wrapper:hover .play-hover {
            opacity: 1;
        }
        
        .song-card .play-hover i {
            font-size: 50px;
            color: white;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
        }
        
        .song-card .play-hover:hover i {
            transform: scale(1.1);
        }
        
        .composer-card {
            text-align: center;
            cursor: pointer;
        }
        
        .composer-card img {
            width: 70%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto 15px;
            border: 3px solid rgba(142, 68, 173, 0.5);
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .composer-card:hover img {
            transform: scale(1.05);
            border-color: var(--primary-color);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
            border: none;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(142, 68, 173, 0.3);
            color: white;
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, var(--gradient-end), var(--gradient-start));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(142, 68, 173, 0.4);
        }
        
        .btn-outline-light {
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 500;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s;
            color: var(--text-color);
        }
        
        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
        }
        
        /* Music Player Styles */
        .music-player {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to right, #1E293B, #0F172A);
            padding: 15px 30px;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .player-controls {
            display: flex;
            align-items: center;
        }
        
        .player-controls button {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 22px;
            margin: 0 12px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .player-controls button:hover {
            color: white;
            transform: scale(1.1);
        }
        
        .player-controls .play-pause {
            font-size: 38px;
            color: var(--primary-color);
            background: rgba(255, 255, 255, 0.1);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        .player-controls .play-pause:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: scale(1.05);
        }
        
        .song-info {
            display: flex;
            align-items: center;
            width: 30%;
        }
        
        .song-info img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            margin-right: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        
        .song-info-text {
            overflow: hidden;
        }
        
        .song-info-text h5 {
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: white;
            font-size: 16px;
        }
        
        .song-info-text p {
            margin: 5px 0 0;
            color: var(--text-muted);
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        /* Progress bar styles - OPTIMIZED VERSION */
        .progress-container {
            width: 40%;
            display: flex;
            align-items: center;
            position: relative;
        }

        .progress-time {
            color: var(--text-muted);
            font-size: 12px;
            min-width: 45px;
            text-align: center;
        }

        .progress-bar-container {
            flex-grow: 1;
            height: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            margin: 0 15px;
            cursor: pointer;
            position: relative;
            overflow: visible;
            touch-action: none; /* allow custom pointer handling */
            user-select: none;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 4px;
            width: 0%;
            position: relative;
            pointer-events: none; /* let container handle all events */
        }

        .progress-bar-handle {
        width: 16px;
        height: 16px;
        background-color: white;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
        left: 0%;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        cursor: grab;
        z-index: 10;
        transition: transform 0.1s, box-shadow 0.1s;
        pointer-events: none; /* prevent handle from eating clicks */
    }


        .progress-bar-container:hover .progress-bar-handle,
        .progress-bar-container:active .progress-bar-handle {
            transform: translate(-50%, -50%) scale(1.2);
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.5);
        }

        .progress-bar-container:active .progress-bar-handle {
            cursor: grabbing;
        }
        
        .volume-container {
            display: flex;
            align-items: center;
            width: 15%;
        }
        
        .volume-icon {
            color: var(--text-muted);
            margin-right: 10px;
            cursor: pointer;
            font-size: 18px;
        }
        
        .volume-slider {
            flex-grow: 1;
            height: 5px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .volume-level {
            height: 5px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 3px;
            width: 70%;
        }
        
        /* Playlist styles */
        .playlist-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s;
            margin-bottom: 10px;
            background: rgba(30, 41, 59, 0.6);
        }
        
        .playlist-item:hover {
            background: rgba(30, 41, 59, 0.9);
            transform: translateX(5px);
        }
        
        .playlist-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .playlist-item-info {
            flex-grow: 1;
            overflow: hidden;
        }
        
        .playlist-item-info h5 {
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 18px;
            color: var(--text-color);
        }
        
        .playlist-item-info p {
            margin: 5px 0 0;
            color: var(--text-muted);
            font-size: 14px;
        }
        
        .playlist-item-actions {
            display: flex;
            gap: 10px;
        }
        
        /* Song list styles */
        .song-list-item {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            background: rgba(30, 41, 59, 0.6);
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }
        
        .song-list-item:hover {
            background: rgba(30, 41, 59, 0.9);
            transform: translateX(5px);
        }
        
        .song-list-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .song-list-item .song-info {
            flex-grow: 1;
            width: auto;
        }
        
        .song-list-item .song-title {
            margin: 0;
            font-size: 16px;
            color: white;
        }
        
        .song-list-item .song-composer {
            margin: 5px 0 0;
            font-size: 14px;
            color: var(--text-muted);
        }
        
        .song-list-item .song-actions {
            display: flex;
            gap: 10px;
        }
        
        .handle {
            cursor: grab;
            color: var(--text-muted);
            margin-right: 15px;
            font-size: 18px;
        }
        
        /* Table styles */
        .table {
            color: var(--text-color);
            border-color: rgba(255, 255, 255, 0.1);
        }
        
        .table-dark {
            background-color: var(--bg-card);
        }
        
        .table-dark th {
            background-color: rgba(0, 0, 0, 0.2);
            color: var(--text-color);
            border-bottom: none;
            padding: 15px;
        }
        
        .table-dark td {
            padding: 15px;
            vertical-align: middle;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        /* Form controls */
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 12px 15px;
            border-radius: 8px;
        }
        
        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(155, 89, 182, 0.25);
            color: white;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        }
        
        .form-select option {
            background-color: var(--bg-card);
            color: white;
        }
        
        /* Alerts */
        .alert {
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 25px;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            color: white;
        }
        
        .alert-success {
            background-color: rgba(72, 187, 120, 0.2);
            border-left: 4px solid #48BB78;
        }
        
        .alert-info {
            background-color: rgba(56, 178, 172, 0.2);
            border-left: 4px solid #38B2AC;
        }
        
        .alert-danger {
            background-color: rgba(245, 101, 101, 0.2);
            border-left: 4px solid #F56565;
        }
        
        /* Badges */
        .badge {
            padding: 6px 10px;
            font-weight: 500;
            border-radius: 30px;
        }
        
        .badge.bg-primary {
            background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end)) !important;
        }
        
        /* Links */
        a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        a:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }
        
        /* Dropdown */
        .dropdown-menu {
            background-color: var(--bg-card);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 10px;
        }
        
        .dropdown-item {
            color: var(--text-color);
            padding: 8px 15px;
            border-radius: 5px;
        }
        
        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .dropdown-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Pagination */
        .pagination {
            margin-top: 20px;
        }
        
        .pagination .page-link {
            background-color: var(--bg-card);
            border-color: rgba(255, 255, 255, 0.1);
            color: var(--text-color);
            margin: 0 3px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .pagination .page-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-color: rgba(255, 255, 255, 0.2);
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
            border-color: transparent;
            color: white;
        }
        
        .pagination .page-item.disabled .page-link {
            background-color: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.4);
            border-color: rgba(255, 255, 255, 0.05);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }
        
        ::-webkit-scrollbar-thumb {
            background: rgba(142, 68, 173, 0.5);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(142, 68, 173, 0.7);
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .sidebar {
                width: 200px;
            }
            
            .content {
                margin-left: 200px;
                padding: 20px;
            }
            
            .song-info {
                width: 25%;
            }
            
            .progress-container {
                width: 45%;
            }
        }
        
        /* Mobile adjustments */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1050;
                transition: transform 0.3s ease;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .content {
                margin-left: 0;
                padding: 15px;
            }
            
            .mobile-nav-toggle {
                display: block;
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 1060;
                background: var(--primary-color);
                color: white;
                border: none;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            }
            
            .music-player {
                flex-direction: column;
                padding: 10px;
            }
            
            .song-info {
                width: 100%;
                margin-bottom: 10px;
            }
            
            .progress-container {
                width: 100%;
                margin: 10px 0;
            }
            
            .volume-container {
                width: 100%;
            }
            
            .player-controls {
                order: -1;
                margin-bottom: 10px;
            }
            
            .progress-bar-container {
                height: 12px;
            }
            
            .progress-bar-handle {
                width: 20px;
                height: 20px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Mobile Navigation Toggle -->
    <button class="mobile-nav-toggle d-md-none" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <h2>Sonorus</h2>
            <p>Classical Music Experience</p>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('player.index') }}" class="{{ request()->routeIs('player.index') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="{{ route('player.browse') }}" class="{{ request()->routeIs('player.browse') ? 'active' : '' }}">
                <i class="fas fa-music"></i> Browse Music
            </a>
            <a href="{{ route('player.composers') }}" class="{{ request()->routeIs('player.composers*') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i> Composers
            </a>
            <a href="{{ route('player.playlists.index') }}" class="{{ request()->routeIs('player.playlists*') ? 'active' : '' }}">
                <i class="fas fa-list"></i> My Playlists
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </div>
    
    <!-- Main Content -->
    <div class="content">
        <!-- Search Box -->
        <div class="search-box">
            <form action="{{ route('player.search') }}" method="GET">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="query" placeholder="Search for compositions, composers..." value="{{ request('query') }}">
            </form>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
        @endif
        
        @if(session('info'))
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> {{ session('info') }}
            </div>
        @endif
        
        <h1 class="section-title mb-4">@yield('title')</h1>
        
        <div class="fade-in">
            @yield('content')
        </div>
    </div>
    
    <!-- Music Player -->
    <div class="music-player" id="musicPlayer" style="display: none;">
        <div class="song-info">
            <img id="playerCover" src="{{ asset('images/default-cover.jpg') }}" alt="Album Cover">
            <div class="song-info-text">
                <h5 id="playerTitle">No song playing</h5>
                <p id="playerComposer">Unknown</p>
            </div>
        </div>
        
        <div class="player-controls">
            <button id="prevButton"><i class="fas fa-step-backward"></i></button>
            <button id="playPauseButton" class="play-pause"><i class="fas fa-play"></i></button>
            <button id="nextButton"><i class="fas fa-step-forward"></i></button>
        </div>
        
        <div class="progress-container">
            <span class="progress-time" id="currentTime">0:00</span>
            <div class="progress-bar-container" id="progressContainer">
                <div class="progress-bar" id="progressBar"></div>
                <div class="progress-bar-handle" id="progressHandle"></div>
            </div>
            <span class="progress-time" id="totalTime">0:00</span>
        </div>
        
        <div class="volume-container">
            <i class="fas fa-volume-up volume-icon" id="volumeIcon"></i>
            <div class="volume-slider" id="volumeContainer">
                <div class="volume-level" id="volumeLevel"></div>
            </div>
        </div>
    </div>

    <!-- Single audio player element -->
    <audio id="audioPlayer" preload="metadata"></audio>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Music player functionality
        $(document).ready(function() {
            const audioPlayer = document.getElementById('audioPlayer');
            const musicPlayer = document.getElementById('musicPlayer');
            const playerCover = document.getElementById('playerCover');
            const playerTitle = document.getElementById('playerTitle');
            const playerComposer = document.getElementById('playerComposer');
            const playPauseButton = document.getElementById('playPauseButton');
            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');
            const progressBar = document.getElementById('progressBar');
            const progressHandle = document.getElementById('progressHandle');
            const progressContainer = document.getElementById('progressContainer');
            const currentTime = document.getElementById('currentTime');
            const totalTime = document.getElementById('totalTime');
            const volumeIcon = document.getElementById('volumeIcon');
            const volumeLevel = document.getElementById('volumeLevel');
            const volumeContainer = document.getElementById('volumeContainer');
            
            window.playlist = window.playlist || [];
            window.currentSongIndex = window.currentSongIndex || 0;
            let isDraggingProgress = false;
            let wasPlayingBeforeDrag = false;

            const formatTime = (seconds) => {
                if (!isFinite(seconds)) return '0:00';
                const mins = Math.floor(seconds / 60) || 0;
                const secs = Math.floor(seconds % 60) || 0;
                return mins + ':' + (secs < 10 ? '0' : '') + secs;
            };

            const getDuration = () => {
                const duration = audioPlayer.duration;
                if (isFinite(duration) && duration > 0) return duration;
                if (audioPlayer.seekable && audioPlayer.seekable.length) {
                    const end = audioPlayer.seekable.end(audioPlayer.seekable.length - 1);
                    if (isFinite(end) && end > 0) return end;
                }
                return 0;
            };

            const renderProgress = (positionFraction) => {
                const safePosition = Math.max(0, Math.min(1, positionFraction || 0));
                const percent = safePosition * 100;
                progressBar.style.width = percent + '%';
                progressHandle.style.left = percent + '%';
            };

            const updateProgressFromTime = (time) => {
                if (isDraggingProgress) return;
                const duration = getDuration();
                currentTime.textContent = formatTime(time || 0);
                if (duration > 0) {
                    const position = (time || 0) / duration;
                    renderProgress(position);
                }
            };

            const updateTotalTime = (duration) => {
                if (!duration || isNaN(duration)) return;
                totalTime.textContent = formatTime(duration);
            };
            
            // Play a song
                window.playSong = function(songId, songTitle, songComposer, songCover, songUrl) {
                // Show the music player
                musicPlayer.style.display = 'flex';
                
                // Update player information
                playerTitle.textContent = songTitle;
                playerComposer.textContent = songComposer;
                playerCover.src = songCover;
                
                // Set the audio source
                audioPlayer.src = songUrl;
                audioPlayer.load();
                
                // Play after metadata is loaded to ensure duration is available
                audioPlayer.addEventListener('loadedmetadata', function onMetadataLoaded() {
                audioPlayer.play();
                audioPlayer.removeEventListener('loadedmetadata', onMetadataLoaded);
                    
                // Update play/pause button
                playPauseButton.innerHTML = '<i class="fas fa-pause"></i>';
                });
                
                // Add to playlist if not already in it
                const pagePlaylist = Array.isArray(window.pagePlaylist) ? window.pagePlaylist : [];
                if (pagePlaylist.length > 0) {
                    window.playlist = pagePlaylist;
                }

                const playlist = window.playlist;
                const songExists = playlist.findIndex(song => song.id === songId);
                if (songExists === -1) {
                    playlist.push({
                        id: songId,
                        title: songTitle,
                        composer: songComposer,
                        cover: songCover,
                        url: songUrl
                    });
                    window.currentSongIndex = playlist.length - 1;
                } else {
                    window.currentSongIndex = songExists;
                }
            };
            
            // Play/Pause button
            playPauseButton.addEventListener('click', function() {
                if (audioPlayer.paused) {
                    audioPlayer.play();
                    playPauseButton.innerHTML = '<i class="fas fa-pause"></i>';
                } else {
                    audioPlayer.pause();
                    playPauseButton.innerHTML = '<i class="fas fa-play"></i>';
                }
            });
            
            // Previous button
            prevButton.addEventListener('click', function() {
                const playlist = window.playlist;
                if (playlist.length > 0 && window.currentSongIndex > 0) {
                    window.currentSongIndex--;
                    const prevSong = playlist[window.currentSongIndex];
                    playSong(prevSong.id, prevSong.title, prevSong.composer, prevSong.cover, prevSong.url);
                }
            });
            
            // Next button
            nextButton.addEventListener('click', function() {
                const playlist = window.playlist;
                if (playlist.length > 0 && window.currentSongIndex < playlist.length - 1) {
                    window.currentSongIndex++;
                    const nextSong = playlist[window.currentSongIndex];
                    playSong(nextSong.id, nextSong.title, nextSong.composer, nextSong.cover, nextSong.url);
                }
            });
            
            // Update progress bar
            audioPlayer.addEventListener('timeupdate', function() {
                updateProgressFromTime(audioPlayer.currentTime);
            });
            
            // Set duration when metadata is loaded
            audioPlayer.addEventListener('loadedmetadata', function() {
                updateTotalTime(getDuration());
                updateProgressFromTime(audioPlayer.currentTime);
            });

            audioPlayer.addEventListener('durationchange', function() {
                updateTotalTime(getDuration());
            });
            
            // SEEKING FUNCTIONALITY - robust pointer handling (mouse + touch)
            const getPositionFromEvent = (e) => {
                const rect = progressContainer.getBoundingClientRect();
                if (!rect.width) return 0;
                return Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));
            };

            const commitSeek = (position) => {
                const duration = getDuration();
                if (!duration) return;
                const newTime = position * duration;
                audioPlayer.currentTime = newTime;
                renderProgress(position);
                currentTime.textContent = formatTime(newTime);
            };

            const handlePointerMove = (e) => {
                if (!isDraggingProgress) return;
                const position = getPositionFromEvent(e);
                const duration = getDuration();
                renderProgress(position);
                currentTime.textContent = formatTime(duration ? position * duration : 0);
            };

            const endPointerDrag = (e) => {
                if (!isDraggingProgress) return;
                const position = getPositionFromEvent(e);
                commitSeek(position);
                isDraggingProgress = false;
                window.removeEventListener('pointermove', handlePointerMove);
                window.removeEventListener('pointerup', endPointerDrag);
                window.removeEventListener('pointercancel', endPointerDrag);
                if (wasPlayingBeforeDrag) {
                    audioPlayer.play().catch(() => {});
                }
                e.preventDefault();
            };

            progressContainer.addEventListener('pointerdown', function(e) {
                if (e.pointerType === 'mouse' && e.button !== 0) return;
                if (!getDuration()) return;

                wasPlayingBeforeDrag = !audioPlayer.paused;
                isDraggingProgress = true;

                const position = getPositionFromEvent(e);
                renderProgress(position);
                const duration = getDuration();
                currentTime.textContent = formatTime(duration ? position * duration : 0);

                window.addEventListener('pointermove', handlePointerMove);
                window.addEventListener('pointerup', endPointerDrag);
                window.addEventListener('pointercancel', endPointerDrag);
                e.preventDefault();
            });

            // Click seek for quick jumps
            progressContainer.addEventListener('click', function(e) {
                if (isDraggingProgress) return; // ignore click that ends a drag
                if (!getDuration()) return;
                const position = getPositionFromEvent(e);
                commitSeek(position);
            });
            
            // Volume control
            volumeContainer.addEventListener('click', function(e) {
                const percent = (e.offsetX / volumeContainer.offsetWidth);
                audioPlayer.volume = percent;
                volumeLevel.style.width = (percent * 100) + '%';
            });
            
            // Mute/unmute
            volumeIcon.addEventListener('click', function() {
                if (audioPlayer.muted) {
                    audioPlayer.muted = false;
                    volumeIcon.className = 'fas fa-volume-up volume-icon';
                } else {
                    audioPlayer.muted = true;
                    volumeIcon.className = 'fas fa-volume-mute volume-icon';
                }
            });
            
            // Play next song when current one ends
            audioPlayer.addEventListener('ended', function() {
                const playlist = window.playlist;
                if (playlist.length > 0 && window.currentSongIndex < playlist.length - 1) {
                    window.currentSongIndex++;
                    const nextSong = playlist[window.currentSongIndex];
                    playSong(nextSong.id, nextSong.title, nextSong.composer, nextSong.cover, nextSong.url);
                } else {
                    playPauseButton.innerHTML = '<i class="fas fa-play"></i>';
                }
            });
            
            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Space bar: Play/Pause
                if (e.code === 'Space' && !e.target.matches('input, textarea')) {
                    e.preventDefault();
                    playPauseButton.click();
                }
                
                // Right arrow: Next song or fast forward
                if (e.code === 'ArrowRight' && !e.target.matches('input, textarea')) {
                    if (e.shiftKey) {
                        // Fast forward 10 seconds
                        if (audioPlayer.readyState > 0) {
                            audioPlayer.currentTime = Math.min(audioPlayer.currentTime + 10, audioPlayer.duration);
                        }
                    } else {
                        nextButton.click();
                    }
                }
                
                // Left arrow: Previous song or rewind
                if (e.code === 'ArrowLeft' && !e.target.matches('input, textarea')) {
                    if (e.shiftKey) {
                        // Rewind 10 seconds
                        if (audioPlayer.readyState > 0) {
                            audioPlayer.currentTime = Math.max(audioPlayer.currentTime - 10, 0);
                        }
                    } else {
                        prevButton.click();
                    }
                }
                
                // M: Mute/Unmute
                if (e.code === 'KeyM' && !e.target.matches('input, textarea')) {
                    volumeIcon.click();
                }
                
                // Up arrow: Volume up
                if (e.code === 'ArrowUp' && !e.target.matches('input, textarea')) {
                    e.preventDefault();
                    audioPlayer.volume = Math.min(audioPlayer.volume + 0.1, 1);
                    volumeLevel.style.width = (audioPlayer.volume * 100) + '%';
                }
                
                // Down arrow: Volume down
                if (e.code === 'ArrowDown' && !e.target.matches('input, textarea')) {
                    e.preventDefault();
                    audioPlayer.volume = Math.max(audioPlayer.volume - 0.1, 0);
                    volumeLevel.style.width = (audioPlayer.volume * 100) + '%';
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
