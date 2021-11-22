<template lang="pug">
.portfolio-slider
  img.container-brown__smoke(src='/img/smoke.png')
  .container
    h2.portfolio-slider__title Наши работы  
    .portfolio-slider__container(ref='container')
      .portfolio-slider__wrapper 
        .portfolio-slider__slide(v-for="slide in data" :key="slide.id")
          nuxt-link(:to='"/portfolio/" + slide.alias')
            img.portfolio-slider__image(:src='slide.image') 
      .portfolio-slider__button
        nuxt-link.portfolio-slider__link(to='/portfolio') Смотреть все
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
  props: ['data'],
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