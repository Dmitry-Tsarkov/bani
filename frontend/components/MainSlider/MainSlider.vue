<template lang="pug">
.main-slider
  .main-slider__container(ref='container')
    .main-slider__wrapper
      .main-slider__slide
        .container
          .main-slider__content
            .main-slider__box 
              h2.main-slider__title Базовый вектор развития даёт нам право принимать самостоятельные решения
              p.main-slider__subtitle Базовый вектор развития даёт нам право принимать самостоятельные решения
        img.main-slider__image(src='/img/main-slider.jpg') 
      .main-slider__slide
        .container
          .main-slider__content
            .main-slider__box 
              h2.main-slider__title Базовый вектор развития даёт нам право принимать самостоятельные решения
              p.main-slider__subtitle Базовый вектор развития даёт нам право принимать самостоятельные решения
        img.main-slider__image(src='/img/main-slider.jpg') 
    .main-slider__paginations 
</template>

<script>
import Swiper, {
  Navigation,
  Pagination,  
  Parallax,
  Autoplay,
} from 'swiper'
Swiper.use([Navigation, Pagination, Parallax, Autoplay])
export default {
  methods: {
    initMainSlider() {
      new Swiper(this.$refs.container, {
        wrapperClass: 'main-slider__wrapper',
        slideClass: 'main-slider__slide',
        // loop: true,
        // parallax: true,
        speed: 300,
        // autoplay: {
        //   delay: 5000,
        // },
        pagination: {
          el: '.main-slider__paginations',
          type: 'bullets',
        },
      })
    },
  },
  mounted() {
    this.initMainSlider()
  },
}
</script>

<style lang='scss' >
@import '~swiper/swiper';
@import 'main-slider';
</style>