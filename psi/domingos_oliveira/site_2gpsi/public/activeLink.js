document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('.navbar a');
    const currentURL = window.location.pathname.endsWith('/')
        ? window.location.pathname
        : `${window.location.pathname}/`;

    links.forEach(link => {
        const href = link.getAttribute('href');
        const absoluteHref = new URL(href, window.location.origin).pathname;
        const normalizedHref = absoluteHref.endsWith('/')
            ? absoluteHref
            : `${absoluteHref}/`;

        if (normalizedHref === '/' && currentURL === '/') {
            link.classList.add('active');
            return;
        }
        if (href !== '../' && currentURL.includes(normalizedHref)) {
            link.classList.add('active');
        }
    });
});
