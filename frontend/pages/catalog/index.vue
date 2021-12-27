<template lang="pug">
.page__content 
  .container
    Section(title='Каталог')
      Catalog(:data='data.catalog')
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin],
  async asyncData({ $axios }) {
    const data = await $axios.$get(`https://app.dom-sruba.ru/api/catalog`)
    return { data }
  },
}
</script>
