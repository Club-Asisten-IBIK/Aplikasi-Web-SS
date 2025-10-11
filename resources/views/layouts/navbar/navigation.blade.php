{{-- TOPBAR (mobile) --}}
<div class="lg:hidden sticky top-0 z-40 flex h-12 items-center gap-2 border-b border-black/5 bg-white px-3">
  <button id="hb" type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-black/10">
    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
      <path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
  </button>
  <span class="font-semibold">@yield('title','Dashboard')</span>
</div>

{{-- SIDEBAR --}}
<aside id="sb"
  class="fixed inset-y-0 left-0 z-50 flex w-[72px] -translate-x-full flex-col items-center
         bg-gradient-to-b from-[#E12B2B] via-[#D11C1C] to-[#B50F13]
         px-1 py-5 shadow-[inset_0_1px_0_rgba(255,255,255,0.08)] ring-1 ring-black/40
         transition-transform duration-300 lg:translate-x-0 lg:fixed lg:h-screen">
  <span class="pointer-events-none absolute right-0 top-2 bottom-2 w-[2px] rounded bg-white/10"></span>

  <nav class="mt-2 flex flex-col items-center gap-y-10">
    @php $cls = 'h-5 w-5 text-white/80 transition group-hover:text-white'; @endphp

    <a href="#" class="group nav-btn" data-index="0" title="Dashboard">
      <i data-lucide="grid" class="{{ $cls }}"></i>
    </a>
    <a href="#" class="group nav-btn" data-index="1" title="Chat">
      <i data-lucide="message-circle" class="{{ $cls }}"></i>
    </a>
    <a href="#" class="group nav-btn" data-index="2" title="Billing">
      <i data-lucide="dollar-sign" class="{{ $cls }}"></i>
    </a>
    <a href="#" class="group nav-btn" data-index="3" title="Users">
      <i data-lucide="users" class="{{ $cls }}"></i>
    </a>
    <a href="#" class="group nav-btn" data-index="4" title="Settings">
      <i data-lucide="settings" class="{{ $cls }}"></i>
    </a>
    <a href="#" class="group nav-btn" data-index="5" title="Docs">
      <i data-lucide="file-text" class="{{ $cls }}"></i>
    </a>
  </nav>
</aside>

{{-- OVERLAY mobile --}}
<div id="ov" class="fixed inset-0 z-40 hidden bg-black/40 backdrop-blur-[1px] lg:hidden"></div>
