<template lang="pug">
.page__content 
  .container
    Section(:title='data.region.city') 
      Wysiwyg(:data='data.region.content')
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin],  
  async asyncData({ $axios, route }) {
    const data = await $axios.$get(
      `https://app.dom-sruba.ru/api/regions/${route.params.slug}`,
      route.query
    )
    return { data }
  },
}
</script>
