<template lang='pug'>
.logo( v-if="path == '/'")
nuxt-link.logo(v-else to='/')
  .logo
</template>

<script>
export default {
  
  computed: {
    path() {
      return this.$route.fullPath
    },
  }
}
</script>

<style lang='scss' src='./logo.scss'></style>