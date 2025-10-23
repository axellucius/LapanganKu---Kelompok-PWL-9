document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper === 'undefined') {
        return;
    }
    const swiper = new Swiper('.mySwiper', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        speed: 800,
        loop: true,
        keyboard: {
            enabled: true,
            onlyInViewport: true,
        },
        mousewheel: {
            invert: false,
            sensitivity: 1,
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
                coverflowEffect: {
                    rotate: 30,
                    depth: 80,
                }
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 30,
                coverflowEffect: {
                    rotate: 40,
                    depth: 90,
                }
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 40,
                coverflowEffect: {
                    rotate: 50,
                    depth: 100,
                }
            },
        },
        on: {
            init: function() {
                addCustomAnimations();
            },
            slideChange: function() {
                animateActiveSlide(this);
            },
        },
    });

    function animateActiveSlide(swiperInstance) {
        const activeSlide = swiperInstance.slides[swiperInstance.activeIndex];
        if (activeSlide) {
            activeSlide.style.transform += ' scale(1.05)';
            setTimeout(() => {
                activeSlide.style.transform = activeSlide.style.transform.replace(' scale(1.05)', '');
            }, 300);
        }
    }

    function addCustomAnimations() {
        const slides = document.querySelectorAll('.swiper-slide');
        slides.forEach((slide, index) => {
            slide.style.opacity = '0';
            slide.style.animation = `fadeInUp 0.6s ease-out ${index * 0.1}s forwards`;
        });
    }

    const reviewSection = document.querySelector('.review-pengunjung');
    if (reviewSection) {
        reviewSection.addEventListener('mouseenter', function() {
            swiper.autoplay.stop();
        });
        reviewSection.addEventListener('mouseleave', function() {
            swiper.autoplay.start();
        });
    }

    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            swiper.autoplay.stop();
        } else {
            swiper.autoplay.start();
        }
    });

    const swiperSlides = document.querySelectorAll('.swiper-slide');
    swiperSlides.forEach(slide => {
        slide.addEventListener('touchstart', function() {
            this.style.transform += ' scale(0.95)';
        });
        slide.addEventListener('touchend', function() {
            this.style.transform = this.style.transform.replace(' scale(0.95)', '');
        });
    });
});

const style = document.createElement('style');
style.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .swiper-slide {
        transition: all 0.3s ease;
    }
    .swiper-slide-active {
        z-index: 2;
    }
`;
document.head.appendChild(style);
