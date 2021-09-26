<template lang="pug">
.portfolio-slider
  img.container-brown__smoke(src='/img/smoke.png')
  .container
    h2.portfolio-slider__title Наши работы  
    .portfolio-slider__container(ref='container')
      .portfolio-slider__wrapper 
        .portfolio-slider__slide
          img.portfolio-slider__image(src='/img/portfolio-1.jpg')
        .portfolio-slider__slide
          img.portfolio-slider__image(src='/img/portfolio-2.jpg')
        .portfolio-slider__slide
          img.portfolio-slider__image(src='/img/portfolio-3.jpg')
        .portfolio-slider__slide
          img.portfolio-slider__image(src='/img/portfolio-1.jpg')
      .portfolio-slider__button
        nuxt-link.portfolio-slider__link(to='/') Смотреть все
    .portfolio-slider__controls
      button(type='button' title='Предыдущий слайд' ref="prev").portfolio-slider__prev
        img.portfolio-slider__icon.prev(src='/icons/chevron.svg')
      button(type='button' title='Следующий слайд' ref="next").portfolio-slider__next
        img.portfolio-slider__icon(src='/icons/chevron.svg')
      
</template>

<script>
import Swiper, { Navigation } from 'swiper'
Swiper.use(Navigation)
export default {
  methods: {
    initSolutionsSlider() {
      this.swiper = new Swiper(this.$refs.container, {
        wrapperClass: 'portfolio-slider__wrapper',
        slideClass: 'portfolio-slider__slide',
        loop: true,
        spaceBetween: 38,
        slidesPerView: 3,
        navigation: {
          nextEl: this.$refs.next,
          prevEl: this.$refs.prev,
        },
      })
    },
  },
  mounted() {
    this.initSolutionsSlider()
  },
}
</script>

<style src='./portfolio-slider.scss' lang="scss">
</style>