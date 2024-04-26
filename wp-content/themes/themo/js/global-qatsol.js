document.addEventListener("DOMContentLoaded",() => {

    const openMenuBtn = document.getElementById('burgerBtn');

//burger menu
    openMenuBtn && openMenuBtn.addEventListener('click', function (e) {
        document.querySelector('body').classList.toggle('open-menu');
    });
})