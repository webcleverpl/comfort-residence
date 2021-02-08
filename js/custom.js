const cookiesBtn = document.querySelector('#cookies-button');
const cookiesContainer = document.querySelector('#cookies-container');

window.onload = function () {
    // if the user hasn't agreed to cookies
    if (localStorage.getItem('cookies') !== 'true') {
        cookiesContainer.style.display = 'flex';
    }
}

cookiesBtn.addEventListener('click', () => {
    localStorage.setItem('cookies', 'true');
    cookiesContainer.style.display = 'none';
});


// slide-in in view effect
const isElementXPercentInViewport = function (el, percentVisible) {
    let
        rect = el.getBoundingClientRect(),
        windowHeight = (window.innerHeight || document.documentElement.clientHeight);

    return !(
        Math.floor(100 - (((rect.top >= 0 ? 0 : rect.top) / +-(rect.height / 1)) * 100)) < percentVisible ||
        Math.floor(100 - ((rect.bottom - windowHeight) / rect.height) * 100) < percentVisible
    )
};

const left = document.querySelectorAll(".slide-in-left");
const right = document.querySelectorAll(".slide-in-right");
const fade = document.querySelectorAll(".custom-fade-in");

window.addEventListener("scroll", () => {
    left.forEach((el) => {
        if (isElementXPercentInViewport(el, 10)) {
            el.classList.add("come-in-left");
        }
    });

    right.forEach((el) => {
        if (isElementXPercentInViewport(el, 10)) {
            el.classList.add("come-in-right");
        }
    });

    fade.forEach((el) => {
        if (isElementXPercentInViewport(el, 10)) {
            el.classList.add('fade-in-element');
            el.classList.remove('hidden');
        }
    })
})

