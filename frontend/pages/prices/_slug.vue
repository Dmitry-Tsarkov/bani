<template lang="pug">
.page__content 
  .container 
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Цены на срубы бань')
    Calculator(:data='data.calculator')
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin], 
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Цены',
          url: '/prices',
        },
        {
          title: 'Цены на срубы бань',
        },
      ]

      return breadcrumbs
    },
  },
  async asyncData({ $axios, route }) {
    const data = await $axios.$get(
      `https://app.dom-sruba.ru/api/calculators/${route.params.slug}`,
      route.query
    )
    return { data }
  },
}
</script>