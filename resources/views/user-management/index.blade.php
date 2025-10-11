@extends('layouts.index')
@section('title','User Management')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    if (window.lucide?.createIcons) lucide.createIcons({ attrs: { 'stroke-width': 1.8 }});
  });
</script>

<div x-data="{ tab: 'students', addOpen: false }" class="space-y-6">
  <h1 class="text-[22px] font-semibold tracking-tight text-[#0F172A]">School Management System</h1>

  {{-- Tabs bar --}}
  <div class="rounded-2xl ">
    <div class="w-full rounded-full bg-[#ECEFF3] p-1 grid grid-cols-5">
      <button @click="tab='students'"   :data-active="tab==='students'"   class="rounded-full px-5 py-2 text-[14px] font-medium text-[#6B7280] data-[active=true]:bg-white data-[active=true]:text-[#111827] data-[active=true]:shadow-sm transition">Students</button>
      <button @click="tab='classes'"    :data-active="tab==='classes'"    class="rounded-full px-5 py-2 text-[14px] font-medium text-[#6B7280] data-[active=true]:bg-white data-[active=true]:text-[#111827] data-[active=true]:shadow-sm transition">Classes</button>
      <button @click="tab='staff'"      :data-active="tab==='staff'"      class="rounded-full px-5 py-2 text-[14px] font-medium text-[#6B7280] data-[active=true]:bg-white data-[active=true]:text-[#111827] data-[active=true]:shadow-sm transition">Staff</button>
      <button @click="tab='academic'"   :data-active="tab==='academic'"   class="rounded-full px-5 py-2 text-[14px] font-medium text-[#6B7280] data-[active=true]:bg-white data-[active=true]:text-[#111827] data-[active=true]:shadow-sm transition">Academic</button>
      <button @click="tab='attendance'" :data-active="tab==='attendance'" class="rounded-full px-5 py-2 text-[14px] font-medium text-[#6B7280] data-[active=true]:bg-white data-[active=true]:text-[#111827] data-[active=true]:shadow-sm transition">Attendance</button>
    </div>
  </div>

  {{-- sections --}}
  <div x-show="tab==='students'"    x-cloak>
    @include('user-management.students.students', ['students' => $students])
  </div>

  <div x-show="tab==='classes'"     x-cloak>
    @include('user-management.class.class', ['classes' => $classes])
  </div>

  <div x-show="tab==='staff'"       x-cloak>
    @include('user-management.staff.staff', ['staff' => $staff])
  </div>

  <div x-show="tab==='academic'"    x-cloak>
    @include('user-management.academic.academic', ['subjects' => $subjects])
  </div>

  <div x-show="tab==='attendance'"  x-cloak>
    @include('user-management.attendance.attendance', [
      'students' => $students,
      'attendanceData' => $attendanceData
    ])
  </div>
</div>
@endsection
