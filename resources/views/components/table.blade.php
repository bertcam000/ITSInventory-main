<div class="bg-white rounded-xl shadow p-6">

  <!-- Search & Filters -->
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">

    <!-- Search -->
    <div class="relative w-full md:w-1/3">
      <input
        type="text"
        placeholder="Search items..."
        class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
      />
      <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
    </div>

    <!-- Filters -->
    <div class="flex gap-3">
      <select class="border rounded-lg px-4 py-2 focus:ring">
        <option value="">All Categories</option>
        <option>Electronics</option>
        <option>Furniture</option>
        <option>Office Supplies</option>
      </select>

      <select class="border rounded-lg px-4 py-2 focus:ring">
        <option value="">Status</option>
        <option>Available</option>
        <option>Borrowed</option>
        <option>Damaged</option>
      </select>
    </div>
  </div>

  <!-- Table Wrapper (Responsive) -->
  <div class="overflow-x-auto">
    <table class="min-w-full text-sm text-left border-collapse">

      <thead>
        <tr class="bg-gray-100 text-gray-700 uppercase text-xs">
          <th class="px-6 py-3">Item</th>
          <th class="px-6 py-3">Category</th>
          <th class="px-6 py-3">Serial No</th>
          <th class="px-6 py-3">Status</th>
          <th class="px-6 py-3">Action</th>
        </tr>
      </thead>

      <tbody class="divide-y">
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 font-medium">Dell Laptop</td>
          <td class="px-6 py-4">Electronics</td>
          <td class="px-6 py-4">DL-2024-001</td>
          <td class="px-6 py-4">
            <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">Available</span>
          </td>
          <td class="px-6 py-4">
            <button class="text-blue-600 hover:underline">View</button>
          </td>
        </tr>

        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 font-medium">Office Chair</td>
          <td class="px-6 py-4">Furniture</td>
          <td class="px-6 py-4">OF-8892</td>
          <td class="px-6 py-4">
            <span class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">Borrowed</span>
          </td>
          <td class="px-6 py-4">
            <button class="text-blue-600 hover:underline">View</button>
          </td>
        </tr>
      </tbody>

    </table>
  </div>

  <!-- Pagination (optional) -->
  <div class="flex justify-between items-center mt-4 text-sm text-gray-600">
    <span>Showing 1–10 of 50</span>
    <div class="flex gap-2">
      <button class="px-3 py-1 border rounded hover:bg-gray-100">Prev</button>
      <button class="px-3 py-1 border rounded hover:bg-gray-100">Next</button>
    </div>
  </div>

</div>
