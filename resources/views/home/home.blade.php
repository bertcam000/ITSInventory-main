<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ITS Inventory & Support Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="/img/itslogo.png" />
    @vite('resources/css/app.css')
    <script>
      tailwind.config = {
        theme: {
          extend: { colors: { primary: "#10b981", primaryDark: "#059669" } },
        },
      };
    </script>
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
      a.reveal {
        display: inline-block;
      }
      .hero-section {
        position: relative;
        overflow: hidden;
        background: linear-gradient(
          135deg,
          #001a4d 0%,
          #0052cc 20%,
          #059669 45%,
          #10b981 60%,
          #4c0099 85%,
          #001a4d 100%
        );
      }
      .hero-section::before {
        content: "";
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(
          circle,
          rgba(255, 255, 255, 0.08) 1px,
          transparent 1px
        );
        background-size: 50px 50px;
        animation: float-pattern 30s linear infinite;
      }
      .hero-section::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
          linear-gradient(
            90deg,
            transparent 0%,
            rgba(255, 255, 255, 0.03) 50%,
            transparent 100%
          ),
          linear-gradient(
            45deg,
            transparent 30%,
            rgba(255, 255, 255, 0.05) 50%,
            transparent 70%
          );
        animation: shimmer 8s ease-in-out infinite;
      }
      @keyframes float-pattern {
        0% {
          transform: translate(0, 0) rotate(0deg);
        }
        100% {
          transform: translate(50px, 50px) rotate(360deg);
        }
      }
      @keyframes shimmer {
        0%,
        100% {
          opacity: 0.5;
        }
        50% {
          opacity: 1;
        }
      }
      .hero-content {
        position: relative;
        z-index: 20;
      }
      .hero-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 8px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
      }
      .hero-icon:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-4px);
      }
      .feature-row {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin-top: 2rem;
      }
      @media (min-width: 640px) {
        .feature-row {
          gap: 2.5rem;
          margin-top: 2.5rem;
        }
      }
      .feature-item {
        text-align: center;
        max-width: 120px;
      }
      .feature-item p {
        font-size: 0.875rem;
        opacity: 0.9;
        margin-top: 8px;
      }

      /* Navbar link underline + active state */
      .nav-link {
        position: relative;
        padding-bottom: 0.25rem;
      }
      .nav-link::after {
        content: "";
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

    <!-- Mobile slide-out navigation trigger -->
    <button
      id="mobile-nav-toggle"
      class="fixed bottom-4 right-4 z-50 md:hidden w-11 h-11 rounded-full bg-primary text-white flex items-center justify-center shadow-lg hover:bg-primaryDark transition-colors"
      aria-label="Open navigation"
    >
      <svg
        class="w-5 h-5"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M9 5l7 7-7 7"
        />
      </svg>
    </button>

    <!-- Mobile slide-out navigation panel -->
    <div
      id="mobile-nav-backdrop"
      class="fixed inset-0 bg-black/40 z-40 md:hidden hidden"
    ></div>
    <div
      id="mobile-nav-panel"
      class="fixed inset-y-0 right-0 w-56 bg-white shadow-2xl z-50 md:hidden transform translate-x-full transition-transform duration-300 flex flex-col"
    >
      <div
        class="px-5 py-4 border-b border-gray-200 flex items-center justify-between"
      >
        <span class="text-sm font-semibold text-gray-900">Navigation</span>
        <button
          id="mobile-nav-close"
          class="w-8 h-8 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-100"
          aria-label="Close navigation"
        >
          <svg
            class="w-4 h-4"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </div>
      <nav class="flex-1 px-4 py-4 space-y-2 text-sm">
        <a
          href="/"
          class="block px-3 py-2 rounded-lg text-gray-900 bg-gray-100 font-semibold"
        >
          Home
        </a>
        <a
          href="/about"
          class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100"
        >
          About
        </a>
        <a
          href="/team"
          class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100"
        >
          Team
        </a>
      </nav>
    </div>

    <!--  HERO SECTION -->
    <section class="relative hero-section text-white">
      <div
        class="max-w-xl mx-auto px-4 sm:px-6 py-24 sm:py-28 md:py-32 flex flex-col justify-center text-center hero-content"
      >
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 reveal">
          ITS Inventory & Support Management System
        </h2>
        <p class="text-base sm:text-lg opacity-90 max-w-2xl mx-auto reveal">
          An internal system designed exclusively for the IT Department to
          manage assets, tickets, and IT operations efficiently.
        </p>
        <!-- Feature Icons -->
        <div class="feature-row reveal">
          <div class="feature-item">
            <div class="hero-icon">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.429 5.951 1.429a1 1 0 001.169-1.409l-7-14z"
                />
              </svg>
            </div>
            <p>Asset Management</p>
          </div>

          <div class="feature-item">
            <div class="hero-icon">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"
                />
              </svg>
            </div>
            <p>Ticketing System</p>
          </div>

          <div class="feature-item">
            <div class="hero-icon">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path
                  fill-rule="evenodd"
                  d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                  clip-rule="evenodd"
                />
              </svg>
            </div>
            <p>Secure Access</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Mission and Vision -->
    <section class="bg-white border-t border-b">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16 reveal">
        <h3 class="text-2xl font-semibold mb-10 text-center">
          Bestlink College of the Philippines Vision and Mission
        </h3>

        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <!-- VISION -->
          <div
            class="bg-white p-5 sm:p-6 rounded-xl shadow-md border border-gray-100 text-center hover:border-primary/30 hover:shadow-lg transition-all"
          >
            <h4 class="font-semibold mb-2 text-gray-900">Vision</h4>
            <p class="text-gray-600 mt-6">
              Bestlink College of the Philippines is committed to provide and
              promote quality education with a unique, modern and research-based
              curriculum with delivery system geared towards excellence.
            </p>
          </div>
          <!-- MISSION -->
          <div
            class="bg-white p-5 sm:p-6 rounded-xl shadow-md border border-gray-100 text-center hover:border-primary/30 hover:shadow-lg transition-all"
          >
            <h4 class="font-semibold mb-2 text-gray-900">Mission</h4>
            <p class="text-gray-600 mt-6">
              To produce self-motivated and self-directed individuals who aim
              for academic excellence, God-fearing, peaceful, healthy,
              productive and successful citizens.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!--  SYSTEM HIGHLIGHTS -->
    <section
      class="max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-20 md:py-24 reveal"
    >
      <h3
        class="text-xl sm:text-2xl font-semibold text-center mb-10 sm:mb-12 text-gray-900"
      >
        System Capabilities
      </h3>
      <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
        <div
          class="bg-white p-5 sm:p-6 rounded-xl shadow-md border border-gray-100 text-center hover:border-primary/30 hover:shadow-lg transition-all"
        >
          <h4 class="font-semibold mb-2 text-gray-900">Asset Management</h4>
          <p class="text-sm text-gray-600">
            Track and manage IT assets across departments.
          </p>
        </div>
        <div
          class="bg-white p-5 sm:p-6 rounded-xl shadow-md border border-gray-100 text-center hover:border-primary/30 hover:shadow-lg transition-all"
        >
          <h4 class="font-semibold mb-2 text-gray-900">Ticketing System</h4>
          <p class="text-sm text-gray-600">
            Centralized IT support and issue tracking.
          </p>
        </div>
        <div
          class="bg-white p-5 sm:p-6 rounded-xl shadow-md border border-gray-100 text-center hover:border-primary/30 hover:shadow-lg transition-all"
        >
          <h4 class="font-semibold mb-2 text-gray-900">Maintenance Records</h4>
          <p class="text-sm text-gray-600">
            Monitor repairs, warranties, and asset health.
          </p>
        </div>
        <div
          class="bg-white p-5 sm:p-6 rounded-xl shadow-md border border-gray-100 text-center hover:border-primary/30 hover:shadow-lg transition-all"
        >
          <h4 class="font-semibold mb-2 text-gray-900">Reports & Logs</h4>
          <p class="text-sm text-gray-600">
            Generate reports and track system activity.
          </p>
        </div>
      </div>
    </section>

    <!--  ACCESS SCOPE -->
    <section class="bg-white border-t border-b">
      <div
        class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16 text-center reveal"
      >
        <h3 class="text-2xl font-semibold mb-4">Restricted System Access</h3>
        <p class="max-w-2xl mx-auto text-gray-600">
          This system is strictly for IT Department use only. All data input,
          asset control, and ticket handling are managed exclusively by
          authorized IT personnel.
        </p>
      </div>
    </section>

    <!--  TRUST / PREVIEW SECTION -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-20">
      <div class="grid sm:grid-cols-3 gap-8 text-center">
        <div>
          <h4 class="text-2xl sm:text-3xl font-bold text-primary">100+</h4>
          <p class="text-sm text-gray-600">Assets Managed</p>
        </div>
        <div>
          <h4 class="text-2xl sm:text-3xl font-bold text-primary">Fast</h4>
          <p class="text-sm text-gray-600">IT Support Workflow</p>
        </div>
        <div>
          <h4 class="text-2xl sm:text-3xl font-bold text-primary">Secure</h4>
          <p class="text-sm text-gray-600">Role-Based Access</p>
        </div>
      </div>
    </section>

    <!-- CALL TO ACTION -->
    <section class="bg-gradient-to-r from-primary to-primaryDark text-white">
      <div
        class="max-w-7xl mx-auto px-4 sm:px-6 py-14 sm:py-16 text-center reveal"
      >
        <h3 class="text-xl sm:text-2xl font-semibold mb-4">
          Authorized IT Personnel Only
        </h3>
        <p class="mb-6 opacity-90 max-w-xl mx-auto">
          Log in to access the operational system dashboard.
        </p>
        <a
          href="/login"
          class="inline-block bg-white text-primary font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 shadow-lg hover:shadow-xl transition-all"
        >
          Login to System
        </a>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-400 text-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 py-5 sm:py-6 text-center">
        © 2026 ITS Department — Inventory & Support Management System
      </div>
    </footer>

    <script>
      // Mobile slide-out navigation
      const mobileToggle = document.getElementById("mobile-nav-toggle");
      const mobileClose = document.getElementById("mobile-nav-close");
      const mobilePanel = document.getElementById("mobile-nav-panel");
      const mobileBackdrop = document.getElementById("mobile-nav-backdrop");

      function openMobileNav() {
        mobilePanel.classList.remove("translate-x-full");
        mobileBackdrop.classList.remove("hidden");
      }

      function closeMobileNav() {
        mobilePanel.classList.add("translate-x-full");
        mobileBackdrop.classList.add("hidden");
      }

      mobileToggle?.addEventListener("click", openMobileNav);
      mobileClose?.addEventListener("click", closeMobileNav);
      mobileBackdrop?.addEventListener("click", closeMobileNav);

      mobilePanel
        ?.querySelectorAll("a")
        .forEach((link) => link.addEventListener("click", closeMobileNav));
    </script>

    <!-- Reveal script (match Team page) -->
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
    <script>
      const navbar = document.getElementById("navbar");

      window.addEventListener("scroll", () => {
        if (window.scrollY > 80) {
          // SCROLL DOWN → your scrolled design (example only)
          navbar.classList.add("bg-white", "shadow-md", "text-gray-800");
          navbar.classList.remove("text-white");
        } else {
          // SCROLL UP → RESET SA ORIGINAL DESIGN
          navbar.className =
            "fixed top-0 w-full z-50 transition-all duration-300 text-white";
        }
      });
    </script>
  </body>
</html>
