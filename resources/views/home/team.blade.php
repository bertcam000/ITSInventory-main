<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Team | ITS Inventory System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>tailwind.config = { theme: { extend: { colors: { primary: '#10b981', primaryDark: '#059669' } } } }</script>
  <link rel="icon" type="image/png" href="/img/its_logo.png">
  @vite('resources/css/app.css')
  <style>
    .reveal {
      opacity: 0;
      transform: translateY(50px);
      transition: all 0.8s ease-out;
    }

    .reveal.active {
      opacity: 1;
      transform: translateY(0);
    }

    .team-hero {
      background: linear-gradient(135deg, #001a4d 0%, #0052cc 20%, #059669 45%, #10b981 60%, #4c0099 85%, #001a4d 100%);
    }

    .team-hero-pattern {
      position: absolute;
      inset: 0;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.06) 1px, transparent 1px);
      background-size: 40px 40px;
      animation: float-team 25s linear infinite;
    }

    @keyframes float-team {
      0% {
        transform: translate(0, 0) rotate(0deg);
      }

      100% {
        transform: translate(40px, 40px) rotate(360deg);
      }
    }

    /* Navbar link underline + active state */
    .nav-link {
      position: relative;
      padding-bottom: 0.25rem;
    }
    .nav-link::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 0;
      height: 2px;
      background: #10b981;
      border-radius: 999px;
      transition: width 0.2s ease;
    }
    .nav-link:hover::after {
      width: 100%;
    }
    .nav-link-active {
      font-weight: 600;
    }
    .nav-link-active::after {
      width: 100%;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800">

  <!--  NAVBAR (PUBLIC) -->
  <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300
          text-white">
      <div class="flex justify-around py-3 px-2 lg:grid lg:grid-cols-3 lg:py-5 lg:px-5">

        <!-- LOGO -->
        <h1 class="hidden lg:block text-2xl lg:text-center font-semibold transition-colors duration-300">
          ITS Inventory System
        </h1>

        <!-- LINKS -->
        <div class="flex justify-center items-center gap-8">
          <ul class="flex items-center gap-8 text-sm">
            <li><a href="/" class="{{ request()->is('/') ? 'border-b-2 border-green-500' : '' }} text-lg">Home</a></li>
            <li><a href="/about" class="{{ request()->is('about') ? 'border-b-2 border-green-500' : '' }} text-lg">About</a></li>
            <li><a href="/team" class="{{ request()->is('team') ? 'border-b-2 border-green-500' : '' }} text-lg">Team</a></li>
          </ul>
        </div>

        <!-- ACTIONS -->
        <div class="flex items-center gap-3 justify-end ">
          
          <a href="/login" class="px-4 py-2 rounded-md text-sm font-medium text-white
          bg-gradient-to-r from-emerald-500 to-green-600
          hover:from-emerald-600 hover:to-green-700
          transition-all duration-300 shadow-sm">
            Login
          </a>

        </div>
    </nav>

  <!--  HEADER (galaxy + green) -->
  <header class="team-hero text-white relative overflow-hidden">
    <div class="team-hero-pattern"></div>
    <div class="max-w-xl mx-auto px-4 sm:px-6 py-24 sm:py-28 md:py-52 flex flex-col justify-center text-center">
      <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 reveal">
        Meet the IT Team
      </h2>
      <p class="max-w-2xl mx-auto opacity-90 reveal text-base sm:text-lg">
        The professionals responsible for managing, securing,
        and maintaining the ITS Inventory & Support System.
      </p>
    </div>
  </header>

  <!--  TEAM SECTION -->
  <section class="max-w-7xl mx-auto px-4 py-20">

  <!-- HEAD -->
  <div class="flex justify-center mb-16">
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8 text-center w-full max-w-sm reveal">
      <img src="{{ asset('images/Torres Jr., Dionisio.png') }}"
        class="w-24 h-24 mx-auto rounded-full mb-4 bg-primary/20">

      <h3 class="font-bold  text-xl">MR. DIONISIO TORRES JR.</h3>
      <p class="text-sm text-gray-600 mt-2">
        IT LABORATORY COORDINATOR
      </p>
    </div>
  </div>
    <!-- CORE TEAM -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-12 mb-16">
    
    <div class="bg-white rounded-xl shadow-md border p-6 text-center reveal">
      <img src="{{ asset('images/BIORE FORMAL.png') }}"
        class="w-20 h-20 mx-auto rounded-full mb-4 bg-primary/10">
      <h3 class="font-bold  text-lg">MR. EMERSON M. BIORE </h3>
      <p class="text-sm text-gray-600 mt-2">
        IT TECHNICAL SUPPORT SPECIALIST MV CAMPUS
      </p>
    </div>

    <div class="bg-white rounded-xl shadow-md border p-6 text-center reveal">
      <img src="{{ asset('images/Maladiona,April Joy.png') }}"
        class="w-20 h-20 mx-auto rounded-full mb-4 bg-primary/10">
      <h3 class="font-bold  text-lg">MS. APRIL T. MALADIONA</h3>
      <p class="text-sm text-gray-600 mt-2">
        IT TECHNICAL SUPPORT SPECIALIST ANNEX CAMPUS
      </p>
    </div>

    <div class="bg-white rounded-xl shadow-md border p-6 text-center reveal">
      <img src="{{ asset('images/HERNANDEZ, DON RAYMOND - IMG_5656.png') }}"
        class="w-20 h-20 mx-auto rounded-full mb-4 bg-primary/10">
      <h3 class="font-bold  text-lg">MR. DON RAYMOND HERNANDEZ</h3>
      <p class="text-sm text-gray-600 mt-2">
        IT TECHNICAL SUPPORT SPECIALIST BULACAN CAMPUS
      </p>
    </div>
    
    <div class="bg-white rounded-xl shadow-md border p-6 text-center reveal">
      <img src="{{ asset('images/190045.png') }}"
        class="w-20 h-20 mx-auto rounded-full mb-4 bg-primary/10">
      <h3 class="font-bold  text-lg">MR. ROMEO E. LIBO-ON lll</h3>
      <p class="text-sm text-gray-600 mt-2">
        IT TECHNICAL SUPPORT SPECIALIST MV CAMPUS
      </p>
  </div>

  <div class="bg-white rounded-xl shadow-md border p-6 text-center reveal">
      <img src="{{ asset('images/christiannoora.png') }}"
        class="w-20 h-20 mx-auto rounded-full mb-4 bg-primary/10">
      <h3 class="font-bold text-lg">MR. CHRISTIAN JAY A. NOORA</h3>
      <p class="text-sm text-gray-600 mt-2">
        IT TECHNICAL SUPPORT SPECIALIST MAIN CAMPUS
      </p>
    </div>

    <div class="bg-white rounded-xl shadow-md border p-6 text-center reveal">
      <img src="{{ asset('images/camo.png') }}"
        class="w-20 h-20 mx-auto rounded-full mb-4 bg-primary/10">
      <h3 class="font-bold text-lg ">MR. JOBERT H. CAMO</h3>
      <p class="text-sm text-gray-600 mt-2">
        IT TECHNICAL SUPPORT SPECIALIST MAIN CAMPUS
      </p>
    </div>
  </section>

     

  <!--  FOOTER -->
  <footer class="bg-gray-900 text-gray-400 text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-5 sm:py-6 text-center">
      © 2026 ITS Department — Inventory & Support Management System
    </div>
  </footer>

  <!-- Mobile slide-out navigation trigger -->
  <button
    id="mobile-nav-toggle"
    class="fixed bottom-4 right-4 z-50 md:hidden w-11 h-11 rounded-full bg-primary text-white flex items-center justify-center shadow-lg hover:bg-primaryDark transition-colors"
    aria-label="Open navigation"
  >
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
  </button>

  <!-- Mobile slide-out navigation panel -->
  <div id="mobile-nav-backdrop" class="fixed inset-0 bg-black/40 z-40 md:hidden hidden"></div>
  <div
    id="mobile-nav-panel"
    class="fixed inset-y-0 right-0 w-56 bg-white shadow-2xl z-50 md:hidden transform translate-x-full transition-transform duration-300 flex flex-col"
  >
    <div class="px-5 py-4 border-b border-gray-200 flex items-center justify-between">
      <span class="text-sm font-semibold text-gray-900">Navigation</span>
      <button
        id="mobile-nav-close"
        class="w-8 h-8 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-100"
        aria-label="Close navigation"
      >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <nav class="flex-1 px-4 py-4 space-y-2 text-sm">
      <a href="/" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Home</a>
      <a href="/about" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">About</a>
      <a href="/team" class="block px-3 py-2 rounded-lg text-gray-900 bg-gray-100 font-semibold">Team</a>
    </nav>
  </div>

  <!--  SCROLL REVEAL SCRIPT -->
  <script>
    const observer = new IntersectionObserver(
      entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add("active");
          } else {
            entry.target.classList.remove("active");
          }
        });
      },
      { threshold: 0.15 }
    );

    document.querySelectorAll(".reveal").forEach(el => observer.observe(el));

  </script>

  <!-- Mobile slide-out navigation -->
  <script>
    const teamMobileToggle = document.getElementById('mobile-nav-toggle');
    const teamMobileClose = document.getElementById('mobile-nav-close');
    const teamMobilePanel = document.getElementById('mobile-nav-panel');
    const teamMobileBackdrop = document.getElementById('mobile-nav-backdrop');

    function openTeamMobileNav() {
      teamMobilePanel.classList.remove('translate-x-full');
      teamMobileBackdrop.classList.remove('hidden');
    }

    function closeTeamMobileNav() {
      teamMobilePanel.classList.add('translate-x-full');
      teamMobileBackdrop.classList.add('hidden');
    }

    teamMobileToggle?.addEventListener('click', openTeamMobileNav);
    teamMobileClose?.addEventListener('click', closeTeamMobileNav);
    teamMobileBackdrop?.addEventListener('click', closeTeamMobileNav);

    teamMobilePanel
      ?.querySelectorAll('a')
      .forEach((link) => link.addEventListener('click', closeTeamMobileNav));
  </script>
  <script>
    const navbar = document.getElementById('navbar')

    window.addEventListener('scroll', () => {
      if (window.scrollY > 80) {
        // SCROLL DOWN → your scrolled design (example only)
        navbar.classList.add(
          'bg-white',
          'shadow-md',
          'text-gray-800'
        )
        navbar.classList.remove('text-white')
      } else {
        // SCROLL UP → RESET SA ORIGINAL DESIGN
        navbar.className =
          'fixed top-0 w-full z-50 transition-all duration-300 text-white'
      }
    })
  </script>

</body>

</html>