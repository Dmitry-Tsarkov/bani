<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Форма заказа')
    FormOrder(:data='data') 
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
          title: 'Форма заказа',
        },
      ]

      return breadcrumbs
    },
  },
  async asyncData({ $axios, context, route }) {
    const data = await $axios.$get(
      `https://app.dom-sruba.ru/api/product-order/${route.params.slug}`,
      route.query
    )
    return { data }
  },
  // asyncData(context) {

  //   return context.$api.load(
  //     `actions/${context.route.params.slug}`
  //   )
  // },product-order/<alias>
}
</script>