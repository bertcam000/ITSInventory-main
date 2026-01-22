<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Layout</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- Top Navbar -->
<nav class="fixed top-0 left-0 right-0 h-16 bg-white shadow flex items-center justify-between px-6 z-50">
  <button id="menuBtn" class="lg:hidden text-gray-700">
    ☰
  </button>

  <h1 class="text-lg font-semibold text-gray-700">ITS Inventory System</h1>

  <div class="flex items-center gap-4">
    <span class="text-sm text-gray-600">Admin</span>
    <img src="https://i.pravatar.cc/40" class="w-9 h-9 rounded-full" alt="">
  </div>
</nav>

<!-- Sidebar -->
<aside id="sidebar" class="fixed top-16 left-0 w-64 h-full bg-slate-900 text-white transform -translate-x-full lg:translate-x-0 transition duration-300 z-40">
  <div class="p-6 text-xl font-bold border-b border-slate-700">
    Dashboard
  </div>

  <nav class="mt-4 space-y-1">
    <a href="#" class="flex items-center gap-3 px-6 py-3 hover:bg-slate-700">
      📊 <span>Dashboard</span>
    </a>

    <a href="#" class="flex items-center gap-3 px-6 py-3 hover:bg-slate-700">
      📦 <span>Inventory</span>
    </a>

    <a href="#" class="flex items-center gap-3 px-6 py-3 hover:bg-slate-700">
      🔍 <span>QR Scanner</span>
    </a>

    <a href="#" class="flex items-center gap-3 px-6 py-3 hover:bg-slate-700">
      👥 <span>Users</span>
    </a>

    <a href="#" class="flex items-center gap-3 px-6 py-3 hover:bg-slate-700">
      ⚙️ <span>Settings</span>
    </a>
  </nav>
</aside>

<!-- Overlay for mobile -->
<div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>

<!-- Main content -->
<main class="pt-20 lg:pl-64 px-6 transition-all">
  <div class="bg-white p-6 rounded shadow">
    {{ $slot }}
  </div>
</main>

<!-- JS for toggle -->
<script>
  const menuBtn = document.getElementById('menuBtn');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');

  menuBtn.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
  });

  overlay.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
  });
</script>

</body>
</html>
