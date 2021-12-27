<template lang="pug">
nuxt-link.product-card(:to='"/product/" + product.alias')
  .product-card__cover
    img.product-card__image(:src='product.image')
  .product-card__container
    p.product-card__title {{ product.title }}
    p.product-card__text {{ product.description }}
    p.product-card__title {{ product.price_type }} {{ cost }} руб. 
    button.product-card__button Рассчитать стоимость 
</template>

<script>
import { priceFormat } from '@/helpers/formatter'
export default {
  props: ['product'],
  computed: {
    cost() {
      return priceFormat(this.product.price)
    },
  }
}
</script>

<style src='./product-card.scss' lang="scss">
</style>