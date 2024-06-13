document.addEventListener("DOMContentLoaded",() => {

    const openMenuBtn = document.getElementById('openMenu');
    let haederBlock = $('.header');

//burger menu
    openMenuBtn && openMenuBtn.addEventListener('click', function (e) {
        this.classList.toggle('open');
    });

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
})