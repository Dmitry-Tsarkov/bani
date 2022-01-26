<template lang="pug">
.header
  .container
    .header__content
      Logo
      Nav
      a.header__phone(v-if="data.phone" :href='"tel: "+ data.phone[0]') {{data.phone[0]}}      
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