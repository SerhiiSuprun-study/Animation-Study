document.addEventListener('DOMContentLoaded', () => {
    console.log('Script for Our Year page loaded');

    const menuIcon = document.querySelector('.menu-icon');
    const closeButton = document.querySelector('.close-button');
    const topBar = document.querySelector('.custom-top-bar');

    if (menuIcon && closeButton && topBar) {
        menuIcon.addEventListener('click', () => {
            topBar.classList.add('active');
        });

        closeButton.addEventListener('click', () => {
            topBar.classList.remove('active');
        });
    }
});


