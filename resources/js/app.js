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

document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('[data-news-carousel]');
    const prevButton = document.querySelector('[data-news-prev]');
    const nextButton = document.querySelector('[data-news-next]');

    if (!carousel || !prevButton || !nextButton) {
        return;
    }

    const getScrollAmount = () => {
        const card = carousel.querySelector('.news-card');

        if (!card) {
            return carousel.clientWidth;
        }

        const styles = window.getComputedStyle(carousel);
        const gap = parseFloat(styles.columnGap || styles.gap || 0);

        return card.getBoundingClientRect().width + gap;
    };

    const updateButtons = () => {
        const maxScrollLeft = carousel.scrollWidth - carousel.clientWidth;

        prevButton.disabled = carousel.scrollLeft <= 2;
        nextButton.disabled = carousel.scrollLeft >= maxScrollLeft - 2;

        prevButton.classList.toggle('is-disabled', prevButton.disabled);
        nextButton.classList.toggle('is-disabled', nextButton.disabled);
    };

    prevButton.addEventListener('click', () => {
        carousel.scrollBy({
            left: -getScrollAmount(),
            behavior: 'smooth',
        });
    });

    nextButton.addEventListener('click', () => {
        carousel.scrollBy({
            left: getScrollAmount(),
            behavior: 'smooth',
        });
    });

    carousel.addEventListener('scroll', updateButtons);
    window.addEventListener('resize', updateButtons);

    updateButtons();
});

document.querySelectorAll('[data-copy-link]').forEach((button) => {
    button.addEventListener('click', async () => {
        const link = button.dataset.copyLink;
        const originalText = button.textContent;

        try {
            await navigator.clipboard.writeText(link);
            button.textContent = 'Ссылка скопирована';
        } catch (error) {
            button.textContent = 'Скопируйте из адресной строки';
        }

        window.setTimeout(() => {
            button.textContent = originalText;
        }, 1800);
    });
});