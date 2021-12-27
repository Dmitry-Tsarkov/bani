<template lang="pug">
.page__content 
  .container 
    Breadcrumbs(:data='breadcrumbs')
    Headline(:title='data.product.title')
    Product(:data='data.product') 
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
          title: 'Проекты бань',
          url: '/catalog/slug',
        },
        {
          title: 'Баня 3*3 м с выносом',
        },
      ]

      return breadcrumbs
    },
  },
  // mounted() {
  //   this.breadcrumbs = [
  //     {
  //       title: 'Каталог',
  //       url: '/catalog',
  //     },
  //   ]

  //   for (let item in this.data.breadcrumbs) {
  //     this.breadcrumbs.push({
  //       title: this.data.breadcrumbs[item].title,
  //       url: '/catalog/' + this.data.breadcrumbs[item].alias,
  //     })
  //   }

  //   this.breadcrumbs.push({
  //     title: this.data.product.title,
  //   })
  // },
  // asyncData(context) {
  //   return context.$api.load(
  //     `products/${context.route.params.slug}`,
  //     context.route.query
  //   )
  // },
  async asyncData({ $axios, route }) {
    const data = await $axios.$get(
      `https://app.dom-sruba.ru/api/product/${route.params.slug}`,
      route.query
    )
    return { data }
  },
}
</script>