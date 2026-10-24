const menuToggle = document.querySelector('.menu-toggle');
const nav = document.querySelector('.main-nav');
menuToggle?.addEventListener('click', () => {
  const open = nav.classList.toggle('open');
  menuToggle.setAttribute('aria-expanded', String(open));
  menuToggle.setAttribute('aria-label', open ? 'Close navigation' : 'Open navigation');
});

document.querySelectorAll('.main-nav a').forEach(link => {
  link.addEventListener('click', () => {
    nav.classList.remove('open');
    menuToggle?.setAttribute('aria-expanded', 'false');
  });
});

document.querySelectorAll('.filter').forEach(button => {
  button.addEventListener('click', () => {
    document.querySelectorAll('.filter').forEach(item => item.classList.remove('active'));
    button.classList.add('active');
    const filter = button.dataset.filter;
    document.querySelectorAll('.athlete-card').forEach(card => {
      card.hidden = filter !== 'all' && card.dataset.sport !== filter;
    });
  });
});

let bagCount = 0;
const toast = document.getElementById('toast');
let toastTimer;
function showToast(message) {
  toast.textContent = message;
  toast.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => toast.classList.remove('show'), 2400);
}
document.querySelectorAll('.quick-add').forEach(button => {
  button.addEventListener('click', () => {
    bagCount += 1;
    document.getElementById('bag-count').textContent = bagCount;
    showToast(`${button.dataset.product} added to your bag (demo).`);
  });
});
document.querySelectorAll('.heart').forEach(button => {
  button.addEventListener('click', () => {
    button.classList.toggle('saved');
    button.textContent = button.classList.contains('saved') ? '♥' : '♡';
    showToast(button.classList.contains('saved') ? 'Saved to your favourites.' : 'Removed from your favourites.');
  });
});
document.getElementById('search-toggle')?.addEventListener('click', () => {
  const term = window.prompt('What are you looking for?');
  if (term?.trim()) {
    const found = [...document.querySelectorAll('.product-card')].some(card => card.textContent.toLowerCase().includes(term.toLowerCase()));
    showToast(found ? `Showing matches for “${term}” in the product section.` : `No demo products found for “${term}”.`);
    document.getElementById('products').scrollIntoView({ behavior: 'smooth' });
  }
});
document.getElementById('newsletter-form')?.addEventListener('submit', event => {
  event.preventDefault();
  const email = document.getElementById('email').value.trim();
  document.getElementById('form-message').textContent = `Thanks! ${email} is on the demo signup list. No email was sent.`;
  event.target.reset();
});
