<template lang="pug">
.page__content   
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Наши работы')
    Warning(:text='data.description' v-if="data.description")
    .catalog__grid
      PortfolioCard(v-for='item in data.reveiws', :key='item.id', :data='item')
    .product-card__pagination(v-if='hasPagination')
      Pagination(:data='data.pagination')
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin],
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Наши работы',
          url: '/portfolio',
        },
      ]

      return breadcrumbs
    },
    hasPagination() {
      return (
        this.data.pagination.totalCount > this.data.pagination.defaultPageSize
      )
    },
  },
  watchQuery: true,
  async asyncData({ $axios, route }) {
    const data = await $axios.$get(`https://app.dom-sruba.ru/api/portfolios`, route.query)
    return { data }
  },
}
</script>