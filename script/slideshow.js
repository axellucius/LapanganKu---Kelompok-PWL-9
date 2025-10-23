let slideIndex = 1;
let slideTimer;
let isPlaying = true;
const SLIDE_INTERVAL = 5000;

document.addEventListener('DOMContentLoaded', function() {
    showSlides(slideIndex);
    startAutoPlay();
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            plusSlides(-1);
        } else if (e.key === 'ArrowRight') {
            plusSlides(1);
        }
    });
    addTouchSupport();
    const slideshowContainer = document.querySelector('.slideshow');
    if (slideshowContainer) {
        slideshowContainer.addEventListener('mouseenter', function() {
            stopAutoPlay();
        });
        slideshowContainer.addEventListener('mouseleave', function() {
            startAutoPlay();
        });
    }
});

function plusSlides(n) {
    showSlides(slideIndex += n);
    resetAutoPlay();
}

function currentSlide(n) {
    showSlides(slideIndex = n);
    resetAutoPlay();
}

function showSlides(n) {
    let i;
    const slides = document.getElementsByClassName('slides');
    const dots = document.getElementsByClassName('dot');
    if (!slides.length || !dots.length) return;
    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';
        slides[i].classList.remove('active');
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].classList.remove('active');
    }
    slides[slideIndex - 1].style.display = 'block';
    setTimeout(() => {
        slides[slideIndex - 1].classList.add('active');
    }, 10);
    dots[slideIndex - 1].classList.add('active');
}

function startAutoPlay() {
    if (!isPlaying) {
        isPlaying = true;
        slideTimer = setInterval(function() {
            plusSlides(1);
        }, SLIDE_INTERVAL);
    }
}

function stopAutoPlay() {
    isPlaying = false;
    clearInterval(slideTimer);
}

function resetAutoPlay() {
    stopAutoPlay();
    startAutoPlay();
}

function addTouchSupport() {
    const slideshowContainer = document.querySelector('.slideshow');
    if (!slideshowContainer) return;
    let touchStartX = 0;
    let touchEndX = 0;
    const minSwipeDistance = 50;
    slideshowContainer.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });
    slideshowContainer.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });
    function handleSwipe() {
        const swipeDistance = touchEndX - touchStartX;
        if (Math.abs(swipeDistance) > minSwipeDistance) {
            if (swipeDistance > 0) {
                plusSlides(-1);
            } else {
                plusSlides(1);
            }
        }
    }
}

window.addEventListener('load', function() {
    const slides = document.getElementsByClassName('slides');
    for (let i = 0; i < slides.length; i++) {
        const img = slides[i].querySelector('img');
        if (img && img.complete) {
            img.classList.add('loaded');
        } else if (img) {
            img.addEventListener('load', function() {
                this.classList.add('loaded');
            });
        }
    }
});

document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
        stopAutoPlay();
    } else {
        startAutoPlay();
    }
});

function addSlideAnimations() {
    const slides = document.getElementsByClassName('slides');
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.animation = 'fadeIn 0.8s ease-in-out';
    }
}

addSlideAnimations();
