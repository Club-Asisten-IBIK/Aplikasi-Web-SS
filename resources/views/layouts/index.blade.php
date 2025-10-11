<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>@yield('title', 'Dashboard')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  {{-- (Opsional) CSS lama – kalau bentrok style, matikan saja --}}
  

  {{-- Tailwind + Vite --}}
  @vite(['resources/css/app.css','resources/js/app.js'])

  {{-- Lucide Icons harus setelah CSS dan sebelum JS sidebar (pakai defer) --}}
  <script src="https://unpkg.com/lucide@latest" defer></script>
</head>

<body class="">
  {{-- Sidebar (berisi topbar mobile + overlay juga) --}}
  @include('layouts.navbar.navigation')

  {{-- Konten --}}
  <main class="lg:ml-[76px]">
    
    <div class="p-6" style="background-color: #F9FAFB">
      @yield('content')
    </div>
  </main>
</body>
</html>
