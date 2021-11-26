<template lang="pug">
nuxt-link.product-card(:to='"/product/" + product.alias')
  .product-card__cover
    img.product-card__image(:src='product.image')
  .product-card__container
    p.product-card__title {{ product.title }}
    p.product-card__text {{ product.description }}
    p.product-card__title {{ product.price_type }} {{ product.price }} руб. 
    button.product-card__button Рассчитать стоимость 
</template>

<script>
export default {
  props: ['product']
}
</script>

<style src='./product-card.scss' lang="scss">
</style>