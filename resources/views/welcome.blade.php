<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonorus - Classical Music Experience</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #9B59B6;
            --secondary-color: #8E44AD;
            --accent-color: #D6BCFA;
            --dark-color: #1A202C;
            --light-color: #F7FAFC;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--light-color);
            min-height: 100vh;
            overflow-x: hidden;
            background-color: #0F172A;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
        
        .welcome-container {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }
        
        .welcome-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1507838153414-b4b713384a76?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            filter: brightness(0.3);
            z-index: -1;
        }
        
        .welcome-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.7) 100%);
            z-index: -1;
        }
        
        .welcome-content {
            position: relative;
            z-index: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 100vh;
        }
        
        .logo-container {
            margin-bottom: 2rem;
        }
        
        .logo {
            width: 180px;
            height: auto;
            filter: drop-shadow(0 0 10px rgba(155, 89, 182, 0.5));
        }
        
        .brand-name {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            font-size: 4.5rem;
            margin-bottom: 0;
            background: linear-gradient(45deg, #9B59B6, #3498DB);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .tagline {
            font-size: 1.5rem;
            margin-bottom: 2.5rem;
            color: var(--light-color);
            font-weight: 300;
            max-width: 800px;
            letter-spacing: 1px;
        }
        
        .auth-buttons {
            display: flex;
            gap: 1.5rem;
            margin-top: 1rem;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #9B59B6, #8E44AD);
            border: none;
            border-radius: 50px;
            padding: 0.8rem 2.5rem;
            font-weight: 500;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(155, 89, 182, 0.4);
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(155, 89, 182, 0.6);
            background: linear-gradient(45deg, #8E44AD, #9B59B6);
        }
        
        .btn-outline-light {
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 50px;
            padding: 0.8rem 2.5rem;
            font-weight: 500;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        
        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.8);
            transform: translateY(-3px);
        }
        
        /* Carousel styling */
        .composers-section {
            width: 100%;
            max-width: 1200px;
            margin: 4rem auto;
            overflow: hidden;
            position: relative;
        }
        
        .section-title {
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            color: var(--light-color);
            font-family: 'Playfair Display', serif;
        }
        
        .composers-track {
            display: flex;
            width: calc(200px * 12); /* Width of each composer card * number of composers */
            animation: scrollComposers 40s linear infinite;
        }
        
        .composers-track:hover {
            animation-play-state: paused;
        }
        
        @keyframes scrollComposers {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(calc(-200px * 6)); /* Half the total width */
            }
        }
        
        .composer-item {
            width: 180px;
            margin: 0 10px;
            flex-shrink: 0;
            border-radius: 10px;
            overflow: hidden;
            background: rgba(30, 41, 59, 0.7);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
        }
        
        .composer-item:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 15px 30px rgba(142, 68, 173, 0.4);
            z-index: 1;
        }
        
        .composer-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-bottom: 3px solid var(--primary-color);
        }
        
        .composer-info {
            padding: 15px;
            text-align: center;
        }
        
        .composer-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            margin-bottom: 5px;
            color: var(--light-color);
        }
        
        .composer-years {
            font-size: 0.9rem;
            color: var(--accent-color);
            margin-bottom: 0;
        }
        
        .features {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
        }
        
        .feature-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            width: 300px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }
        
        .feature-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--light-color);
        }
        
        .feature-description {
            color: var(--light-color);
            opacity: 0.8;
        }
        
        .footer {
            margin-top: 3rem;
            text-align: center;
            color: var(--light-color);
            opacity: 0.7;
            font-size: 0.9rem;
        }
        
        .music-notes {
            position: absolute;
            opacity: 0.2;
            z-index: -1;
        }
        
        .note-1 {
            top: 10%;
            left: 5%;
            font-size: 3rem;
            animation: float 8s ease-in-out infinite;
        }
        
        .note-2 {
            top: 20%;
            right: 10%;
            font-size: 2.5rem;
            animation: float 6s ease-in-out infinite;
        }
        
        .note-3 {
            bottom: 15%;
            left: 10%;
            font-size: 2rem;
            animation: float 7s ease-in-out infinite;
        }
        
        .note-4 {
            bottom: 30%;
            right: 5%;
            font-size: 3.5rem;
            animation: float 9s ease-in-out infinite;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
            100% {
                transform: translateY(0) rotate(0deg);
            }
        }
        
        @media (max-width: 768px) {
            .brand-name {
                font-size: 3rem;
            }
            
            .tagline {
                font-size: 1.2rem;
            }
            
            .auth-buttons {
                flex-direction: column;
                gap: 1rem;
            }
            
            .composer-item {
                width: 160px;
            }
            
            .composer-image {
                height: 180px;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-bg"></div>
        <div class="welcome-overlay"></div>
        
        <!-- Floating Music Notes -->
        <div class="music-notes note-1">
            <i class="fas fa-music"></i>
        </div>
        <div class="music-notes note-2">
            <i class="fas fa-music"></i>
        </div>
        <div class="music-notes note-3">
            <i class="fas fa-music"></i>
        </div>
        <div class="music-notes note-4">
            <i class="fas fa-music"></i>
        </div>
        
        <div class="welcome-content">
            <div class="logo-container">
                <img src="{{ asset('images/sonorus-logo.png') }}" alt="Sonorus Logo" class="logo">
            </div>
            
            <h1 class="brand-name">Sonorus</h1>
            <p class="tagline">Embark on a journey through the timeless beauty of classical music. Discover masterpieces from legendary composers and immerse yourself in the rich tapestry of musical history.</p>
            
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i> Sign In
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-user-plus me-2"></i> Register
                </a>
            </div>
            
            <!-- Infinite Scrolling Composers -->
            <div class="composers-section">
                <h3 class="section-title">Legendary Composers</h3>
                <div class="composers-track">
                    <!-- First set of composers -->
                    <div class="composer-item">
                        <img src="{{ asset('images/composers/bach.jpg') }}" alt="Johann Sebastian Bach" class="composer-image">
                        <div class="composer-info">
                            <h4 class="composer-name">J.S. Bach</h4>
                            <p class="composer-years">1685 - 1750</p>
                        </div>
                    </div>
                    
                    <div class="composer-item">
                        <img src="{{ asset('images/composers/mozart.jpg') }}" alt="Wolfgang Amadeus Mozart" class="composer-image">
                        <div class="composer-info">
                            <h4 class="composer-name">Mozart</h4>
                            <p class="composer-years">1756 - 1791</p>
                        </div>
                    </div>
                    
                    <div class="composer-item">
                        <img src="{{ asset('images/composers/beethoven.jpg') }}" alt="Ludwig van Beethoven" class="composer-image">
                        <div class="composer-info">
                            <h4 class="composer-name">Beethoven</h4>
                            <p class="composer-years">1770 - 1827</p>
                        </div>
                    </div>
                    
                    <div class="composer-item">
                        <img src="{{ asset('images/composers/chopin.jpg') }}" alt="Frédéric Chopin" class="composer-image">
                        <div class="composer-info">
                            <h4 class="composer-name">Chopin</h4>
                            <p class="composer-years">1810 - 1849</p>
                        </div>
                    </div>

                    <div class="composer-item">
                        <img src="{{ asset('images/composers/dvorak.jpg') }}" alt="Frédéric Chopin" class="composer-image">
                        <div class="composer-info">
                            <h4 class="composer-name">Dvořák</h4>
                            <p class="composer-years">1841 - 1904</p>
                        </div>
                    </div>
                    
                    <div class="composer-item">
                        <img src="{{ asset('images/composers/tchaikovsky.jpg') }}" alt="Pyotr Ilyich Tchaikovsky" class="composer-image">
                        <div class="composer-info">
                            <h4 class="composer-name">Tchaikovsky</h4>
                            <p class="composer-years">1840 - 1893</p>
                        </div>
                    </div>
                    
                    <div class="composer-item">
                        <img src="{{ asset('images/composers/debussy.jpg') }}" alt="Claude Debussy" class="composer-image">
                        <div class="composer-info">
                            <h4 class="composer-name">Debussy</h4>
                            <p class="composer-years">1862 - 1918</p>
                        </div>
                    </div>
                    
                    <!-- Duplicate the composers for seamless scrolling -->
                    <div class="composer-item">
                        <img src="{{ asset('images/composers/bach.jpg') }}" alt="Johann Sebastian Bach" class="composer-image">
                        <div class="composer-info">
                            <h4 class="composer-name">J.S. Bach</h4>
                            <p class="composer-years">1685 - 1750</p>
                        </div>
                    </div>
                    
                    <div class="composer-item">
                        <img src="{{ asset('images/composers/mozart.jpg') }}" alt="Wolfgang Amadeus Mozart" class="composer-image">
                        <div class="composer-info">
                            <h4 class="composer-name">Mozart</h4>
                            <p class="composer-years">1756 - 1791</p>
                        </div>
                    </div>
                    
                    <div class="composer-item">
                        <img src="{{ asset('images/composers/beethoven.jpg') }}" alt="Ludwig van Beethoven" class="composer-image">
                        <div class="composer-info">
                            <h4 class="composer-name">Beethoven</h4>
                            <p class="composer-years">1770 - 1827</p>
                        </div>
                    </div>
                    
                    <div class="composer-item">
                        <img src="{{ asset('images/composers/chopin.jpg') }}" alt="Frédéric Chopin" class="composer-image">
                        <div class="composer-info">
                            <h4 class="composer-name">Chopin</h4>
                            <p class="composer-years">1810 - 1849</p>
                        </div>
                    </div>
                    
                    <div class="composer-item">
                        <img src="{{ asset('images/composers/tchaikovsky.jpg') }}" alt="Pyotr Ilyich Tchaikovsky" class="composer-image">
                        <div class="composer-info">
                            <h4 class="composer-name">Tchaikovsky</h4>
                            <p class="composer-years">1840 - 1893</p>
                        </div>
                    </div>
                    
                    <div class="composer-item">
                        <img src="{{ asset('images/composers/debussy.jpg') }}" alt="Claude Debussy" class="composer-image">
                        <div class="composer-info">
                            <h4 class="composer-name">Debussy</h4>
                            <p class="composer-years">1862 - 1918</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer">
                <p>&copy; {{ date('Y') }} Sonorus. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
