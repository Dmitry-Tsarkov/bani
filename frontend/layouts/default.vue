<template lang='pug'>
.page    
  header.page__header
    Header(:data='data.header')
  main.page__body
    Nuxt
  footer.page__footer
    Footer(:data='data.footer')
</template>

<script>

export default {  
  data() {
    return {
      data: []
    }
  },
  async fetch() {
    this.data = await fetch(
        'http://app.bani-test.fvds.ru/api/layout'
      ).then(res => res.json())
  },

  
}
</script>