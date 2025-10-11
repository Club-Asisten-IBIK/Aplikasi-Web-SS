<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div
  x-data="{
    tanggal: '',
    kelas: '',
    mapel: '',
    absensi: {},
    selectAllStatus: '',

    applySelectAll() {
      const ids = Array.from(this.$root.querySelectorAll('[data-student-id]'))
        .map(el => Number(el.getAttribute('data-student-id')));

      // Buat object baru agar Alpine reaktif
      const next = {};
      ids.forEach(id => { next[id] = this.selectAllStatus; });
      this.absensi = next;
    },

    countBy(status) {
      return Object.values(this.absensi).filter(v => v === status).length;
    },

    simpan() {
      if (!this.tanggal || !this.kelas || !this.mapel) {
        alert('Mohon isi tanggal, kelas, dan mata pelajaran terlebih dahulu.');
        return;
      }
      alert(
        'Absensi tersimpan (simulasi):\n' +
        'Tanggal: ' + this.tanggal + '\n' +
        'Kelas: ' + this.kelas + '\n' +
        'Mapel: ' + this.mapel + '\n' +
        JSON.stringify(this.absensi, null, 2)
      );
    }
  }"
  class="bg-white rounded-2xl border border-[#E7EAF0] shadow-[0_1px_0_rgba(16,24,40,0.04)]"
>
  <!-- Header -->
  <div class="p-5 border-b border-[#ECEFF3] flex items-center justify-between">
    <h3 class="text-[16px] font-semibold flex items-center gap-2 text-[#0F172A]">
      <i data-lucide="calendar" class="w-5 h-5"></i> Absensi Harian
    </h3>
  </div>

  <div class="p-5">
    <!-- Filter -->
    <div class="flex flex-wrap gap-4 mb-6">
      <div>
        <label class="block text-sm mb-2 text-[#0F172A]">Tanggal</label>
        <input type="date" x-model="tanggal"
          class="border rounded-lg h-10 px-3 bg-[#F6F7FB] focus:outline-none focus:ring-2 focus:ring-[#333333]/10">
      </div>
      <div>
        <label class="block text-sm mb-2 text-[#0F172A]">Kelas</label>
        <select x-model="kelas"
          class="border rounded-lg h-10 px-3 w-48 bg-[#F6F7FB] focus:outline-none focus:ring-2 focus:ring-[#333333]/10">
          <option value="">-- pilih kelas --</option>
          <option>Grade 9-A</option>
          <option>Grade 10-A</option>
          <option>Grade 11-A</option>
        </select>
      </div>
      <div>
        <label class="block text-sm mb-2 text-[#0F172A]">Mata Pelajaran</label>
        <select x-model="mapel"
          class="border rounded-lg h-10 px-3 w-56 bg-[#F6F7FB] focus:outline-none focus:ring-2 focus:ring-[#333333]/10">
          <option value="">-- pilih mata pelajaran --</option>
          <option>Matematika</option>
          <option>Bahasa Inggris</option>
          <option>Fisika</option>
          <option>Kimia</option>
          <option>Biologi</option>
          <option>Sejarah</option>
          <option>Ekonomi</option>
        </select>
      </div>
    </div>

    <!-- Ringkasan -->
    <div class="flex flex-wrap gap-2 mb-4">
      <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800">Hadir: <span x-text="countBy('Hadir')"></span></span>
      <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-800">Izin: <span x-text="countBy('Izin')"></span></span>
      <span class="text-xs px-2 py-1 rounded-full bg-yellow-100 text-yellow-800">Sakit: <span x-text="countBy('Sakit')"></span></span>
      <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-800">Alfa: <span x-text="countBy('Alfa')"></span></span>
    </div>

    <!-- Tabel absensi -->
    <div class="overflow-x-auto rounded-xl border border-[#E7EAF0]">
      <table class="w-full text-sm">
        <thead class="bg-[#F6F7FB] text-[#0F172A]">
          <tr class="text-left">
            <th class="py-3 px-3 w-10">#</th>
            <th class="py-3 px-3">Nama Siswa</th>
            <th class="py-3 px-3 text-center">Status Kehadiran</th>
          </tr>

          <!-- BARIS TANDAI SEMUA -->
          <tr>
            <th class="py-2 px-3 text-xs text-[#64748B]" colspan="2">Tandai semua:</th>
            <th class="py-2 px-3">
              <div class="flex justify-center gap-4 flex-wrap">
                <label class="inline-flex items-center gap-2">
                  <input type="radio" name="select_all" value="Hadir"
                         x-model="selectAllStatus" @change="applySelectAll()"
                         class="accent-green-600">
                  <span class="text-green-700 text-sm font-medium">Hadir</span>
                </label>
                <label class="inline-flex items-center gap-2">
                  <input type="radio" name="select_all" value="Izin"
                         x-model="selectAllStatus" @change="applySelectAll()"
                         class="accent-blue-600">
                  <span class="text-blue-700 text-sm font-medium">Izin</span>
                </label>
                <label class="inline-flex items-center gap-2">
                  <input type="radio" name="select_all" value="Sakit"
                         x-model="selectAllStatus" @change="applySelectAll()"
                         class="accent-yellow-600">
                  <span class="text-yellow-700 text-sm font-medium">Sakit</span>
                </label>
                <label class="inline-flex items-center gap-2">
                  <input type="radio" name="select_all" value="Alfa"
                         x-model="selectAllStatus" @change="applySelectAll()"
                         class="accent-red-600">
                  <span class="text-red-700 text-sm font-medium">Alfa</span>
                </label>
              </div>
            </th>
          </tr>
        </thead>

        <tbody>
          @foreach($students as $index => $s)
          <tr class="border-b border-[#E7EAF0] last:border-0 hover:bg-[#F6F7FB]/70" data-student-id="{{ $s['id'] }}">
            <td class="py-2 px-3">{{ $index + 1 }}</td>
            <td class="py-2 px-3">{{ $s['name'] }}</td>
            <td class="py-2 px-3">
              <div class="grid grid-cols-2 sm:flex sm:justify-center gap-3 sm:gap-4">
                <label class="inline-flex items-center gap-2">
                  <input type="radio" name="absen_{{ $s['id'] }}" value="Hadir"
                         x-model="absensi[{{ $s['id'] }}]" class="accent-green-600">
                  <span class="text-green-700">Hadir</span>
                </label>
                <label class="inline-flex items-center gap-2">
                  <input type="radio" name="absen_{{ $s['id'] }}" value="Izin"
                         x-model="absensi[{{ $s['id'] }}]" class="accent-blue-600">
                  <span class="text-blue-700">Izin</span>
                </label>
                <label class="inline-flex items-center gap-2">
                  <input type="radio" name="absen_{{ $s['id'] }}" value="Sakit"
                         x-model="absensi[{{ $s['id'] }}]" class="accent-yellow-600">
                  <span class="text-yellow-700">Sakit</span>
                </label>
                <label class="inline-flex items-center gap-2">
                  <input type="radio" name="absen_{{ $s['id'] }}" value="Alfa"
                         x-model="absensi[{{ $s['id'] }}]" class="accent-red-600">
                  <span class="text-red-700">Alfa</span>
                </label>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Tombol simpan -->
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mt-6">
      <div class="text-xs text-[#64748B]">Pastikan semua siswa sudah dipilih statusnya.</div>
      <button @click="simpan()"
        class="rounded-lg bg-[#0F172A] text-white h-10 px-5 hover:bg-black">
        Simpan Absensii
      </button>
    </div>
  </div>
</div>
