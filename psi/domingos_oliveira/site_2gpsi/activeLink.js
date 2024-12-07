document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('.navbar a');
    const currentURL = window.location.pathname;

    links.forEach(link => {
        const href = link.getAttribute('href');
        if (href === './' && currentURL === '/site_2gpsi/') {
            link.classList.add('active');
        } else if (href !== './' && currentURL.startsWith(`/site_2gpsi/${href}`)) {
            link.classList.add('active');
        }
    });
});
