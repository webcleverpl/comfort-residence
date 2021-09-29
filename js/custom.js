const cookiesBtn = document.querySelector('#cookies-button');
const cookiesContainer = document.querySelector('#cookies-container');

const left = document.querySelectorAll(".slide-in-left");
const right = document.querySelectorAll(".slide-in-right");
const fade = document.querySelectorAll(".custom-fade-in");

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

// slide-in and fade-in functionality
const isElementXPercentInViewport = function (el, percentVisible) {
    let
        rect = el.getBoundingClientRect(),
        windowHeight = (window.innerHeight || document.documentElement.clientHeight);

    return !(
        Math.floor(100 - (((rect.top >= 0 ? 0 : rect.top) / +-(rect.height / 1)) * 100)) < percentVisible ||
        Math.floor(100 - ((rect.bottom - windowHeight) / rect.height) * 100) < percentVisible
    )
};

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

let videoPlayButton;
const videoWrapper = document.getElementsByClassName('video-wrapper')[0];
const video = document.getElementsByTagName('video')[0];
const videoMethods = {
        renderVideoPlayButton: function() {
            if (videoWrapper.contains(video)) {
				this.formatVideoPlayButton()
                video.classList.add('has-media-controls-hidden')
                videoPlayButton = document.getElementsByClassName('video-overlay-play-button')[0]
                videoPlayButton.addEventListener('click', this.hideVideoPlayButton)
            }
        },

        formatVideoPlayButton: function() {
            videoWrapper.insertAdjacentHTML('beforeend', '\
                <svg class="video-overlay-play-button" viewBox="0 0 200 200" alt="Play video">\
                    <circle cx="100" cy="100" r="90" fill="none" stroke-width="15" stroke="#551caa"/>\
                    <polygon points="70, 55 70, 145 145, 100" fill="#551caa"/>\
                </svg>\
            ')
        },

        hideVideoPlayButton: function() {
            video.play()
            videoPlayButton.classList.add('is-hidden')
            video.classList.remove('has-media-controls-hidden')
            video.setAttribute('controls', 'controls')
        }
	}

videoMethods.renderVideoPlayButton()