<template lang="pug">
  .product
    .product__container 
      .product__slider
        ProductSlider(:data='data.images')
      .product__specifications
        .product__specification
          p.product__value.big Цена:
          p.product__value {{data.price}} руб.        
        p.product__value.big(v-if="data.characteristics.length") Характеристики объекта:
        .product__characteristics(v-if="data.characteristics.length")
          .product__characteristic(v-for="characteristic in data.characteristics" :key="characteristic.id")
            p.product__name.black {{characteristic.characteristic}}
            p.product__value.black {{characteristic.value}} {{characteristic.unit}}        
        nuxt-link.product__button(:to='"/order/" + data.alias') Заказать
    //- .product__tabs
    //-   button(v-for="(tab, i) in data.kits" :key="i" type='button' @click='toggleTab(i)', :class='{ "active": index == i }').product__tab {{tab.title}} 
    .product__content
      .product__wysiwyg(v-if="data.description")
        Wysiwyg(:data='data.description')
      .product__wysiwyg.brown(v-if="data.bottom_description")
        Wysiwyg(:data='data.bottom_description' class='brown')
</template>

<script>
import { priceFormat } from '@/helpers/formatter'
export default {
  props: ['data'],
  // data() {
  //   return {
  //     index: 0,
  //     slider: {        
  //       images: ['/img/product.jpg', '/img/product.jpg', '/img/product.jpg'],
  //       thumbs: ['/img/thumb-1.jpg', '/img/thumb-2.jpg', '/img/thumb-3.jpg']
  //     }
  //   }
  // },
  // methods: {
  //   toggleTab(id) {
  //     this.index = id;      
  //   },
  // },
  // computed: {
  //   cost() {
  //     let array = []
  //     for (let i = 0; i < this.data.kits.length; i++) {
  //       array.push(priceFormat(this.data.kits[i].price))
        
  //     }
  //     return array
  //   },
  // }
}
</script>

<style src='./product.scss' lang="scss">
</style>