<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(:title='data.title')
    Wysiwyg(:data='data.description') 
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin],  
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Портфолио',
          url: '/portfolio',
        },
        {
          title: 'Цены на срубы бань',
        },
      ]

      return breadcrumbs
    },
  },
  watchQuery: true,
  async asyncData({ $axios, route }) {
    const data = await $axios.$get(
      `https://app.dom-sruba.ru/api/portfolios/${route.params.slug}`,
      route.query
    )
    return { data }
  },
}
</script>
