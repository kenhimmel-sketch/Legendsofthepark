(function () {
  const toggles = document.querySelectorAll('[data-lop-toggle]');
  toggles.forEach((toggle) => {
    const target = document.getElementById(toggle.dataset.lopToggle);
    if (!target) {
      return;
    }

    toggle.addEventListener('click', (event) => {
      event.preventDefault();
      target.classList.toggle('is-open');
      toggle.setAttribute(
        'aria-expanded',
        target.classList.contains('is-open') ? 'true' : 'false'
      );
    });
  });

  const searchInputs = document.querySelectorAll('[data-lop-filter]');
  searchInputs.forEach((input) => {
    const targetId = input.dataset.lopFilter;
    const target = document.getElementById(targetId);
    if (!target) {
      return;
    }

    input.addEventListener('input', () => {
      const filter = input.value.toLowerCase();
      target.querySelectorAll('[data-lop-filterable]')?.forEach((item) => {
        const text = item.textContent?.toLowerCase() || '';
        item.style.display = text.includes(filter) ? '' : 'none';
      });
    });
  });
})();
