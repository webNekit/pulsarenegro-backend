const initBannerSlider = () => {
    const swiper = new Swiper('.banner__slider.swiper', {
      loop: true,
  
      // Navigation arrows
      navigation: {
        nextEl: '[data-slider-next]',
        prevEl: '[data-slider-prev]',
      },
    });
  
    return swiper;
  };
  
  export default initBannerSlider;