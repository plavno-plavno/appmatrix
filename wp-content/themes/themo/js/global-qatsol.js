document.addEventListener("DOMContentLoaded",() => {

    const openMenuBtn = document.getElementById('openMenu');
    let haederBlock = $('.header');
    const burgerMenu = document.getElementById('burgerMenu');
    let accordionMenu = document.getElementsByClassName('acc-services');


//burger menu
    openMenuBtn && openMenuBtn.addEventListener('click', function (e) {
        this.classList.toggle('open');
        burgerMenu.classList.toggle('open');
        document.querySelector('body').classList.toggle('open-mobile-menu');
    });

    //accordion
    function openAccordion(acc) {
        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener('click', function () {
                this.classList.toggle('active');
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                    panel.style.visibility = 'hidden';
                } else {
                    panel.style.maxHeight = panel.scrollHeight + 'px';
                    panel.style.visibility = 'visible';
                }
            });
        }
    }



    $(window).scroll(function () {
        var scrolled = $(window).scrollTop();

        if (scrolled > 0 ) {
            $('#addHeaderBlock').addClass('show-fixed');
            haederBlock.addClass('header-scrolled');
        } else {
            $('#addHeaderBlock').removeClass('show-fixed');
            haederBlock.removeClass('header-scrolled');
            haederBlock.removeClass('header-fixed');
        }

        if (scrolled > 0 ) {
            haederBlock.addClass('header-fixed');
            $('#addHeaderBlock').addClass('show-absolute');
            haederBlock.removeClass('header-scrolled');
        } else {
            // haederBlock.removeClass('header-fixed');
            $('#addHeaderBlock').removeClass('show-absolute');

        }
        scrollPrev = scrolled;
    });

    openAccordion(accordionMenu);



    const scrollers = document.querySelectorAll(".scroller .wpb_wrapper");

// If a user hasn't opted in for recuded motion, then we add the animation
//     if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
        addAnimation();
    // }

    function addAnimation() {
        scrollers.forEach((scroller) => {
            // add data-animated="true" to every `.scroller` on the page
            // scroller.setAttribute("data-animated", true);

            // Make an array from the elements within `.scroller-inner`
            const scrollerInner = scroller;
            const scrollerContent = Array.from(scrollerInner.children);

            // For each item in the array, clone it
            // add aria-hidden to it
            // add it into the `.scroller-inner`
            scrollerContent.forEach((item) => {
                const duplicatedItem = item.cloneNode(true);
                scrollerInner.appendChild(duplicatedItem);
                scrollerInner.appendChild(duplicatedItem);
            });
        });
    }


})


window.addEventListener('load', function() {
    document.querySelectorAll('img').forEach(function(img) {
        img.src = img.src;
    });
});

document.addEventListener("DOMContentLoaded",() => {
    let swiper = new Swiper(".swiper-container.swiper-last-blog", {
        slidesPerView: 1,

        navigation: {
            nextEl: ".custom-button-next",
            prevEl: ".custom-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
        },
        breakpoints: {
            768: {
                spaceBetween: 20,
                slidesPerView: 2
            },
            1024: {
                spaceBetween: 20,
                slidesPerView: 3
            },
            1440: {
                spaceBetween: 24,
                slidesPerView: 3
            },
            1920: {
                spaceBetween: 32,
                slidesPerView: 3
            },
        }
    })
})


    document.addEventListener('wpcf7beforesubmit', function(event) {
        var form = event.target;
        var submitButton = form.querySelector('input[type="submit"], button[type="submit"]');

        if (submitButton) {
            submitButton.disabled = true;
        }
    });

    document.addEventListener('wpcf7mailsent', function(event) {
        var form = event.target;
        var submitButton = form.querySelector('input[type="submit"], button[type="submit"]');

        if (submitButton) {
            submitButton.disabled = false;
        }
    });

    document.addEventListener('wpcf7invalid', function(event) {
        var form = event.target;
        var submitButton = form.querySelector('input[type="submit"], button[type="submit"]');

        if (submitButton) {
            submitButton.disabled = false;
        }
    });

    document.addEventListener('wpcf7spam', function(event) {
        var form = event.target;
        var submitButton = form.querySelector('input[type="submit"], button[type="submit"]');

        if (submitButton) {
            submitButton.disabled = false;
        }
    });

    document.addEventListener('wpcf7mailfailed', function(event) {
        var form = event.target;
        var submitButton = form.querySelector('input[type="submit"], button[type="submit"]');

        if (submitButton) {
            submitButton.disabled = false;
        }
    });



