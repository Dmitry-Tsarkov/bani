<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(:title='data.product.title') 
    Wysiwyg(:data='data.product.description') 
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
          url: '/services',
        },
        {
          title: 'Отделка сруба',
        },
      ]

      return breadcrumbs
    },
    // hasPagination() {
    //   return (
    //     this.data.pagination.totalCount > this.data.pagination.defaultPageSize
    //   )
    // },
  },
  watchQuery: true,
  async asyncData({ $axios, context, route }) {
    const data = await $axios.$get(
      `https://app.bani-test.fvds.ru/api/service/${route.params.slug}`,
      route.query
    )
    return { data }
  },
}
</script>