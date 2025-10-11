document.addEventListener('DOMContentLoaded', () => {
  // Render Lucide (buat svg dari <i data-lucide>)
  if (window.lucide?.createIcons) {
    lucide.createIcons({ attrs: { 'stroke-width': 1.8, stroke: 'currentColor' } });
  }

  const sb = document.getElementById('sb');
  const ov = document.getElementById('ov');
  const hb = document.getElementById('hb');
  if (!sb) return;

  const ACTIVE_KEY = 'sidebar-active';
  const btns = sb.querySelectorAll('.nav-btn');

  // Helper: ambil ikon (svg hasil lucide atau fallback <i>)
  const getIcon = (el) => el.querySelector('svg') || el.querySelector('i[data-lucide]');

  // Restore active (default 0)
  const saved = localStorage.getItem(ACTIVE_KEY);
  setActive(saved ? +saved : 0);

  // Klik → aktif
  sb.addEventListener('click', (e) => {
    const a = e.target.closest('.nav-btn'); if (!a) return;
    const idx = Number(a.dataset.index || 0);
    setActive(idx);
    localStorage.setItem(ACTIVE_KEY, idx);
    if (window.innerWidth < 1024) closeSb();
  });

  // Toggle mobile
  const openSb  = () => { sb.classList.remove('-translate-x-full'); ov?.classList.remove('hidden'); document.body.style.overflow='hidden'; };
  const closeSb = () => { sb.classList.add('-translate-x-full'); ov?.classList.add('hidden'); document.body.style.overflow=''; };
  hb?.addEventListener('click', () => sb.classList.contains('-translate-x-full') ? openSb() : closeSb());
  ov?.addEventListener('click', closeSb);
  window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024) { ov?.classList.add('hidden'); document.body.style.overflow=''; sb.classList.remove('-translate-x-full'); }
  });

  // Pastikan setelah lucide merender svg, state aktif tetap benar
  setTimeout(() => {
    const s = localStorage.getItem(ACTIVE_KEY);
    setActive(s ? +s : 0);
  }, 0);

  function setActive(index) {
    // reset semua
    btns.forEach((b) => {
      b.classList.remove('active');
      const pill = b.querySelector('.pill-wrap');
      if (pill) {
        const icon = pill.querySelector('svg') || pill.querySelector('i[data-lucide]');
        if (icon) pill.replaceWith(icon);
      }
    });

    const target = sb.querySelector(`.nav-btn[data-index="${index}"]`);
    if (!target) return;

    const icon = getIcon(target);
    if (!icon) return;

    const wrap = document.createElement('span');
    wrap.className =
      'pill-wrap inline-flex h-12 w-12 items-center justify-center rounded-2xl ' +
      'bg-gradient-to-br from-[#FF8A1A] via-[#FF7A33] to-[#FF5E57] ' +
      'shadow-sm';
    icon.replaceWith(icon.cloneNode(true));
    wrap.appendChild(getIcon(target));
    target.appendChild(wrap);
    target.classList.add('active');
  }
});
