<template lang="pug">
  .about-main
    img.about-main__image(:src='data.image')
    .about-main__content
      p.about-main__text {{data.text}}
</template>

<script>
export default {
  props: ['data']
}
</script>

<style src='./about-main.scss' lang="scss">

</style>