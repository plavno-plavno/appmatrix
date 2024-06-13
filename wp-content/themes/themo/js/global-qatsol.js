document.addEventListener("DOMContentLoaded",() => {

    const openMenuBtn = document.getElementById('burgerBtn');

//burger menu
    openMenuBtn && openMenuBtn.addEventListener('click', function (e) {
        document.querySelector('body').classList.toggle('open-menu');
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