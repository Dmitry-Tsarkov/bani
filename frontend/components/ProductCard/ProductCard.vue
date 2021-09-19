<template lang="pug">
nuxt-link.product-card(to='/catalog/slug')
  .product-card__cover
    img.product-card__image(:src='data.image')
  .product-card__container
    p.product-card__title {{ data.title }}
    p.product-card__text {{ data.text }}
    p.product-card__title от 263 000 руб. 
    button.product-card__button Рассчитать стоимость 
</template>

<script>
export default {
  props: ['data']
}
</script>

<style src='./product-card.scss' lang="scss">
</style>