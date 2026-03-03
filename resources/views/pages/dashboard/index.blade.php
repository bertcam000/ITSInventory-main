<x-layouts.its_layout>
    <section x-show="active==='dashboard'" class="space-y-6">
        <!-- Page Title -->
        <div>
          <h1 class="text-2xl md:text-3xl font-bold text-gray-900 capitalize">Dashboard</h1>
        </div>

        <!-- Search and Filter Bar -->
        <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-200">
          <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
              <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input 
                  type="text" 
                  x-model="searchQuery"
                  placeholder="Search assets, tickets, users..." 
                  class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                />
              </div>
            </div>
            <div class="flex flex-wrap gap-2">
              <select x-model="selectedCampus" class="border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent min-w-0 flex-1 sm:flex-initial sm:min-w-[140px]">
                <option value="all">All Campuses</option>
                <option value="main">Main Campus</option>
                <option value="annex">Annex Campus</option>
                <option value="mv">MV Campus</option>
                <option value="heavenly">Heavenly Campus</option>
                <option value="criminology">Criminology Campus</option>
                <option value="bulacan">Bulacan Campus</option>
              </select>
              <select x-model="selectedDepartment" class="border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent min-w-0 flex-1 sm:flex-initial sm:min-w-[140px]">
                <option value="all">All Departments</option>
                <option value="its">ITS</option>
                <option value="account">Account</option>
                <option value="cashier">Cashier</option>
                <option value="registrar">Registrar</option>
                <option value="btac">BTAC</option>
                <option value="bookstore">Bookstore</option>
                <option value="it">IT Department</option>
                <option value="admin">Administration</option>
                <option value="academic">Academic</option>
                <option value="finance">Finance</option>
              </select>
              <select x-model="selectedStatus" class="border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent min-w-0 flex-1 sm:flex-initial sm:min-w-[120px]">
                <option value="all">All Status</option>
                <option value="active">Active</option>
                <option value="maintenance">Maintenance</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
          </div>
        </div>

        <!-- KPI Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
          <div class="stat-card bg-white rounded-xl shadow-sm hover:shadow-md transition-all p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-3">
              <h3 class="text-sm font-medium text-gray-600">Total Assets</h3>
              <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
              </div>
            </div>
            <div class="flex items-baseline gap-2">
              <p class="text-3xl font-bold text-gray-900">{{ $totalAssets }}</p>
              <div class="flex items-center text-green-600 text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                <span>2.5%</span>
              </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">All registered assets</p>
          </div>

          <div class="stat-card bg-white rounded-xl shadow-sm hover:shadow-md transition-all p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-3">
              <h3 class="text-sm font-medium text-gray-600">Active Devices</h3>
              <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
            </div>
            <div class="flex items-baseline gap-2">
              <p class="text-3xl font-bold text-gray-900">{{ $activeDevices }}</p>
              <div class="flex items-center text-green-600 text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                <span>0.5%</span>
              </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">Currently operational</p>
          </div>

          <div class="stat-card bg-white rounded-xl shadow-sm hover:shadow-md transition-all p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-3">
              <h3 class="text-sm font-medium text-gray-600">Under Maintenance</h3>
              <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
            </div>
            <div class="flex items-baseline gap-2">
              <p class="text-3xl font-bold text-gray-900">{{ $underMaintenance }}</p>
              <div class="flex items-center text-red-600 text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
                <span>0.2%</span>
              </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">Requiring attention</p>
          </div>

          <div class="stat-card bg-white rounded-xl shadow-sm hover:shadow-md transition-all p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-3">
              <h3 class="text-sm font-medium text-gray-600">Open Tickets</h3>
              <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
              </div>
            </div>
            <div class="flex items-baseline gap-2">
              <p class="text-3xl font-bold text-gray-900">{{ $openTickets }}</p>
              <div class="flex items-center text-green-600 text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                <span>0.12%</span>
              </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">Pending resolution</p>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Assets by Campus</h3>
            <div class="space-y-4">
              
              
              @foreach ($assetsByCampus as $index => $campus)
                @php
                    $colors = [
                        'bg-primary',
                        'bg-blue-500',
                        'bg-purple-500',
                        'bg-indigo-500',
                        'bg-pink-500',
                        'bg-yellow-500',
                    ];

                    $color = $colors[$index % count($colors)];

                    $width = $maxCampusTotal > 0
                        ? ($campus->total / $maxCampusTotal) * 100
                        : 0;
                @endphp

                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">
                        {{ $campus->campus_name }}
                    </span>
                    <span class="text-sm font-semibold text-gray-900">
                        {{ $campus->total }}
                    </span>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div
                        class="{{ $color }} h-2 rounded-full transition-all"
                        style="width: {{ $campus->total }}%">
                    </div>
                </div>
              @endforeach
            </div>
          </div>

          <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Assets by Department</h3>
            <div class="space-y-4">
              
              @foreach ($assetsByDepartment as $index => $department)
                  @php
                      $colors = [
                          'bg-green-500',
                          'bg-blue-500',
                          'bg-purple-500',
                          'bg-orange-500',
                          'bg-red-500',
                      ];
                      $color = $colors[$index % count($colors)];
                  @endphp

                  <div class="flex items-center justify-between">
                      <span class="text-sm text-gray-700">
                          {{ $department['name'] }}
                      </span>
                      <span class="text-sm font-semibold">
                          {{ $department['percentage'] }}%
                      </span>
                  </div>

                  <div class="w-full bg-gray-200 rounded-full h-2">
                      <div class="{{ $color }} h-2 rounded-full"
                            style="width: {{ $department['percentage'] }}%">
                      </div>
                  </div>
              @endforeach
              
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
          <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-sm">
              <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Asset</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Campus</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Department</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Last Updated</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr class="hover:bg-gray-50 transition-colors">
                  <td class="px-6 py-4 font-medium text-gray-900">Dell Laptop - IT-001</td>
                  <td class="px-6 py-4 text-gray-600">Main Campus</td>
                  <td class="px-6 py-4 text-gray-600">IT Department</td>
                  <td class="px-6 py-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                  </td>
                  <td class="px-6 py-4 text-gray-600">2 hours ago</td>
                </tr>
                <tr class="hover:bg-gray-50 transition-colors">
                  <td class="px-6 py-4 font-medium text-gray-900">HP Printer - PR-045</td>
                  <td class="px-6 py-4 text-gray-600">Annex Campus</td>
                  <td class="px-6 py-4 text-gray-600">Administration</td>
                  <td class="px-6 py-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Maintenance</span>
                  </td>
                  <td class="px-6 py-4 text-gray-600">5 hours ago</td>
                </tr>
                <tr class="hover:bg-gray-50 transition-colors">
                  <td class="px-6 py-4 font-medium text-gray-900">Desktop PC - PC-128</td>
                  <td class="px-6 py-4 text-gray-600">MV Campus</td>
                  <td class="px-6 py-4 text-gray-600">Academic</td>
                  <td class="px-6 py-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                  </td>
                  <td class="px-6 py-4 text-gray-600">1 day ago</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </section>
</x-layouts.its_layout>