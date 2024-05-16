var swiper = new Swiper(".mySwiper", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
  coverflowEffect: {
    rotate: 10,
    stretch: 0,
    depth: 200,
    modifier: 1.5,
    slideShadows: true,
  },
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});
