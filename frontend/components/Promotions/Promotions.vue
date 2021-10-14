<template lang="pug">
  .promotions
    //- PromoBig
    .promotions__grid
      .promotions__item(v-for="item in data" :key="item.id")
        PromoCard(:promo='item')
</template>

<script>
export default {
  props: ['data']
}
</script>

<style src='./promotions.scss' lang="scss">

</style>