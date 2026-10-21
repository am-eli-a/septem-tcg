document.addEventListener('click', (e) => {
    const card = e.target.closest('[data-flip]');
    if (card) card.classList.toggle('is-flipped');

    if (e.target.closest('#reveal-all')) {
        document.querySelectorAll('[data-flip]').forEach((c) => c.classList.add('is-flipped'));
    }
});
