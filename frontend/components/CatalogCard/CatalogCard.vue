<template lang="pug">
  nuxt-link.catalog-card(to='/catalog/slug')
    .catalog-card__cover
      img.catalog-card__image(:src='data.image')
    .catalog-card__container
      p.catalog-card__title {{data.title}}
      p.catalog-card__text {{data.text}}   
</template>

<script>
export default {
  props: ['data']
}
</script>

<style src='./catalog-card.scss' lang="scss">

</style>