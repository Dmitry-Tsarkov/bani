<template lang="pug">
.page__content.dark 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Акции')
    Promotions(:data='data.actions') 
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin],  
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Акции',
        },
      ]

      return breadcrumbs
    },
  },  
  async asyncData({ $axios }) {
    const data = await $axios.$get(`https://app.dom-sruba.ru/api/actions`)
    return { data }
  },
}
</script>