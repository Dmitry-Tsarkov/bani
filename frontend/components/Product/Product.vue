<template lang="pug">
  .product
    .product__container
      .product__slider
        ProductSlider(:data='data.products[index].images')
      .product__specifications
        .product__specification(v-for="price in data.prices" :key="price.id")
          p.product__name {{price.title}}
          p.product__value {{price.price_type}} {{price.price}} руб.        
        p.product__value.big Характеристики объекта:
        .product__characteristics
          .product__characteristic(v-for="characteristic in data.products[index].characteristics" :key="characteristic.id")
            p.product__name.black {{characteristic.characteristic}}
            p.product__value.black {{characteristic.value}} {{characteristic.unit}}        
        button.product__button Рассчитать стоимость
    .product__tabs
      button(v-for="(tab, i) in data.products" :key="i" type='button' @click='toggleTab(i)', :class='{ "active": index == i }').product__tab {{tab.title}}      
    .product__content(v-for="(city, j) in data.products" :key="j" v-if="index == j")
      .product__wysiwyg
        Wysiwyg(:data='data.products[index].description')
      .product__wysiwyg.brown
        Wysiwyg(:data='data.products[index].bottom_description' class='brown')
</template>

<script>
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
}
</script>

<style src='./product.scss' lang="scss">
</style>