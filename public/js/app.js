document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('toggleBtn');
  const block = document.getElementById('toggleBlock');
  if (btn && block) {
    btn.addEventListener('click', () => {
      block.classList.toggle('d-none');
    });
  }
});
