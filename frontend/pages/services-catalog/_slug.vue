<template lang="pug">
.page__content
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Услуги')
    .catalog__grid.no-margin
      CatalogCard(
        v-for='item in data.subcategories',
        :key='item.id',
        :data='item',
        page='services'
      )
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin],  
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Услуги',
        },
      ]

      return breadcrumbs
    },
  },
  // asyncData(context) {
  //   return context.$api.load('actions')
  // },
  async asyncData({ $axios, context, route }) {
    const data = await $axios.$get(
      `https://app.dom-sruba.ru/api/service-catalog/${route.params.slug}`,
      route.query
    )
    return { data }
  },
}
</script>