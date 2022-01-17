<template lang='pug'>
img.logo(src='/img/logo-2.png' v-if="path == '/'")
nuxt-link.logo(v-else to='/')
  img.logo(src='/img/logo-2.png')
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