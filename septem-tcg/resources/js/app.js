document.addEventListener('click', (e) => {
    const card = e.target.closest('[data-flip]');
    if (card) card.classList.toggle('is-flipped');

    if (e.target.closest('#reveal-all')) {
        document.querySelectorAll('[data-flip]').forEach((c) => c.classList.add('is-flipped'));
    }
});

const burger = document.getElementById('burger');
const menu = document.getElementById('menu');

burger?.addEventListener('click', () => {
    const closed = menu.classList.toggle('max-md:hidden');
    burger.setAttribute('aria-expanded', String(!closed));
});
