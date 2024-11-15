let menuButton = document.getElementById('menu-button');
let menu = document.getElementById('menu');

menuButton.addEventListener('click', () => {
    let isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
    menuButton.setAttribute('aria-expanded', !isExpanded);
    menu.style.display = isExpanded ? 'none' : 'flex';
});