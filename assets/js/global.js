;
(function ($) {
    /*
    let responsiveSliderSettings = {
        rows: 0,
        slidesToShow: 2,
        dots: true,
    };
    let $responsiveSlider = $('.selector');
     */


    // Scripts which runs after DOM load
    var scrollOut;
    $(function () {




        const header = document.querySelector('.header');
        const body = document.body;

        if (header) {
            const sticky = header.offsetTop;
            let prevScrollPos = window.scrollY;
            let headerBottom = header.offsetTop + header.offsetHeight;

            function checkScroll() {
                const currentScrollPos = window.scrollY;

                if (currentScrollPos > sticky) {
                    header.classList.add('active');
                    body.style.marginTop = `${header.offsetHeight}px`;
                } else {
                    header.classList.remove('active');
                    body.style.marginTop = '0';
                }

                if (prevScrollPos > currentScrollPos || currentScrollPos < headerBottom) {
                    header.style.top = "0";
                } else {
                    header.style.top = "-100%";
                }

                prevScrollPos = currentScrollPos;
            }

            window.addEventListener('scroll', checkScroll);

            checkScroll();
        } else {
            console.warn('.header element not found.');
        }

        const bannerLink = document.querySelector('a[href="#banner"]');
        if (bannerLink) {
            bannerLink.addEventListener('click', function (event) {
                event.preventDefault();

                const targetElement = document.querySelector('#banner');
                if (targetElement) {
                    const offsetTop = targetElement.getBoundingClientRect().top + window.pageYOffset;

                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                } else {
                    console.warn('Target element #banner not found.');
                }
            });
        } else {
            console.warn('Anchor link with href="#banner" not found.');
        }


        gsap.registerPlugin(ScrollTrigger);
        gsap.defaults({ease: "none", duration: 2});
        gsap.to(".repeater-container", {
            scrollTrigger: {
                trigger: ".repeater-container",
                // markers: true,
                toggleActions: "restart pause revers pause",
                start: "center bottom",
                end: "center",
                scrub: true,
            },
            x: 0,
            rotation: -10,
            duration: 1,

        });
        gsap.to(".gallery-image", {
            scrollTrigger: {
                trigger: ".gallery-image",
                // markers: true,
                toggleActions: "restart pause revers pause",
                start: "top bottom",
                end: "center",
                scrub: true,
            },
            x: 0,
            rotation: -590,
            duration: 1,
            end: {rotation: 0,},
        });

        gsap.to(".left-column, .right-column", {
            scrollTrigger: {
                trigger: ".repeater-container",
                toggleActions: "restart pause revers pause",
                start: "center bottom",
                end: "center",
                scrub: true,
            },
            x: 0,
            rotation: 10,
            duration: 1
        });

        gsap.utils.toArray(".content-wrapper").forEach((contentWrapper, i, array) => {
            if (i !== array.length - 1) {
                ScrollTrigger.create({
                    trigger: contentWrapper,
                    start: "top top",
                    pin: true,
                    pinSpacing: false,
                });
            }
        });

        ScrollTrigger.create({
            trigger: ".what-content-wrapper",
            start: "top top",
            pin: true,
            pinSpacing: false,
        });

        ScrollTrigger.create({
            trigger: ".download-content-wrapper",
            start: "-=300 top",
            pin: true,
            pinSpacing: false,
        });

        // const sections = gsap.utils.toArray(".repeater-section");
        //
        // sections.forEach((section, index) => {
        //     const content = section.querySelector(".content-wrapper");
        //
        // if (index === sections.length - 1) {
        //     gsap.timeline({
        //         scrollTrigger: {
        //             trigger: section,
        //             start: "top top",
        //             end: "bottom bottom",
        //             pin: true,
        //             scrub: true,
        //         },
        //     });
        // } else {
        //
        //     gsap.timeline({
        //         scrollTrigger: {
        //             trigger: section,
        //             start: "top top",
        //             end: "bottom top",
        //             scrub: true,
        //         },
        //     })
        //         .fromTo(
        //             content,
        //             { y: 0 },
        //             { y: "100%", ease: "none" }
        //         );
        // }
        // });


        // gsap.utils.toArray(".what-can-you-do").forEach((section, index) => {
        //     const content = section.querySelector(".what-content-wrapper");
        //
        //     gsap.timeline({
        //         scrollTrigger: {
        //             trigger: section,
        //             start: "top top",
        //             end: "bottom top",
        //             scrub: true,
        //         },
        //     })
        //         .fromTo(
        //             content,
        //             {y: 0},
        //             {y: "100%", ease: "none"}
        //         );
        // });

        // gsap.utils.toArray(".download").forEach((section, index) => {
        //     const content = section.querySelector(".download-content-wrapper");
        //     gsap.timeline({
        //         scrollTrigger: {
        //             trigger: section,
        //             start: "top top",
        //             end: "bottom top",
        //             scrub: true,
        //         },
        //     })
        //         .fromTo(
        //             content,
        //             {y: 0},
        //             {y: "100%", ease: "none"}
        //         );
        // });


        function animateNumbers() {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const endValue = parseInt(counter.getAttribute('data-count'), 10);
                gsap.fromTo(counter,
                    {innerHTML: 0},
                    {
                        innerHTML: endValue,
                        duration: 2,
                        ease: "power1.out",
                        scrollTrigger: {
                            trigger: counter,
                            start: "top 100%",
                            toggleActions: "restart none none none",
                        },
                        snap: {innerHTML: 1},
                        onUpdate: function () {
                            counter.innerHTML = Math.round(this.targets()[0].innerHTML);
                        }
                    }
                );
            });
        }

        animateNumbers();



        const tabs = document.querySelectorAll('.data-tabs__item');
        const contentItems = document.querySelectorAll('.mainTabContent__content__item');
        const navItems = document.querySelectorAll('.mainTabContent__nav');
        const mainContainer = document.querySelector('.data-tabs__main');
        const overviewButton = document.querySelector('.data-tabs__overview');
        const overviewContainer = document.querySelector('.overview-container');
        const fullButtons = document.querySelectorAll('.view-fulscreen');

        fullButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                button.classList.toggle('is-active');

                if (button.classList.contains('is-active')) {
                    mainContainer.classList.add('fullscreen');
                } else {
                    mainContainer.classList.remove('fullscreen');
                }
            });
        });
        const styles = {
            green: '2px solid rgb(68, 187, 199)',
            pink: '2px solid rgb(233, 88, 119)',
            purple: '2px solid rgb(202, 167, 205)',
            lime: '2px solid rgb(114, 201, 144)',
            blue: '2px solid rgb(37, 154, 212)',
        };

        const updateMainContainerStyle = (activeTab) => {
            mainContainer.style.border = '';
            const tabClass = [...activeTab.classList].find(cls => styles[cls]);
            if (tabClass && styles[tabClass]) {
                mainContainer.style.border = styles[tabClass];
            }
        };

        const initializeSliders = () => {
            $('.tabs-images').each(function () {
                if (!$(this).hasClass('slick-initialized')) {
                    $(this).slick({
                        infinite: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    });
                } else {
                    $(this).slick('setPosition');
                }
            });
        };

        if (tabs.length > 0) {
            const firstTab = tabs[0];
            firstTab.classList.add('active');
            updateMainContainerStyle(firstTab);

            if (contentItems.length > 0) {
                contentItems[0].classList.add('active');
            }
            if (navItems.length > 0) {
                navItems[0].classList.add('active');
            }
            initializeSliders();
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                const index = tab.dataset.index;

                tabs.forEach(tab => tab.classList.remove('active'));
                contentItems.forEach(content => content.classList.remove('active'));
                navItems.forEach(nav => nav.classList.remove('active'));

                tab.classList.add('active');
                document.querySelector(`.mainTabContent__content__item[data-index="${index}"]`).classList.add('active');
                document.querySelector(`.mainTabContent__nav[data-index="${index}"]`).classList.add('active');

                overviewContainer.classList.remove('active');

                mainContainer.classList.remove('fullscreen');

                const mainTabContent = document.querySelector('.mainTabContent__content');
                if (mainTabContent) {
                    mainTabContent.style.display = 'block';
                }
                updateMainContainerStyle(tab);
                initializeSliders();
            });
        });

        if (overviewButton) {
            overviewButton.addEventListener('click', (e) => {
                e.preventDefault();

                tabs.forEach(tab => tab.classList.remove('active'));
                contentItems.forEach(content => content.classList.remove('active'));
                navItems.forEach(nav => nav.classList.remove('active'));

                mainContainer.classList.add('fullscreen');

                overviewContainer.classList.add('active');

                const mainTabContent = document.querySelector('.mainTabContent__content');
                if (mainTabContent) {
                    mainTabContent.style.display = 'none';
                }

                mainContainer.style.border = '';
            });
        }

        const subNavs = document.querySelectorAll('.mainTabContent__subNav');
        subNavs.forEach(subNav => {
            const subNavToggle = subNav.querySelector('a');
            const subNavWrap = subNav.querySelector('.mainTabContent__subNav__wrap');
            if (subNavWrap) {
                subNavToggle.addEventListener('click', (e) => {
                    e.preventDefault();

                    subNavs.forEach(nav => {
                        if (nav !== subNav) {
                            nav.classList.remove('open');
                        }
                    });
                    subNav.classList.toggle('open');
                });
            } else {
                subNavToggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    const index = subNav.dataset.index;

                    subNavs.forEach(nav => nav.classList.remove('active'));
                    contentItems.forEach(content => content.classList.remove('active'));

                    subNav.classList.add('active');
                    document.querySelector(`.mainTabContent__content__item[data-index="${index}"]`).classList.add('active');
                    initializeSliders();
                });
            }
        });

        const subNavItems = document.querySelectorAll('.mainTabContent__subNav__item');
        subNavItems.forEach(subNavItem => {
            subNavItem.addEventListener('click', (e) => {
                e.preventDefault();
                const index = subNavItem.dataset.index;

                subNavItems.forEach(item => item.classList.remove('active'));
                contentItems.forEach(content => content.classList.remove('active'));

                subNavItem.classList.add('active');
                document.querySelector(`.mainTabContent__content__item[data-index="${index}"]`).classList.add('active');
                initializeSliders();
            });
        });






















        // Init LazyLoad
        var lazyLoadInstance = new LazyLoad({
            elements_selector: 'img[data-lazy-src],.pre-lazyload,[data-pre-lazyload],video:not([src]):not([data-lazy-src]),video[data-lazy-src]',
            data_src: "lazy-src",
            data_srcset: "lazy-srcset",
            data_sizes: "lazy-sizes",
            skip_invisible: false,
            class_loading: "lazyloading",
            class_loaded: "lazyloaded",
        });
        // Add tracking on adding any new nodes to body to update lazyload for the new images (AJAX for example)
        window.addEventListener('LazyLoad::Initialized', function (e) {
            // Get the instance and puts it in the lazyLoadInstance variable
            if (window.MutationObserver) {
                var observer = new MutationObserver(function (mutations) {
                    mutations.forEach(function (mutation) {
                        mutation.addedNodes.forEach(function (node) {
                            if (typeof node.getElementsByTagName !== 'function') {
                                return;
                            }
                            imgs = node.getElementsByTagName('img');
                            if (0 === imgs.length) {
                                return;
                            }
                            lazyLoadInstance.update();
                        });
                    });
                });
                var b = document.getElementsByTagName("body")[0];
                var config = {childList: true, subtree: true};
                observer.observe(b, config);
            }
        }, false);

        // Load all images in slider after init
        $(document).on("init", ".slick-slider", function (e, slick) {
            lazyLoadInstance.loadAll(slick.$slider[0].getElementsByTagName('img'));
        });

        /*
        // responsiveSliderSettings - Settings for slider on responsive. Create this variable in the top of this file before $(document).ready()
        reinitSlickOnResize($responsiveSlider, responsiveSliderSettings, 641)
         */

        // Detect element appearance in viewport
        scrollOut = ScrollOut({
            offset: function (el) {
                let bodyRect = document.body.getBoundingClientRect();
                let rect = el.getBoundingClientRect();
                let offset = rect.top - bodyRect.top - window.innerHeight;
                return offset + 50;
            },
            targets: '.acf-map,[data-scroll]',
            once: true,
            onShown: function (element) {
                if ($(element).is('.ease-order')) {
                    $(element).find('.ease-order__item').each(function (i) {
                        var $this = $(this);
                        $(this).attr('data-scroll', '');
                        window.setTimeout(function () {
                            $this.attr('data-scroll', 'in');
                        }, 300 * i);
                    });
                }
                if ($(element).is('.acf-map')) {
                    render_map($(element));
                }
            }
        });


        // Init parallax
        if (typeof $.fn.jarallax !== 'undefined') {
            $('.jarallax').jarallax({
                speed: 0.5,
            });

            $('.jarallax-inline').jarallax({
                speed: 0.5,
                keepImg: true,
                onInit: function () {
                    lazyLoadInstance.update();
                }
            });
        }

        //Remove placeholder on click
        $('input, textarea').each(function () {
            removeInputPlaceholderOnFocus(this);
        });

        //Make elements equal height
        if (typeof $.fn.matchHeight !== 'undefined') {
            $('.matchHeight').matchHeight();
        }

        // Add fancybox to images
        $('.gallery-item').find('a[href$="jpg"], a[href$="png"], a[href$="gif"]').attr('rel', 'gallery').attr('data-fancybox', 'gallery');
        $('a[rel*="album"], .fancybox, a[href$="jpg"], a[href$="png"], a[href$="gif"]').fancybox({});

        /**
         * Scroll to Gravity Form confirmation message after form submit
         */
        $(document).on('gform_confirmation_loaded', function (event, formId) {
            var $target = $('#gform_confirmation_wrapper_' + formId);
            smoothScrollTo($target);
        });

        // Init Jquery UI select
        $("select").not("#billing_state, #shipping_state, #billing_country, #shipping_country, [class*='woocommerce'], #product_cat, #rating").each(function () {
            initSelect2(this);
        });

        $(document).on('gform_post_render', function (event, form_id, current_page) {
            const $form = $("#gform_" + form_id)
            $form.find("select").each(function () {
                initSelect2(this);
            });

            $form.find("input, textarea").each(function () {
                removeInputPlaceholderOnFocus(this);
            });
        });

        $(document).on('click', '.s-qty-dec,.s-qty-inc', function () {
            var $numberInput = $(this).closest('.quantity').find('input'),
                action = $(this).is('.s-qty-inc') ? 'stepUp' : 'stepDown';
            $numberInput[0][action]();
            $numberInput.trigger('change');
        });

        /**
         * Update lazyload images and reinit select on cart/checkout update
         */
        $(document).on('updated_wc_div', function () {
            lazyLoadInstance.loadAll();
            $('body').find('div.woocommerce').find('select').each(function () {
                initSelect2(this);
            });
        });

        /**
         * Hide gravity forms required field message on data input
         */
        $('body').on('change keyup', '.gfield input, .gfield textarea, .gfield select', function () {
            var $field = $(this).closest('.gfield');
            if ($field.hasClass('gfield_error') && $(this).val().length) {
                $field.find('.validation_message').hide();
            } else if ($field.hasClass('gfield_error') && !$(this).val().length) {
                $field.find('.validation_message').show();
            }
        });

        /**
         * Add `is-active` class to menu-icon button on Responsive menu toggle
         * And remove it on breakpoint change
         */
        $(window).on('toggled.zf.responsiveToggle', function () {
            $('.menu-icon').toggleClass('is-active');
        }).on('changed.zf.mediaquery', function (e, value) {
            $('.menu-icon').removeClass('is-active');
        });

        /**
         * Close responsive menu on orientation change
         */
        $(window).on('orientationchange', function () {
            setTimeout(function () {
                if ($('.menu-icon').hasClass('is-active') && window.innerWidth < 641) {
                    $('[data-responsive-toggle="main-menu"]').foundation('toggleMenu')
                }
            }, 200);
        });

        resizeVideo();

        // Share post popup
        $('.js-share-link').click(function (e) {
            e.preventDefault();
            var wpWidth = $(window).width(), wpHeight = $(window).height();
            window.open($(this).attr('href'), 'Share', "top=" + (wpHeight - 400) / 2 + ",left=" + (wpWidth - 600) / 2 + ",width=600,height=400");
        });

    });


    // Scripts which runs after all elements load

    $(window).on('load', function () {

        if (typeof scrollOut !== "undefined") {
            scrollOut.update();
        }

        //jQuery code goes here
        if ($('.preloader').length) {
            $('.preloader').addClass('preloader--hidden');
        }

    });

    // Scripts which runs at window resize

    let resizeVideoCallback = debounce(resizeVideo, 200);
    // let resizeSliderCallback = debounce( reinitSlickOnResize, 200 );
    $(window).on('resize', function () {

        //jQuery code goes here
        resizeVideoCallback();

        /*
        resizeSliderCallback( $responsiveSlider, responsiveSliderSettings, 641 );
        */


    });

    // Scripts which runs on scrolling

    $(window).on('scroll', function () {

        //jQuery code goes here

    });

    /*
     *  This function will render a Google Map onto the selected jQuery element
     */

    function render_map($el) {
        // var
        var $markers = $el.find('.marker');
        // var styles = Here should be styles for Google Maps from https://snazzymaps.com/explore ; // Uncomment for map styling

        // vars
        var args = {
            zoom: 16,
            center: new google.maps.LatLng(0, 0),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            // styles : styles // Uncomment for map styling
        };

        // create map
        var map = new google.maps.Map($el[0], args);

        // add a markers reference
        map.markers = [];

        // add markers
        $markers.each(function () {
            add_marker($(this), map);
        });

        // center map
        center_map(map);
    }

    /*
     *  This function will add a marker to the selected Google Map
     */

    var infowindow;

    function add_marker($marker, map) {
        // var
        var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));

        // create marker
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            //icon: $marker.data('marker-icon') //uncomment if you use custom marker
        });

        // add to array
        map.markers.push(marker);

        // if marker contains HTML, add it to an infoWindow
        if ($.trim($marker.html())) {
            // create info window
            infowindow = new google.maps.InfoWindow();

            // show info window when marker is clicked
            google.maps.event.addListener(marker, 'click', function () {
                // Close previously opened infowindow, fill with new content and open it
                infowindow.close();
                infowindow.setContent($marker.html());
                infowindow.open(map, marker);
            });
        }
    }

    /*
    *  This function will center the map, showing all markers attached to this map
    */

    function center_map(map) {
        // vars
        var bounds = new google.maps.LatLngBounds();

        // loop through all markers and create bounds
        $.each(map.markers, function (i, marker) {
            var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
            bounds.extend(latlng);
        });

        // only 1 marker?
        if (map.markers.length == 1) {
            // set center of map
            map.setCenter(bounds.getCenter());
        } else {
            // fit to bounds
            map.fitBounds(bounds);
        }
    }

    /**
     * Helper functions
     */

    function debounce(callback, time) {
        var timeout;

        return function () {
            var context = this;
            var args = arguments;
            if (timeout) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(function () {
                timeout = null;
                callback.apply(context, args);
            }, time);
        }
    }

    function handleFirstTab(e) {
        var key = e.key || e.keyCode;
        if (key === 'Tab' || key === '9') {
            $('body').removeClass('no-outline');

            window.removeEventListener('keydown', handleFirstTab);
            window.addEventListener('mousedown', handleMouseDownOnce);
        }
    }

    function handleMouseDownOnce() {
        $('body').addClass('no-outline');

        window.removeEventListener('mousedown', handleMouseDownOnce);
        window.addEventListener('keydown', handleFirstTab);
    }

    window.addEventListener('keydown', handleFirstTab);

    // Fit slide video background to video holder
    function resizeVideo() {
        var $holder = $(".video-holder");
        $holder.each(function () {
            var $that = $(this);
            var ratio = $that.data("ratio") ? $that.data("ratio") : "16:9",
                width = parseFloat(ratio.split(":")[0]),
                height = parseFloat(ratio.split(":")[1]);
            $that.find(".video-holder__media").each(function () {
                if ($that.width() / width > $that.height() / height) {
                    $(this).css({"width": "100%", "height": "auto"});
                } else {
                    $(this).css({"width": $that.height() * width / height, "height": "100%"});
                }
            });
        });
    }

    // Init Select2 plugin
    function initSelect2(elem) {
        var $field = $(elem);
        var $gfield = $field.closest(".gfield");
        var $countryBox = $field.closest('.ginput_address_country,.gfield_time_ampm');
        var args = {}
        if ($countryBox.length) {
            args.dropdownParent = $countryBox;
        } else if ($gfield.length) {
            args.dropdownParent = $gfield;
        }

        $field.select2(args);
    }

    function removeInputPlaceholderOnFocus(el) {
        $(el).data("holder", $(el).attr("placeholder"));

        $(el).on("focusin", function () {
            $(el).attr("placeholder", "");
        });

        $(el).on("focusout", function () {
            $(el).attr("placeholder", $(el).data("holder"));
        });
    }

    /**
     * Init slick slider on smaller screens, And destroy it on desktop
     */
    function reinitSlickOnResize($slider, settings, breakpoint) {
        if (window.innerWidth >= breakpoint) {
            if ($slider.hasClass("slick-initialized")) {
                $slider.slick("unslick");
            }
        } else {
            if (!$slider.hasClass("slick-initialized")) {
                $slider.slick(settings);
            }
        }
    }

    /**
     * Smooth scroll to target
     */
    function smoothScrollTo($target, offset) {
        offset = typeof offset == "undefined" ? 0 : offset;
        $("html, body").animate({
            scrollTop: $target.offset().top - 50 - offset,
        }, 500);
        $target.focus();
        if ($target.is(":focus")) { // Checking if the target was focused
            return false;
        } else {
            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
        }
    }

}(jQuery));