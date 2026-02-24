<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>ITS Inventory System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="/img/its_logo.png">
  @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-gray-50 text-gray-800">

<div 
  x-data="{ 
    sidebarOpen: false,
    {{-- departmentOpen: false,
    campusOpen: false,
    topbarScrolled: false, --}}
    isMobile: false,
    active: 'dashboard',
    searchQuery: '',
    selectedCampus: 'all',
    selectedDepartment: 'all',
    selectedStatus: 'all',
    departments: ['ITS', 'ACCOUNT', 'CASHIER', 'REGISTRAR', 'BTAC', 'BOOKSTORE'],
    init() {
      const update = () => {
        this.isMobile = window.innerWidth < 768;
        if (this.isMobile) { this.sidebarOpen = false; this.departmentOpen = false; this.campusOpen = false; }
        else { this.sidebarOpen = true; this.departmentOpen = false; this.campusOpen = false; }
      };
      update();
      window.addEventListener('resize', update);
    }
  }"
  class="flex min-h-screen"
>

  <!--  SIDEBAR -->
  <aside x-cloak :class="sidebarOpen ? 'sidebar-w-open translate-x-0' : '-translate-x-full md:translate-x-0 md:w-20'" class="bg-white border-r border-gray-200 transition-all duration-300 flex flex-col fixed z-50 top-0 left-0 h-full min-h-screen max-h-screen shadow-sm">
    <!-- Logo -->
    <div class="h-16 flex items-center gap-3 px-4 flex-shrink-0">
      <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-primaryDark flex items-center justify-center flex-shrink-0">
        <span class="text-white font-bold text-lg">ITS</span>
      </div>
      <span x-show="sidebarOpen" class="font-bold text-gray-900 text-lg">ITS Inventory</span>
    </div>
    <!-- Search Bar -->
    <div class="px-3 py-4 flex-shrink-0" x-show="sidebarOpen">
      <div class="relative">
        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input type="text" x-model="searchQuery" placeholder="Search..." class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"/>
      </div>
    </div>
    <!-- Menu -->
    <nav class="flex-1 min-h-0 px-3 py-6 space-y-1 text-sm overflow-y-auto overflow-x-hidden">
      <!-- DASHBOARD -->
      <div class="mb-4">
        <p x-show="sidebarOpen" class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mb-2">Main</p>
        <button @click="active='dashboard'; if (window.innerWidth < 768) sidebarOpen = false" class="sidebar-btn w-full {{ request()->is('dashboard') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }}" >
          <span class="sidebar-icon-wrap"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
          </svg></span>
          <a href="/dashboard" wire:navigate x-show="sidebarOpen" class="ml-3">Dashboard</a>
        </button>
      </div>
      <!-- INVENTORY -->
      <div class="mb-4">
        <p x-show="sidebarOpen" class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mb-2">Inventory</p>
        <button @click="active='inventory'; if (window.innerWidth < 768) sidebarOpen = false" class="sidebar-btn w-full {{ request()->is('inventory') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }}">
          <span class="sidebar-icon-wrap"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
          </svg></span>
          <a href="/inventory" wire:navigate x-show="sidebarOpen" class="ml-3">Asset Management</a>
        </button>
        <button @click="active='pc-assignment'; if (window.innerWidth < 768) sidebarOpen = false" class="sidebar-btn w-full {{ request()->is('assigned-pc') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }}">
          <span class="sidebar-icon-wrap"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg></span>
          <a href="assigned-pc" wire:navigate x-show="sidebarOpen" class="ml-3">PC Assignment</a>
        </button>
        <!-- Department Dropdown -->
        <div class="relative">
          <button @click="sidebarOpen ? (departmentOpen = !departmentOpen) : (active='department'); if (window.innerWidth < 768 && departmentOpen) sidebarOpen = true" class="sidebar-btn w-full flex items-center justify-between {{ request()->is('department') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }}">
            <div class="flex items-center flex-1 min-w-0">
              <span class="sidebar-icon-wrap"><svg class="flex-shrink-0 transition-[width,height] duration-200" :class="sidebarOpen ? 'w-5 h-5' : 'w-7 h-7'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
              </svg></span>
              <a href="/department" wire:navigate class="ml-3 truncate">Departments</a>
            </div>
          </button>
          
        </div>
        <button @click="active='qr-scanner'; if (window.innerWidth < 768) sidebarOpen = false" class="sidebar-btn w-full" :class="active==='qr-scanner' && 'bg-primary/10 text-primary border-l-4 border-primary'">
          <span class="sidebar-icon-wrap"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
          </svg></span>
          <span x-show="sidebarOpen" class="ml-3">QR Scanner</span>
        </button>
        <button @click="active='maintenance'; if (window.innerWidth < 768) sidebarOpen = false" class="sidebar-btn w-full" :class="active==='maintenance' && 'bg-primary/10 text-primary border-l-4 border-primary'">
          <span class="sidebar-icon-wrap"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg></span>
          <span x-show="sidebarOpen" class="ml-3">Maintenance</span>
        </button>
      </div>

      <!-- ================= CAMPUSES SIDEBAR BUTTON ================= -->
      <div class="mb-4">
        <p x-show="sidebarOpen" class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mb-2">Campuses</p>
        @foreach ($campuses as $campus)
        <button @click="active='campuses'"  class="sidebar-btn w-full flex items-center">
          <span class="sidebar-icon-wrap">
            <svg class="flex-shrink-0 transition-[width,height] duration-200" :class="sidebarOpen ? 'w-5 h-5' : 'w-7 h-7'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4zm2 6l7 3 7-3m-7 3v5"/>
            </svg>
          </span>
          {{-- <span x-show="sidebarOpen" class="ml-3 truncate">Campuses</span> --}}
            
              <span x-show="sidebarOpen" class="ml-3 truncate">
                {{ $campus->name }}
              </span>
        </button>
          @endforeach
      </div>
      <!-- ================= END CAMPUSES SIDEBAR ================= -->
      <!-- SUPPORT -->
      <div class="mb-4">
        <p x-show="sidebarOpen" class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mb-2">Support</p>
        <button @click="active='tickets'; if (window.innerWidth < 768) sidebarOpen = false"  class="sidebar-btn w-full" :class="active==='tickets' && 'bg-primary/10 text-primary border-l-4 border-primary'">
          <span class="sidebar-icon-wrap"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg></span>
          <span x-show="sidebarOpen" class="ml-3">Tickets</span>
        </button>
        <button @click="active='reports'; if (window.innerWidth < 768) sidebarOpen = false"  class="sidebar-btn w-full"  :class="active==='reports' && 'bg-primary/10 text-primary border-l-4 border-primary'">
          <span class="sidebar-icon-wrap"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
          </svg></span>
          <span x-show="sidebarOpen" class="ml-3">Reports</span>
        </button>
      </div>
    </nav>

    <!-- User Section -->
    <div class="p-4 flex-shrink-0">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-primaryDark flex items-center justify-center flex-shrink-0">
          <span class="text-white font-semibold text-sm">IA</span>
        </div>
        <div x-show="sidebarOpen" class="flex-1 min-w-0">
          <p class="text-sm font-semibold text-gray-900 truncate">ITS Admin</p>
          <p class="text-xs text-gray-500 truncate">Admin Manager</p>
        </div>
      </div>
      <a x-show="sidebarOpen" href="#" class="mt-3 flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>
        Log out
      </a>
    </div>

    <!-- Collapse Button -->
    <button @click="sidebarOpen=!sidebarOpen" class="h-12 hover:bg-gray-50 flex items-center justify-center transition-colors flex-shrink-0">
      <svg x-show="sidebarOpen" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
      </svg>
      <svg x-show="!sidebarOpen" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
      </svg>
    </button>
  </aside>

  <!-- Mobile Overlay -->
  <div x-show="sidebarOpen && isMobile" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-40 md:hidden" x-transition></div>

  <!--  MAIN -->
  <div class="flex-1 flex flex-col min-w-0 " :class="sidebarOpen ? 'md:ml-64' : 'md:ml-20'">

    <!-- TOPBAR -->
    {{-- <header class="topbar-height flex items-center justify-between px-3 sm:px-5 md:px-6 sticky top-0 z-30 transition-all duration-300" :class="topbarScrolled ? 'topbar-scrolled' : 'topbar-plain'">
        <div class="flex items-center gap-3 min-w-0 flex-1">
            <button @click="sidebarOpen = !sidebarOpen" class="flex-shrink-0 p-2 -ml-2 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors md:hidden">
                <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
        <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-primary to-primaryDark flex items-center justify-center text-white font-semibold text-sm cursor-pointer hover:opacity-90 transition-opacity shadow-md ring-2 ring-white">
                IA
            </div>
        </div>
    </header> --}}

    <!-- CONTENT -->
    <main x-cloak class="main-content-padding space-y-6 bg-gray-50 flex-1 min-w-0 overflow-y-auto" @scroll.passive="topbarScrolled = $event.target.scrollTop > 8">

      {{ $slot }}
      
    </main>
</div>

<!-- Styles -->
<style>
  .sidebar-btn {
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    color: #6b7280;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    border-left: 4px solid transparent;
  }
  .sidebar-btn:hover { 
    background: #f3f4f6; 
    color: #111827;
  }
  .sidebar-icon-wrap {
    width: 1.75rem;
    min-width: 1.75rem;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .stat-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .stat-card:hover {
    transform: translateY(-2px);
  }
  
  /* Sidebar: fixed, full height, nav scrolls independently */
  aside {
    position: fixed !important;
    top: 0;
    left: 0;
    height: 100vh;
    height: 100dvh;
    overflow: hidden;
    z-index: 50;
  }
  aside nav {
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: thin;
    scrollbar-color: #d1d5db transparent;
    -webkit-overflow-scrolling: touch;
  }
  aside nav::-webkit-scrollbar {
    width: 6px;
  }
  aside nav::-webkit-scrollbar-track {
    background: transparent;
  }
  aside nav::-webkit-scrollbar-thumb {
    background-color: #d1d5db;
    border-radius: 3px;
  }
  aside nav::-webkit-scrollbar-thumb:hover {
    background-color: #9ca3af;
  }
  
  .topbar-height {
    height: 3.5rem;
    min-height: 3.5rem;
  }
  @media (min-width: 375px) {
    .topbar-height { height: 4rem; min-height: 4rem; }
  }
  @media (min-width: 640px) {
    .topbar-height { height: 4.5rem; min-height: 4.5rem; }
  }
  @media (min-width: 768px) {
    .topbar-height { height: 4rem; min-height: 4rem; }
  }
  .topbar-plain {
    /* background: rgba(249,250,251,0.7); */
    /* border-bottom: 1px solid transparent; */
    /* box-shadow: none; */
  }
  .topbar-scrolled {
    background: rgba(255,255,255,0.96) !important;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(0,0,0,0.08) !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
  }
  @media (max-width: 767px) {
    .topbar-plain {
      background: rgba(249,250,251,0.75);
    }
    .topbar-scrolled {
      background: linear-gradient(135deg, rgba(16,185,129,0.14) 0%, rgba(5,150,105,0.18) 100%) !important;
      border-bottom-color: rgba(16,185,129,0.3) !important;
      box-shadow: 0 2px 10px rgba(16,185,129,0.12);
    }
  }
  .sidebar-w-open {
    width: min(85vw, 288px);
  }
  @media (min-width: 640px) {
    .sidebar-w-open { width: 288px; }
  }
  @media (min-width: 768px) {
    .sidebar-w-open { width: 16rem; }
  }
  @media (min-width: 1024px) {
    .sidebar-w-open { width: 18rem; }
  }
  .main-content-padding {
    padding: 0.75rem 1rem 1rem;
  }
  @media (min-width: 375px) {
    .main-content-padding { padding-left: 1.25rem; padding-right: 1rem; padding-top: 1rem; padding-bottom: 1rem; }
  }
  @media (min-width: 640px) {
    .main-content-padding { padding: 1rem 1.25rem; }
  }
  @media (min-width: 768px) {
    .main-content-padding { padding-left: 2.5rem; padding-right: 1.5rem; padding-top: 1.5rem; padding-bottom: 1.5rem; }
  }
  @media (min-width: 1024px) {
    .main-content-padding { padding-left: 3rem; padding-right: 2rem; padding-top: 2rem; padding-bottom: 2rem; }
  }
  @media (max-width: 640px) {
    .stat-card {
      padding: 1rem;
    }
    .stat-card p.text-3xl {
      font-size: 1.75rem;
    }
  }
</style>

@livewireScripts
</body>
</html>
     