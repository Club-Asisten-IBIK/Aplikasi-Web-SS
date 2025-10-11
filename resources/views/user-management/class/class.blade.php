<div class="bg-white rounded-2xl border border-[#E7EAF0] shadow-[0_1px_0_rgba(16,24,40,0.04)]">
  <div class="flex items-center justify-between p-5 border-b border-[#ECEFF3]">
    <h3 class="text-[16px] font-semibold flex items-center gap-2 text-[#0F172A]">
      <i data-lucide="school" class="w-5 h-5"></i> Class Management
    </h3>
    <button class="inline-flex items-center gap-2 rounded-lg bg-[#111827] text-white px-3.5 py-2 shadow-[0_1px_0_rgba(16,24,40,0.12)] hover:bg-black/90">
      <i data-lucide="plus" class="w-4 h-4"></i> Add Class
    </button>
  </div>

  <div class="p-5 overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="text-left text-[#6B7280] border-b border-[#ECEFF3]">
        <tr>
          <th class="py-3 pr-4">Class ID</th>
          <th class="py-3 pr-4">Class Name</th>
          <th class="py-3 pr-4">Level/Grade</th>
          <th class="py-3 pr-4">Homeroom Teacher</th>
          <th class="py-3 pr-4">Capacity</th>
          <th class="py-3 pr-4">Enrolled</th>
          <th class="py-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($classes as $c)
          <tr class="border-b border-[#ECEFF3] last:border-0 hover:bg-black/[0.02]">
            <td class="py-3 pr-4 font-medium">{{ $c['id'] }}</td>
            <td class="py-3 pr-4">{{ $c['name'] }}</td>
            <td class="py-3 pr-4">{{ $c['level'] }}</td>
            <td class="py-3 pr-4">{{ $c['teacher'] }}</td>
            <td class="py-3 pr-4">{{ $c['capacity'] }}</td>
            <td class="py-3 pr-4">
              <span class="{{ $c['enrolled'] >= $c['capacity']*0.9 ? 'text-red-600' : 'text-green-600' }}">
                {{ $c['enrolled'] }}/{{ $c['capacity'] }}
              </span>
            </td>
            <td class="py-3">
              <div class="flex gap-2">
                <button class="border rounded-lg h-8 px-3 bg-white hover:bg-black/[0.03]">Edit</button>
                <button class="border rounded-lg h-8 px-3 bg-white hover:bg-black/[0.03]">View</button>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
