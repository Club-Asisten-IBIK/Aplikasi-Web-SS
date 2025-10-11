<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div
  x-data="gradeTable({
    classes: ['Grade 9-A','Grade 10-A','Grade 11-A'],
    subjects: ['Matematika','Bahasa Inggris','Fisika','Kimia','Biologi'],
    students: [
      { id: 1, name: 'Emma Johnson', class: 'Grade 10-A', score: 0, grade: '' },
      { id: 2, name: 'Michael Brown', class: 'Grade 10-A', score: 0, grade: '' },
      { id: 3, name: 'Sarah Davis', class: 'Grade 9-A', score: 0, grade: '' },
      { id: 4, name: 'John Lee', class: 'Grade 11-A', score: 0, grade: '' },
      { id: 5, name: 'Olivia Smith', class: 'Grade 10-A', score: 0, grade: '' },
      { id: 6, name: 'William Taylor', class: 'Grade 9-A', score: 0, grade: '' },
      { id: 7, name: 'Sophia Clark', class: 'Grade 11-A', score: 0, grade: '' },
      { id: 8, name: 'James Wilson', class: 'Grade 10-A', score: 0, grade: '' },
      { id: 9, name: 'Isabella Moore', class: 'Grade 9-A', score: 0, grade: '' },
      { id: 10, name: 'Ethan Miller', class: 'Grade 11-A', score: 0, grade: '' },
    ],
  })"
  x-init="init()"
  class="bg-white rounded-2xl border border-[#E7EAF0] shadow-[0_1px_0_rgba(16,24,40,0.04)]"
>
  <div class="p-5 border-b border-[#ECEFF3] flex items-center justify-between">
    <div>
      <h3 class="text-[16px] font-semibold text-[#333333]">Daftar Nilai</h3>
      <p class="text-sm text-[#666666] mt-1">
        Pilih kelas & mapel → klik <span class="font-medium">Edit</span> untuk mengubah nilai massal.
      </p>
    </div>

    <!-- Single Edit / Save / Cancel -->
    <div class="flex gap-2">
      <button x-show="!isEditing"
              @click="startEdit"
              class="rounded-lg bg-[#333333] text-white h-10 px-4 hover:bg-[#111111]">
        Edit
      </button>
      <button x-show="isEditing"
              @click="saveAll"
              class="rounded-lg bg-green-600 text-white h-10 px-4 hover:bg-green-700">
        Simpan
      </button>
      <button x-show="isEditing"
              @click="cancelEdit"
              class="rounded-lg bg-[#F6F7FB] border h-10 px-4 hover:bg-[#E7EAF0] text-[#333333]">
        Batal
      </button>
    </div>
  </div>

  <div class="p-5 space-y-4">
    <!-- Dropdown Filters -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
      <div>
        <label class="block text-sm mb-2 text-[#333333]">Kelas</label>
        <select x-model="selectedClass" @change="filterByClass"
          class="border rounded-lg h-10 px-3 w-full bg-[#F6F7FB] focus:outline-none focus:ring-2 focus:ring-[#333333]/10">
          <option value="">-- pilih kelas --</option>
          <template x-for="c in classes" :key="c">
            <option x-text="c"></option>
          </template>
        </select>
      </div>
      <div>
        <label class="block text-sm mb-2 text-[#333333]">Mapel</label>
        <select x-model="selectedSubject"
          class="border rounded-lg h-10 px-3 w-full bg-[#F6F7FB] focus:outline-none focus:ring-2 focus:ring-[#333333]/10">
          <option value="">-- pilih mapel --</option>
          <template x-for="m in subjects" :key="m">
            <option x-text="m"></option>
          </template>
        </select>
      </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl border border-[#E7EAF0]">
      <table class="w-full text-sm">
        <thead class="bg-[#F6F7FB] text-[#333333]">
          <tr class="text-left">
            <th class="py-3 px-3 w-10">#</th>
            <th class="py-3 px-3">Nama Siswa</th>
            <th class="py-3 px-3 w-32">Nilai</th>
            <th class="py-3 px-3 w-24">Grade</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="(s, i) in filtered" :key="s.id">
            <tr class="border-b border-[#E7EAF0] last:border-0 hover:bg-[#F6F7FB]/70">
              <td class="py-2 px-3" x-text="i+1"></td>
              <td class="py-2 px-3" x-text="s.name"></td>

              <!-- Nilai: teks saat view, input saat edit -->
              <td class="py-2 px-3">
                <template x-if="!isEditing">
                  <span x-text="s.score ?? '-'"></span>
                </template>
                <template x-if="isEditing">
                  <input type="number" min="0" max="100"
                         class="border rounded-lg h-9 px-3 w-24 text-center"
                         x-model.number="s.score"
                         @input="s.grade = calcGrade(s.score)">
                </template>
              </td>

              <!-- Grade -->
              <td class="py-2 px-3">
                <span x-text="s.grade || calcGrade(s.score)"
                      :class="badgeClass(s.grade || calcGrade(s.score))"
                      class="px-2.5 py-0.5 rounded-full text-xs font-medium">
                </span>
              </td>
            </tr>
          </template>

          <tr x-show="!selectedClass">
            <td colspan="4" class="py-3 text-center text-[#666666]">Silakan pilih kelas terlebih dahulu.</td>
          </tr>
          <tr x-show="selectedClass && filtered.length === 0">
            <td colspan="4" class="py-3 text-center text-[#666666]">Tidak ada siswa untuk kelas ini.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
function gradeTable({ classes, subjects, students }) {
  return {
    classes, subjects, students,
    selectedClass: '', selectedSubject: '',
    filtered: [],

    // mode edit massal
    isEditing: false,
    snapshot: null, // backup untuk batal

    init() {
      // hitung grade awal jika perlu
      this.students = this.students.map(s => ({
        ...s,
        grade: this.calcGrade(s.score)
      }));
    },

    filterByClass() {
      this.filtered = this.students.filter(s => s.class === this.selectedClass);
    },

    startEdit() {
      // simpan snapshot deep copy untuk bisa dibatalkan
      this.snapshot = JSON.parse(JSON.stringify(this.students));
      this.isEditing = true;
    },

    cancelEdit() {
      if (this.snapshot) {
        this.students = JSON.parse(JSON.stringify(this.snapshot));
        this.filterByClass(); // refresh tampilan sesuai kelas terpilih
      }
      this.isEditing = false;
    },

    saveAll() {
      // normalisasi nilai & hitung grade
      this.students = this.students.map(s => {
        const n = Math.max(0, Math.min(100, Number(s.score) || 0));
        return { ...s, score: n, grade: this.calcGrade(n) };
      });
      this.filterByClass();
      this.isEditing = false;
      alert('Perubahan nilai disimpan (simulasi).');
    },

    calcGrade(score) {
      const n = Number(score);
      if (isNaN(n)) return '';
      if (n >= 90) return 'A';
      if (n >= 80) return 'B';
      if (n >= 70) return 'C';
      if (n >= 60) return 'D';
      return 'E';
    },

    badgeClass(grade) {
      return {
        'A': 'bg-green-100 text-green-800',
        'B': 'bg-blue-100 text-blue-800',
        'C': 'bg-yellow-100 text-yellow-800',
        'D': 'bg-orange-100 text-orange-800',
        'E': 'bg-red-100 text-red-800',
        '': 'bg-[#EEF0F4] text-[#4B5563]'
      }[grade];
    },
  };
}
</script>
