const header = document.querySelector('.site-header');
const toggle = document.querySelector('.menu-toggle');
const nav = document.querySelector('.main-nav');

function setScrolledHeader() {
    header?.classList.toggle('is-scrolled', window.scrollY > 8);
}

setScrolledHeader();
window.addEventListener('scroll', setScrolledHeader, { passive: true });

toggle?.addEventListener('click', () => {
    const opened = document.body.classList.toggle('menu-open');
    toggle.setAttribute('aria-expanded', opened ? 'true' : 'false');
});

nav?.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
        document.body.classList.remove('menu-open');
        toggle?.setAttribute('aria-expanded', 'false');
    });
});
