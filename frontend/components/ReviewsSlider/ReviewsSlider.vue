<template lang="pug">
.reviews-slider
  p {{data}}
  .reviews-slider__container(ref='container')
    .reviews-slider__wrapper
      .reviews-slider__slide(v-for="slide in data" :key="slide.id")        
        .reviews-slider__content          
          p.reviews-slider__text {{slide.description}}
          p.reviews-slider__name {{slide.name}}
        .reviews-slider__cover
          img.reviews-slider__image(src='/img/main-slider.jpg')
    .reviews-slider__paginations 
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
    initReviewsSlider() {
      new Swiper(this.$refs.container, {
        wrapperClass: 'reviews-slider__wrapper',
        slideClass: 'reviews-slider__slide',
        speed: 300,
        pagination: {
          el: '.reviews-slider__paginations',
          type: 'bullets',
        },
      })
    },
  },
  mounted() {
    this.initReviewsSlider()
  },
}
</script>

<style lang='scss' >
@import '~swiper/swiper';
@import 'reviews-slider';
</style>