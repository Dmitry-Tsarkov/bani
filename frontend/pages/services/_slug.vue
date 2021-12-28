<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(:title='data.product.title') 
    Wysiwyg(:data='data.product.description')
    .page__service-page
      nuxt-link.product-card__button(:to='"/order-service/" + data.product.alias') Заказать  
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
      `https://app.dom-sruba.ru/api/service/${route.params.slug}`,
      route.query
    )
    return { data }
  },
}
</script>