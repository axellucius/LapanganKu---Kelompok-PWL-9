var swiper = new Swiper(".mySwiper", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  spaceBetween: 40,
  loop: true,
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    depth: 150,
    modifier: 1,
    slideShadows: true,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  autoplay: {
    delay: 2500,             
    disableOnInteraction: false, 
  },
});