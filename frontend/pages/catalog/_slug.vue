<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Section(title='Каталог')
      .catalog
        Warning 
        .catalog__grid
          CatalogCard(
            v-for='item in data.subcategories',
            :key='item.id',
            :data='item',
            page='products'
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
          title: 'Каталог',
          url: '/catalog',
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
      `https://app.dom-sruba.ru/api/catalog/${route.params.slug}`,
      route.query
    )
    return { data }
  },
}
</script>