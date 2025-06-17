<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sonorus</title>
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
        
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .auth-bg {
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
        
        .auth-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.7) 100%);
            z-index: -1;
        }
        
        .auth-card {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }
        
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .auth-logo {
            width: 80px;
            height: auto;
            margin-bottom: 1rem;
        }
        
        .auth-title {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #9B59B6, #3498DB);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            color: var(--light-color);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 0.8rem 1rem;
            color: var(--light-color);
            transition: all 0.3s;
        }
        
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(155, 89, 182, 0.25);
            color: white;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #9B59B6, #8E44AD);
            border: none;
            border-radius: 10px;
            padding: 0.8rem 1rem;
            font-weight: 500;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(155, 89, 182, 0.4);
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(155, 89, 182, 0.6);
            background: linear-gradient(45deg, #8E44AD, #9B59B6);
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 2rem;
        }
        
        .auth-footer a {
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .auth-footer a:hover {
            color: var(--accent-color);
        }
        
        .back-to-home {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            color: var(--light-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .back-to-home:hover {
            color: var(--primary-color);
        }
        
        .back-to-home i {
            margin-right: 0.5rem;
        }
        
        .invalid-feedback {
            color: #f56565;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-bg"></div>
        <div class="auth-overlay"></div>
        
        <a href="{{ route('welcome') }}" class="back-to-home">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
        
        <div class="auth-card">
            <div class="auth-header">
                <img src="{{ asset('images/sonorus-logo.png') }}" alt="Sonorus Logo" class="auth-logo">
                <h1 class="auth-title">Sonorus</h1>
                <p>Create a new account</p>
            </div>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i> Register
                    </button>
                </div>
                
                <div class="auth-footer">
                    <p>
                        Already have an account? <a href="{{ route('login') }}">Sign In</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
