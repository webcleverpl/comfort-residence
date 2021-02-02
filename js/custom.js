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
})