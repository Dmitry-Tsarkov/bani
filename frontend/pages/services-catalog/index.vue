<template lang="pug">
.page__content
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Услуги')
    .catalog__grid.no-margin
      CatalogCard(
        v-for='item in data.serviceCategories',
        :key='item.id',
        :data='item',
        page='services-catalog'
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
  async asyncData({ $axios }) {
    const data = await $axios.$get(
      `https://app.dom-sruba.ru/api/services-catalog`
    )
    return { data }
  },
}
</script>