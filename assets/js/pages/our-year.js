jQuery(document).ready(function ($) {
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

    $('.logo-slider').on('init', function (event, slick) {
        const dots = $('.slick-dots li');
        const totalDots = dots.length;
        const radius = 200;

        dots.each(function (index) {
            const angle = (360 / totalDots) * index;
            const x = Math.cos((angle * Math.PI) / 180) * radius;
            const y = Math.sin((angle * Math.PI) / 180) * radius;

            $(this).css({
                position: 'absolute',
                transform: `translate(${x}px, ${y}px)`,
            });
        });
    });

    $('.logo-slider').slick({
        dots: true,
        arrows: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
    });
});

