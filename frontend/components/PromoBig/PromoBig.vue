<template lang="pug">
  .promo-big
    img.promo-big__image(:src='data.image')
    .promo-big__content
      p.promo-big__text {{data.title}}
    p.promo-big__date {{data.date}}
</template>

<script>
export default {
  props: ['data']
}
</script>

<style src='./promo-big.scss' lang="scss">

</style>