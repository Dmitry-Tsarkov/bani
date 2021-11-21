<template lang="pug">
.main-slider
  .main-slider__container(ref='container')
    .main-slider__wrapper
      .main-slider__slide(v-for="slide in data" :key="slide.id")
        .container
          .main-slider__content
            .main-slider__box 
              h2.main-slider__title {{slide.title}}
              p.main-slider__subtitle {{slide.description}}
        img.main-slider__image(:src='slide.image')       
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
  props: ['data'],
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