const initProductSlider = () => {
    const swiper = new Swiper('.product-detail__slider.swiper', {
        loop: true,
        navigation: {
            nextEl: '[data-slider-next]',
            prevEl: '[data-slider-prev]',
        },
    });

    return swiper;
}

export default initProductSlider;