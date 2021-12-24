<template lang="pug">
.page__content
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Услуги')
    .catalog__grid.no-margin
      CatalogCard(
        v-for='item in data.services',
        :key='item.id',
        :data='item',
        page='service'
      )
</template>

<script>
export default {
  data() {
    return {}
  },
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
      `https://app.dom-sruba.ru/api/services/${route.params.slug}`,
      route.query
    )
    return { data }
  },
}
</script>