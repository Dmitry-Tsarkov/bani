<template lang="pug">
.header
  .container
    .header__content
      Logo
      Nav
      a.header__phone(v-for="item in data.phone" :key="item.id" :href='"tel: "+ item') {{item}}      
</template>

<script>
export default {
  props: ['data'],
  data() {
    return {
      text: 'Header',
    }
  },
}
</script>

<style src='./header.scss' lang="scss">

</style>