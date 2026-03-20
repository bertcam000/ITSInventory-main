<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>About | ITS Inventory System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>tailwind.config = { theme: { extend: { colors: { primary: '#10b981', primaryDark: '#059669' } } } }</script>
  <link rel="icon" type="image/png" href="/img/its_logo.png">
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

    .about-hero {
      background: linear-gradient(135deg, #001a4d 0%, #0052cc 20%, #059669 45%, #10b981 60%, #4c0099 85%, #001a4d 100%);
      position: relative;
      overflow: hidden;
    }

    .about-hero::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.06) 1px, transparent 1px);
      background-size: 40px 40px;
      animation: float-abt 25s linear infinite;
    }

    @keyframes float-abt {
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

  <!--  PAGE HEADER (galaxy + green) -->
  <header class="about-hero text-white relative">
    <div class="max-w-xl mx-auto px-4 sm:px-6 py-24 sm:py-28 md:py-52 flex flex-col justify-center text-center">
      <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 reveal">About the System</h2>
      <p class="max-w-2xl mx-auto opacity-90 reveal text-base sm:text-lg">
        Learn more about the purpose, scope, and capabilities of the IT
        Inventory & Support Management System.
      </p>
    </div>
  </header>

  <!-- Mission and Vision -->
    <section class="bg-white border-t border-b">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16 reveal">
        <h3 class="text-2xl font-semibold mb-10 text-center">
         ITS Vision and Mission
        </h3>

        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <!-- VISION -->
          <div
            class="bg-white p-5 sm:p-6 rounded-xl shadow-md border border-gray-100 text-center hover:border-primary/30 hover:shadow-lg transition-all"
          >
            <h4 class="font-semibold mb-2 text-gray-900">Vision</h4>
            <p class="text-gray-600 mt-6">
              Bestlink Information and Technology Services will strive to
              provide reliable, flexible technology services; readily available
              information and computing resources; innovative solutions;
              state-of-the-art infrastructure; and exceptional support to
              faculty, staff, and students, all in line with the Bestlink
              mission and vision.
            </p>
          </div>
          <!-- MISSION -->
          <div
            class="bg-white p-5 sm:p-6 rounded-xl shadow-md border border-gray-100 text-center hover:border-primary/30 hover:shadow-lg transition-all"
          >
            <h4 class="font-semibold mb-2 text-gray-900">Mission</h4>
            <p class="text-gray-600 mt-6">
              To deliver the highest level of services to faculty, staff, and
              students with ubiquitous access to information technology
              services, creative solutions, responsive services, and ensure that
              the system, applications, and processes are implemented and
              operated efficiently and effectively.
            </p>
          </div>
        </div>
      </div>
    </section>

  <!--  SYSTEM PURPOSE -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-20 reveal">
    <div class="grid md:grid-cols-2 gap-10 sm:gap-12 items-center">
      <div>
        <h3 class="text-2xl font-semibold mb-4">System Purpose</h3>
        <p class="text-gray-600 leading-relaxed">
          The IT Inventory & Support Management System is designed to help the
          IT Department efficiently manage hardware assets, software licenses,
          and technical support requests within the organization.
        </p>
      </div>
      <div class="bg-white rounded-xl shadow p-6">
        <ul class="space-y-4 text-sm">
          <li>✔ Centralized asset tracking</li>
          <li>✔ Streamlined IT support workflow</li>
          <li>✔ Organized maintenance records</li>
          <li>✔ Accurate reporting and logs</li>
        </ul>
      </div>
    </div>
  </section>

  <!--  SYSTEM SCOPE -->
  <section class="bg-white border-t">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-20 reveal">
      <h3 class="text-xl sm:text-2xl font-semibold text-center mb-10 sm:mb-12 reveal text-gray-900">
        System Scope & Access
      </h3>
      <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
        <div class="p-6 rounded-xl border border-gray-200 text-center hover:border-primary/30 transition-colors">
          <h4 class="font-semibold mb-2 text-gray-900">Exclusive Access</h4>
          <p class="text-sm text-gray-600">
            Only authorized IT Department personnel can access and manage the
            system.
          </p>
        </div>

        <div class="p-6 rounded-xl border border-gray-200 text-center hover:border-primary/30 transition-colors">
          <h4 class="font-semibold mb-2 text-gray-900">Internal Operations</h4>
          <p class="text-sm text-gray-600">
            The system is intended solely for internal IT operations and
            support management.
          </p>
        </div>

        <div class="p-6 rounded-xl border border-gray-200 text-center hover:border-primary/30 transition-colors">
          <h4 class="font-semibold mb-2 text-gray-900">Secure Environment</h4>
          <p class="text-sm text-gray-600">
            Role-based access ensures data security and accountability.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!--  LIMITATIONS -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-20">
    <h3 class="text-xl sm:text-2xl font-semibold text-center mb-10 sm:mb-12 text-gray-900">
      System Limitations
    </h3>
    <div class="grid md:grid-cols-2 gap-8 sm:gap-10">
      <div class="bg-white p-6 rounded-xl shadow">
        <h4 class="font-semibold mb-3">Not for General Employees</h4>
        <p class="text-sm text-gray-600">
          General employees do not have direct access to this system and
          cannot view or modify IT records.
        </p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow">
        <h4 class="font-semibold mb-3">IT-Controlled Data</h4>
        <p class="text-sm text-gray-600">
          All asset records, ticket handling, and approvals are managed solely
          by the ITS Department.
        </p>
      </div>
    </div>
  </section>

  <!--  CTA -->
  <section class="bg-gradient-to-r from-primary to-primaryDark text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-14 sm:py-16 text-center">
      <h3 class="text-xl sm:text-2xl font-semibold mb-4">
        For Authorized ITS Personnel Only
      </h3>
      <p class="opacity-90 mb-6 max-w-xl mx-auto">
        Log in to access the system dashboard and operational tools.
      </p>
      <a href="/login"
        class="inline-block bg-white text-primary font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 shadow-lg hover:shadow-xl transition-all">
        Proceed to Login
      </a>
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
      <a href="/about" class="block px-3 py-2 rounded-lg text-gray-900 bg-gray-100 font-semibold">About</a>
      <a href="/team" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Team</a>
    </nav>
  </div>

  <!-- Reveal script -->
  <script>
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("active");
          } else {
            entry.target.classList.remove("active");
          }
        });
      },
      { threshold: 0.15 },
    );

    document
      .querySelectorAll(".reveal")
      .forEach((el) => observer.observe(el));
  </script>

  <!-- Mobile slide-out navigation -->
  <script>
    const abtMobileToggle = document.getElementById('mobile-nav-toggle');
    const abtMobileClose = document.getElementById('mobile-nav-close');
    const abtMobilePanel = document.getElementById('mobile-nav-panel');
    const abtMobileBackdrop = document.getElementById('mobile-nav-backdrop');

    function openAbtMobileNav() {
      abtMobilePanel.classList.remove('translate-x-full');
      abtMobileBackdrop.classList.remove('hidden');
    }

    function closeAbtMobileNav() {
      abtMobilePanel.classList.add('translate-x-full');
      abtMobileBackdrop.classList.add('hidden');
    }

    abtMobileToggle?.addEventListener('click', openAbtMobileNav);
    abtMobileClose?.addEventListener('click', closeAbtMobileNav);
    abtMobileBackdrop?.addEventListener('click', closeAbtMobileNav);

    abtMobilePanel
      ?.querySelectorAll('a')
      .forEach((link) => link.addEventListener('click', closeAbtMobileNav));
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