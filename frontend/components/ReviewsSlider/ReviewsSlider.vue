<template lang="pug">
.reviews-slider
  .reviews-slider__container(ref='container')
    .reviews-slider__wrapper
      .reviews-slider__slide        
        .reviews-slider__content          
          p.reviews-slider__text Также как высококачественный прототип будущего проекта выявляет срочную потребность кластеризации усилий. Задача организации, в особенности же высококачественный прототип будущего проекта способствует подготовке и реализации поэтапного и последовательного развития общества. А ещё стремящиеся вытеснить традиционное производство, нанотехнологии формируют глобальную экономическую сеть и при этом -  разоблачены. Каждый из нас понимает очевидную вещь: реализация намеченных плановых заданий говорит о возможностях новых предложений. Банальные, но неопровержимые выводы, а также диаграммы связей лишь добавляют фракционных разногласий и указаны как претенденты на роль ключевых факторов.
          p.reviews-slider__name Виталий
        .reviews-slider__cover
          img.reviews-slider__image(src='/img/main-slider.jpg')       
      .reviews-slider__slide        
        .reviews-slider__content          
          p.reviews-slider__text Также как высококачественный прототип будущего проекта выявляет срочную потребность кластеризации усилий. Задача организации, в особенности же высококачественный прототип будущего проекта способствует подготовке и реализации поэтапного и последовательного развития общества. А ещё стремящиеся вытеснить традиционное производство, нанотехнологии формируют глобальную экономическую сеть и при этом -  разоблачены. Каждый из нас понимает очевидную вещь: реализация намеченных плановых заданий говорит о возможностях новых предложений. Банальные, но неопровержимые выводы, а также диаграммы связей лишь добавляют фракционных разногласий и указаны как претенденты на роль ключевых факторов.
          p.reviews-slider__name Виталий
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