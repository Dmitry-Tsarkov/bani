<template lang='pug'>
img.logo(src='/icons/logo.svg' v-if="path === '/'")
nuxt-link.logo(v-else to='/')
  img.logo(src='/logo.svg')
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