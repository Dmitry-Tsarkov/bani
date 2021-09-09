<template lang="pug">
.header
  .container
    .header__content
      Logo
      Nav
      a.header__phone(href="tel:+7(999)999-99-99") +7 (999) 999-99-99
</template>

<script>
export default {
  data() {
    return {
      text: 'Header',
    }
  },
}
</script>

<style src='./header.scss' lang="scss">

</style>