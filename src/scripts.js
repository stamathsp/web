document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const currentTheme = getCookie('theme') || 'light';
    document.body.classList.toggle('dark', currentTheme === 'dark');

    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        const newTheme = document.body.classList.contains('dark') ? 'dark' : 'light';
        setCookie('theme', newTheme, 365);
    });

    document.querySelectorAll('.accordion-button').forEach(button => {
        button.addEventListener('click', () => {
            const content = button.nextElementSibling;
            content.style.display = content.style.display === 'block' ? 'none' : 'block';
        });
    });
});

function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = `${name}=${value};expires=${date.toUTCString()};path=/`;
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}