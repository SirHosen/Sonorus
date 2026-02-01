@extends('layouts.admin')

@section('title', 'Dashboard')

@section('styles')
<style>
    .welcome-hero {
        background: linear-gradient(135deg, rgba(252, 211, 77, 0.1) 0%, rgba(15, 23, 42, 0) 100%);
        padding: 3rem 2rem;
        border-radius: 20px;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(252, 211, 77, 0.1);
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        background: linear-gradient(to right, #fff, #fbbf24);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }
    
    .hero-subtitle {
        color: #94a3b8;
        font-size: 1.1rem;
        max-width: 600px;
    }
    
    .hero-ornament {
        position: absolute;
        right: 0;
        top: 0;
        width: 300px;
        height: 100%;
        background: radial-gradient(circle at 70% 30%, rgba(252, 211, 77, 0.15) 0%, transparent 70%);
        filter: blur(40px);
        pointer-events: none;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .stat-widget {
        background: rgba(30, 41, 59, 0.6);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .stat-widget:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        border-color: rgba(252, 211, 77, 0.3);
        background: rgba(30, 41, 59, 0.8);
    }

    .stat-widget::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.05) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.4s;
    }

    .stat-widget:hover::before {
        opacity: 1;
    }

    .stat-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 2;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }
    
    .icon-users {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: #eff6ff;
    }
    
    .icon-composers {
        background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%);
        color: #fffbeb;
    }
    
    .icon-songs {
        background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
        color: #fdf2f8;
    }
    
    .stat-content {
        position: relative;
        z-index: 2;
    }

    .stat-value {
        font-size: 3.5rem;
        font-weight: 700;
        color: #fff;
        line-height: 1;
        margin-bottom: 0.5rem;
        font-family: 'Playfair Display', serif;
        text-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .stat-label {
        font-size: 0.9rem;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 600;
    }

    .stat-bg-icon {
        position: absolute;
        right: -20px;
        bottom: -20px;
        font-size: 8rem;
        opacity: 0.03;
        transform: rotate(-15deg);
        transition: all 0.5s ease;
        z-index: 1;
    }
    
    .stat-widget:hover .stat-bg-icon {
        transform: rotate(0deg) scale(1.1);
        opacity: 0.1;
    }

    .action-link {
        display: inline-flex;
        align-items: center;
        margin-top: 1.5rem;
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.05);
    }
    
    .action-link:hover {
        background: rgba(255,255,255,0.1);
        color: #fff;
        transform: translateX(5px);
    }
    
    .action-link i {
        font-size: 0.8rem;
        margin-left: 8px;
    }
</style>
@endsection

@section('content')
<div class="welcome-hero">
    <div class="hero-content">
        <h2 class="hero-title">Welcome back, {{ Auth::user()->name }}</h2>
        <p class="hero-subtitle">Orchestrate your platform's content with precision and elegance.</p>
    </div>
    <div class="hero-ornament"></div>
</div>

<div class="dashboard-grid">
    <!-- Users Widget -->
    <div class="stat-widget">
        <div class="stat-icon-wrapper icon-users">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $totalUsers }}</div>
            <div class="stat-label">Active Users</div>
            <a href="{{ route('admin.users.index') }}" class="action-link">
                Manage Users <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <i class="fas fa-users stat-bg-icon"></i>
    </div>
    
    <!-- Composers Widget -->
    <div class="stat-widget">
        <div class="stat-icon-wrapper icon-composers">
            <i class="fas fa-feather-alt"></i>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $totalComposers }}</div>
            <div class="stat-label">Composers</div>
            <a href="{{ route('admin.composers.index') }}" class="action-link">
                View Collection <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <i class="fas fa-feather-alt stat-bg-icon"></i>
    </div>
    
    <!-- Songs Widget -->
    <div class="stat-widget">
        <div class="stat-icon-wrapper icon-songs">
            <i class="fas fa-music"></i>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $totalSongs }}</div>
            <div class="stat-label">Musical Pieces</div>
            <a href="{{ route('admin.songs.index') }}" class="action-link">
                Manage Library <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <i class="fas fa-music stat-bg-icon"></i>
    </div>
</div>
@endsection
