<template lang="pug">
  nuxt-link.portfolio-card(:to='"/portfolio/" + data.alias')
    .portfolio-card__cover
      img.portfolio-card__image(:src='data.image')
    .portfolio-card__container
      p.portfolio-card__title {{data.title}}
      p.portfolio-card__text {{data.description}}
      //- p.portfolio-card__price от {{data.price}} руб.
      //- nuxt-link.portfolio-card__button(to='/portfolio/slug') Просмотреть
</template>

<script>
export default {
  props: ['data']
}
</script>

<style src='./portfolio-card.scss' lang="scss">

</style>