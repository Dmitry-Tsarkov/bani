<template lang="pug">
  .promo-card
    img.promo-card__image(:src='promo.image')
    p.promo-card__title.absolute {{promo.title}}
    .promo-card__container
      .promo-card__content
        p.promo-card__date {{promo.date}}
        p.promo-card__title {{promo.description}}
      nuxt-link.promo-card__button(:to='"promotions/" + promo.alias') Подробнее    
</template>

<script>
export default {
  props: ['promo']
}
</script>

<style src='./promo-card.scss' lang="scss">

</style>