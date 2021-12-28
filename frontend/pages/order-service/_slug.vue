<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Форма заказа')
    ServiceOrder(:data='data') 
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin],
  data() {
    return {}
  },
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Форма заказа',
        },
      ]

      return breadcrumbs
    },
  },
  async asyncData({ $axios, context, route }) {
    const data = await $axios.$get(
      `https://app.dom-sruba.ru/api/service-order/${route.params.slug}`,
      route.query
    )
    return { data }
  }, 
}
</script>