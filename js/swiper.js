var swiper = new Swiper(".carrossel-produtos", {
  slidesPerView: 5,
  slidesPerGroup: 1,
  spaceBetween: 30,
  loop: true,
  loopFillGroupWithBlank: true,
  autoplay: {
    delay: 3000, 
    disableOnInteraction: false, 
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    1200: { slidesPerView: 5 },
    992: { slidesPerView: 4 },
    768: { slidesPerView: 3 },
    576: { slidesPerView: 2 },
    0:   { slidesPerView: 1 } 
  }
});