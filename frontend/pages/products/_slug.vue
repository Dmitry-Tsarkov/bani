<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(:title='data.title')
    Warning(:text='data.description' v-if="data.description")
    .product-card__list
      ProductCard(
        v-for='item in data.products',
        :key='item.id',
        :product='item'
      )
    //- .product-card__pagination(v-if='hasPagination')
    //-   Pagination(:data='data.pagination')
    .page__seo-text(v-if="data.bottom_description" v-html='data.bottom_description')
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
          title: this.data.title,
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
      `https://app.dom-sruba.ru/api/products/${route.params.slug}`,
      route.query
    )
    return { data }
  },
}
</script>