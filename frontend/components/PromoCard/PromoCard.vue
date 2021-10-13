<template lang="pug">
  .promo-card
    img.promo-card__image(src='/img/promo-card.jpg')
    p.promo-card__title.absolute Скидки для пенсионеров!
    .promo-card__container
      .promo-card__content
        p.promo-card__date 01.10.2021 г. 
        p.promo-card__title Скидки для пенсионеров!
      button.promo-card__button Подробнее
    
</template>

<script>
export default {
  props: ['data']
}
</script>

<style src='./promo-card.scss' lang="scss">

</style>