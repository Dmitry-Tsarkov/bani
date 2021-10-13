<template lang="pug">
  .promotions
    PromoBig
    .promotions__grid
      .promotions__item
        PromoCard
      .promotions__item
        PromoCard
      .promotions__item
        PromoCard
</template>

<script>
export default {
  props: ['data']
}
</script>

<style src='./promotions.scss' lang="scss">

</style>