<template lang="pug">
  .promo-big
    img.promo-big__image(:src='data.image')
    .promo-big__content
      p.promo-big__text Оформи заказ до 31.10.2021 и получи скидку  10%
      button.promo-big__button Подробнее
    p.promo-big__date 01.10.2021 г. 
</template>

<script>
export default {
  props: ['data']
}
</script>

<style src='./promo-big.scss' lang="scss">

</style>