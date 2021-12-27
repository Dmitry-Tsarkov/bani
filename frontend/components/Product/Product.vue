<template lang="pug">
  .product    
    p asddasd {{cost}}
    .product__container 
      .product__slider
        ProductSlider(:data='data.images')
      .product__specifications
        .product__specification(v-for="(price, index) in data.kits" :key="index")
          p.product__name {{price.title}}
          p.product__value {{price.price_type}} {{cost[index]}} руб.        
        p.product__value.big Характеристики объекта:
        .product__characteristics
          .product__characteristic(v-for="characteristic in data.characteristics" :key="characteristic.id")
            p.product__name.black {{characteristic.characteristic}}
            p.product__value.black {{characteristic.value}} {{characteristic.unit}}        
        nuxt-link.product__button(:to='"/order/" + data.alias') Рассчитать стоимость
    .product__tabs
      button(v-for="(tab, i) in data.kits" :key="i" type='button' @click='toggleTab(i)', :class='{ "active": index == i }').product__tab {{tab.title}} 
    .product__content(v-if="data.kits.length")
      .product__wysiwyg(v-if="data.kits[index].text")
        Wysiwyg(:data='data.kits[index].text')
      .product__wysiwyg.brown(v-if="data.kits[index].bottom_text")
        Wysiwyg(:data='data.kits[index].bottom_text' class='brown')
</template>

<script>
import { priceFormat } from '@/helpers/formatter'
export default {
  props: ['data'],
  data() {
    return {
      index: 0,
      slider: {        
        images: ['/img/product.jpg', '/img/product.jpg', '/img/product.jpg'],
        thumbs: ['/img/thumb-1.jpg', '/img/thumb-2.jpg', '/img/thumb-3.jpg']
      }
    }
  },
  methods: {
    toggleTab(id) {
      this.index = id;      
    },
  },
  computed: {
    cost() {
      let array = []
      for (let i = 0; i < this.data.kits.length; i++) {
        array.push(priceFormat(this.data.kits[i].price))
        
      }
      return array
    },
  }
}
</script>

<style src='./product.scss' lang="scss">
</style>