<div class="bg-white-theme rounded-2xl border border-[#E7EAF0] shadow-[0_1px_0_rgba(16,24,40,0.04)]">
  <div class="flex items-center justify-between p-5 border-b border-[#ECEFF3]">
    <h3 class="text-[16px] font-semibold flex items-center gap-2 text-[#0F172A]">
      <i data-lucide="users" class="w-5 h-5"></i> Student Management
    </h3>
    <button @click="$root.addOpen=true"
            class="inline-flex items-center gap-2 rounded-lg bg-black-theme text-white-theme px-3.5 py-2 shadow-[0_1px_0_rgba(16,24,40,0.12)] hover:bg-black-theme/90">
      <i data-lucide="plus" class="w-4 h-4"></i> Add Student
    </button>
  </div>

  <div class="p-5">
    <div class="flex flex-wrap items-center gap-4 mb-6">
      <div class="relative">
        <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-[#9CA3AF]"></i>
        <input type="text" placeholder="Search students..."
          class="h-10 rounded-full bg-[#F6F7FB] border border-transparent px-4 pl-9 focus:outline-none focus:ring-2 focus:ring-black-theme/10 w-[280px]">
      </div>
      <select class="h-10 rounded-full bg-[#F6F7FB] border border-transparent px-4 focus:outline-none focus:ring-2 focus:ring-black-theme/10 w-[220px]">
        <option>Filter by class</option><option>All Classes</option><option>Grade 9</option><option>Grade 10</option><option>Grade 11</option>
      </select>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="text-left">
          <tr>
            <th class="py-3 pr-4">Student ID</th>
            <th class="py-3 pr-4">Full Name</th>
            <th class="py-3 pr-4">Class</th>
            <th class="py-3 pr-4">Date of Birth</th>
            <th class="py-3 pr-4">Gender</th>
            <th class="py-3 pr-4">Parent/Guardian</th>
            <th class="py-3 pr-4">Contact</th>
            <th class="py-3 pr-4">Status</th>
            <th class="py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($students as $s)
            <tr class="border-b border-[#ECEFF3] last:border-0 hover:bg-black-theme/[0.02]">
              <td class="py-3 pr-4 font-medium">{{ $s['id'] }}</td>
              <td class="py-3 pr-4">{{ $s['name'] }}</td>
              <td class="py-3 pr-4">{{ $s['class'] }}</td>
              <td class="py-3 pr-4">{{ $s['dob'] }}</td>
              <td class="py-3 pr-4">{{ $s['gender'] }}</td>
              <td class="py-3 pr-4">{{ $s['parent'] }}</td>
              <td class="py-3 pr-4">{{ $s['contact'] }}</td>
              <td class="py-3 pr-4">
                @if($s['status']==='Active')
                  <span class="rounded-full px-2.5 py-0.5 text-xs bg-[#E6F7EE] text-[#0B8A4A]">Active</span>
                @else
                  <span class="rounded-full px-2.5 py-0.5 text-xs bg-[#EEF0F4] text-[#4B5563]">Inactive</span>
                @endif
              </td>
              <td class="py-3">
                <div class="flex gap-2">
                  <button class="border rounded-lg h-8 px-3 bg-white-theme hover:bg-black-theme/[0.03]">Edit</button>
                  <button class="border rounded-lg h-8 px-3 bg-white-theme hover:bg-black-theme/[0.03]">View</button>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- Modal Add Student --}}
<div x-show="$root.addOpen" x-cloak class="fixed inset-0 z-[70] flex items-center justify-center bg-black-theme/40">
  <div @click.outside="$root.addOpen=false" class="bg-white-theme rounded-2xl border border-[#E7EAF0] w-full max-w-md p-5">
    <h4 class="text-lg font-regular mb-4 text-black-theme">Add New Student</h4>
    <div class="space-y-4">
      <div><label class="block text-sm mb-2 text-dark-gray">Student ID</label><input class="border rounded-lg w-full h-10 px-3" placeholder="Enter student ID"></div>
      <div><label class="block text-sm mb-2 text-dark-gray">Full Name</label><input class="border rounded-lg w-full h-10 px-3" placeholder="Enter full name"></div>
      <div><label class="block text-sm mb-2 text-dark-gray">Date of Birth</label><input type="date" class="border rounded-lg w-full h-10 px-3"></div>
      <div><label class="block text-sm mb-2 text-dark-gray">Gender</label><select class="border rounded-lg w-full h-10 px-3"><option>Male</option><option>Female</option></select></div>
      <div><label class="block text-sm mb-2 text-dark-gray">Class</label><select class="border rounded-lg w-full h-10 px-3"><option>Grade 9-A</option><option>Grade 10-A</option><option>Grade 11-A</option></select></div>
      <div><label class="block text-sm mb-2 text-dark-gray">Parent/Guardian Name</label><input class="border rounded-lg w-full h-10 px-3" placeholder="Enter parent/guardian name"></div>
      <div><label class="block text-sm mb-2 text-dark-gray">Contact Info</label><input class="border rounded-lg w-full h-10 px-3" placeholder="Enter contact information"></div>
      <div class="flex gap-2 pt-2">
        <button class="flex-1 bg-black-theme text-white-theme h-10 rounded-lg hover:bg-black-theme/90" @click="$root.addOpen=false">Add Student</button>
        <button class="border h-10 px-4 rounded-lg" @click="$root.addOpen=false">Cancel</button>
      </div>
    </div>
  </div>
</div>
