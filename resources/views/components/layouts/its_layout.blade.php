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
    {{-- <div class="px-3 py-4 flex-shrink-0" x-show="sidebarOpen">
      <div class="relative">
        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input type="text" x-model="searchQuery" placeholder="Search..." class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"/>
      </div>
    </div> --}}
    <!-- Menu -->
    <nav class="flex-1 min-h-0 px-3 py-6 space-y-1 text-sm overflow-y-auto overflow-x-hidden">
      <!-- DASHBOARD -->
      <div class="mb-4">
        <p x-show="sidebarOpen" class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mb-2">Main</p>
        <a wire:navigate href="/dashboard" @click="active='dashboard'; if (window.innerWidth < 768) sidebarOpen = false" class="sidebar-btn w-full {{ request()->is('dashboard') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }}" >
          <span class="sidebar-icon-wrap"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
          </svg></span>
          <button x-show="sidebarOpen" class="ml-3">Dashboard</button>
        </a>
      </div>
      <!-- INVENTORY -->
      <div class="mb-4">
        <p x-show="sidebarOpen" class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mb-2">Inventory</p>
        <a href="/inventory" wire:navigate @click="active='inventory'; if (window.innerWidth < 768) sidebarOpen = false" class="sidebar-btn w-full {{ request()->is('inventory') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }}">
          <span class="sidebar-icon-wrap"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
          </svg></span>
          <button  x-show="sidebarOpen" class="ml-3">Asset Management</button>
        </a>
        <a href="/assigned-pc" wire:navigate @click="active='pc-assignment'; if (window.innerWidth < 768) sidebarOpen = false" class="sidebar-btn w-full {{ request()->is('assigned-pc') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }}">
          <span class="sidebar-icon-wrap"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg></span>
          <button  x-show="sidebarOpen" class="ml-3">PC Assignment</button>
        </a>
        <a href="/assigned-ap" wire:navigate @click="active='ap-assignment'; if (window.innerWidth < 768) sidebarOpen = false" class="sidebar-btn w-full {{ request()->is('assigned-ap') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }}">
          <span class="sidebar-icon-wrap"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 0 1 7.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 0 1 1.06 0Z" />
            </svg>
          </span>
          <button  x-show="sidebarOpen" class="ml-3">AP Assignment</button>
        </a>
        <a href="/scancode" @click="active='ap-assignment'; if (window.innerWidth < 768) sidebarOpen = false" class="sidebar-btn w-full {{ request()->is('scancode') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }}">
          <span class="sidebar-icon-wrap"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
          </svg>

          </span>
          <button  x-show="sidebarOpen" class="ml-3">Scan QR</button>
        </a>
        <a href="/stocks" @click="active='stocks'; if (window.innerWidth < 768) sidebarOpen = false" class="sidebar-btn w-full {{ request()->is('stocks') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }}">
          <span class="sidebar-icon-wrap"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
          </svg>

          </span>
          <button  x-show="sidebarOpen" class="ml-3">Stocks</button>
        </a>
        {{-- <a href="/APlocation" wire:navigate @click="active='ap-assignment'; if (window.innerWidth < 768) sidebarOpen = false" class="sidebar-btn w-full {{ request()->is('APlocation') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }}">
          <span class="sidebar-icon-wrap"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 0 1 7.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 0 1 1.06 0Z" />
            </svg>
          </span>
          <button  x-show="sidebarOpen" class="ml-3">AP Location</button>
        </a> --}}
        <!-- Department Dropdown -->
        {{-- <div class="relative">
          <a href="/department" wire:navigate @click="sidebarOpen ? (departmentOpen = !departmentOpen) : (active='department'); if (window.innerWidth < 768 && departmentOpen) sidebarOpen = true" class="sidebar-btn w-full flex items-center justify-between {{ request()->is('department') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }}">
            <div class="flex items-center flex-1 min-w-0">
              <span class="sidebar-icon-wrap"><svg class="flex-shrink-0 transition-[width,height] duration-200" :class="sidebarOpen ? 'w-5 h-5' : 'w-7 h-7'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
              </svg></span>
              <button  class="ml-3 truncate">Departments</button>
            </div>
          </a>
          
        </div> --}}
        
      </div>

      <!-- ================= CAMPUSES SIDEBAR BUTTON ================= -->
      <div class="mb-4">
        <p x-show="sidebarOpen" class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mb-2">ORGANIZATION</p>
        <div class="relative">
          <a href="/department" wire:navigate class="sidebar-btn w-full flex items-center justify-between {{ request()->is('department') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }}">
            <div class="flex items-center flex-1 min-w-0">
              <span class="sidebar-icon-wrap"><svg class="flex-shrink-0 transition-[width,height] duration-200" :class="sidebarOpen ? 'w-5 h-5' : 'w-7 h-7'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
              </svg></span>
              <button  class="ml-3 truncate">Departments</button>
            </div>
          </a>
          
        </div>
        <a  href="/campus" class="sidebar-btn w-full flex items-center">
          <span class="sidebar-icon-wrap">
            <svg class="flex-shrink-0 transition-[width,height] duration-200" :class="sidebarOpen ? 'w-5 h-5' : 'w-7 h-7'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4zm2 6l7 3 7-3m-7 3v5"/>
            </svg>
          </span>
          {{-- <span x-show="sidebarOpen" class="ml-3 truncate">Campuses</span> --}}
            
            <button  class="ml-3 truncate">
              Campus
            </button>
        </a>
      </div>
      <!-- ================= END CAMPUSES SIDEBAR ================= -->
      <!-- Admin -->
      @can('view-page')
      <div class="mb-4">
        <p x-show="sidebarOpen" class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mb-2">Admin</p>
        <a href="/accounts"  class="{{ request()->is('accounts') ? 'bg-primary/10 text-primary border-l-4 border-primary' : '' }} sidebar-btn w-full" :class="active==='tickets' && 'bg-primary/10 text-primary border-l-4 border-primary'">
          <span class="sidebar-icon-wrap"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
          </span>
          <span x-show="sidebarOpen" class="ml-3">Accounts</span>
        </a>
      </div>
      @endcan
    </nav>

    <!-- User Section -->
    <livewire:layout.navigation />
    

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

    
    <div class="absolute right-4 top-4 md:hidden">
      <button @click="sidebarOpen = !sidebarOpen" class="flex-shrink-0 p-2 -ml-2 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors">
        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>
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
     