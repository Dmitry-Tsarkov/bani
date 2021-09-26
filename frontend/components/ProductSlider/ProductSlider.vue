<template lang="pug">
.product-slider
  .product-slider__container(ref='container')
    .product-slider__wrapper 
      .product-slider__slide(v-for='item in data.images', :key='item.id')
        img.product-slider__img(:src='item')
  .product-slider__container.is-thumb(ref='thumbs')
    button(type='button' title='Предыдущий слайд' ref="prev").product-slider__prev
      img.product-slider__icon.prev(src='/icons/chevron-brown.svg')
    .product-slider__thumbs
      .product-slider__thumbs-slide(
        v-for='item in data.thumbs',
        :key='item.id'
      )
        img.product-slider__thumb-img(:src='item')
    button(type='button' title='Следующий слайд' ref="next").product-slider__next
      img.product-slider__icon(src='/icons/chevron-brown.svg')
      
      
</template>

<script>
import Swiper, {
  Navigation,Thumbs 
} from 'swiper'
Swiper.use([Navigation, Thumbs])
export default {
  props: ['data'],
  methods: {
    initSwiper() {
      new Swiper(this.$refs.container, {
        wrapperClass: 'product-slider__wrapper',
        slideClass: 'product-slider__slide',
        slidesPerView: 1,
        direction: 'horizontal',
        navigation: {
          nextEl: this.$refs.next,
          prevEl: this.$refs.prev,
        },
        thumbs: {
          swiper: new Swiper(this.$refs.thumbs, {
            wrapperClass: 'product-slider__thumbs',
            slideClass: 'product-slider__thumbs-slide',
            spaceBetween: 25,
            width: 240,
            direction: 'horizontal',
          }),
        },
      })
    },
  },
  mounted() {
    this.initSwiper()
  },
}
</script>

<style src='./product-slider.scss' lang="scss">
</style>