<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login | ITS Inventory System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>tailwind.config = { theme: { extend: { colors: { primary: '#10b981', primaryDark: '#059669' } } } }</script>
  <link rel="icon" type="image/png" href="/img/its_logo.png">
  <style>
    .logo-link h1 {
      position: relative;
      display: inline-block;
      padding-bottom: 8px;
    }
    .logo-link h1::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 3px;
      background-color: white;
      transition: width 0.4s ease;
    }
    .logo-link:hover h1::after {
      width: 70%;
    }
    .left-design {
      background: linear-gradient(135deg, #001a4d 0%, #0052cc 20%, #059669 45%, #10b981 60%, #4c0099 85%, #001a4d 100%);
      position: relative;
      overflow: hidden;
    }
    .left-design::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
      background-size: 50px 50px;
      animation: float 20s linear infinite;
    }
    @keyframes float {
      0% { transform: translate(0, 0) rotate(0deg); }
      100% { transform: translate(50px, 50px) rotate(360deg); }
    }
    .left-content {
      position: relative;
      z-index: 20;
    }
    .feature-icon {
      width: 50px;
      height: 50px;
      background: rgba(255,255,255,0.1);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 12px;
      border: 2px solid rgba(255,255,255,0.2);
    }
    .login-card {
      position: relative;
      overflow: hidden;
      background: linear-gradient(135deg, #ffffff 0%, #f0f4ff 100%);
      border: 2px solid transparent;
      background-clip: padding-box;
    }
    .login-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #059669 0%, #10b981 50%, #059669 100%);
      background-size: 200% 100%;
      animation: gradient-shift 3s ease infinite;
    }
    @keyframes gradient-shift {
      0%, 100% { background-position: 0% center; }
      50% { background-position: 100% center; }
    }
    .form-input {
      position: relative;
      transition: all 0.3s ease;
    }
    .form-input input {
      border: 2px solid #e5e7eb;
      transition: all 0.3s ease;
    }
    .form-input input:focus {
      border-color: #10b981;
      box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    }
    .btn-submit {
      background: linear-gradient(135deg, #059669 0%, #10b981 100%);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
    }
    .mobile-header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 60px;
      background: white;
      border-bottom: 1px solid #e5e7eb;
      display: flex;
      align-items: center;
      padding: 0 16px;
      z-index: 50;
    }
  </style>
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    

    <div class="mobile-header md:hidden">
    <a href="/" class="flex items-center gap-2 text-primary hover:text-primaryDark transition font-medium">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      Back
    </a>
  </div>

  <div class="w-full min-h-screen grid md:grid-cols-2">

    <!--  LEFT SIDE (IMAGE / BRANDING) -->
    <div class="hidden md:flex relative left-design text-white">
      
      <!-- Animated Background -->
      <div class="absolute inset-0 opacity-20"></div>

      <!-- Content -->
      <div class="relative left-content flex flex-col justify-center px-16 w-full">
        <div class="mb-8">
          <a href="home.html" class="logo-link inline-block mb-8">
            <h1 class="text-5xl font-bold">
              ITS Inventory System
            </h1>
          </a>
        </div>

        <p class="text-lg opacity-90 max-w-md mb-12">
          Secure internal platform for IT asset management,
          ticket handling, and system operations.
        </p>

        <!-- Feature List -->
        <div class="space-y-6">
          <div class="flex items-start gap-4">
            <div class="feature-icon">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.429 5.951 1.429a1 1 0 001.169-1.409l-7-14z"/>
              </svg>
            </div>
            <div>
              <h3 class="font-semibold">Asset Management</h3>
              <p class="text-sm opacity-75">Track IT assets efficiently</p>
            </div>
          </div>
          
          <div class="flex items-start gap-4">
            <div class="feature-icon">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
              </svg>
            </div>
            <div>
              <h3 class="font-semibold">Ticketing System</h3>
              <p class="text-sm opacity-75">Manage support requests</p>
            </div>
          </div>

          <div class="flex items-start gap-4">
            <div class="feature-icon">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div>
              <h3 class="font-semibold">Secure Access</h3>
              <p class="text-sm opacity-75">Role-based permissions</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--  RIGHT SIDE (LOGIN FORM) -->
    <div class="flex items-center justify-center bg-gray-50 px-6 py-12 md:py-0">
      <div class="w-full max-w-md login-card rounded-2xl shadow-2xl p-8">

        <!-- Logo / Title -->
        <div class="mb-10 text-center">
          <h2 class="text-3xl font-bold text-gray-900">
            Welcome Back
          </h2>
          <p class="text-sm text-gray-600 mt-2">
            Authorized IT personnel only
          </p>
        </div>

        <!-- Login Form -->
        <livewire:pages.auth.login/>

        <!-- Divider -->
        <div class="relative my-6">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
          </div>
          <div class="relative flex justify-center text-xs">
            <span class="px-2 bg-gradient-to-r from-white via-gray-50 to-white text-gray-500">
              Secure portal for IT staff
            </span>
          </div>
        </div>

        <!-- Footer -->
        <p class="text-xs text-gray-400 text-center">
          © 2026 ITS Department — Internal Use Only
        </p>

      </div>
    </div>

  </div>
    
    
</body>
</html>