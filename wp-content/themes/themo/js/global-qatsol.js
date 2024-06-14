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


    var swiper = new Swiper(".techSwiper", {
        slidesPerView: 1.2,
        spaceBetween: 2,
        breakpoints: {
            768: {
                slidesPerView: 2.4,
            },

            1100: {
                slidesPerView: 4,
            },
        },
    });

    openAccordion(accordionMenu);
})