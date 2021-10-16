<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Баня 3*3 м с выносом')
    Product(:data='data')     
</template>

<script>
export default {
  data() {
    return {
      
    }
  },
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
          title: 'Баня 3*3 м с выносом'
        },
      ]

      return breadcrumbs
    },
  },
  asyncData(context) {
    return context.$api.load(
      `products/${context.route.params.slug}`,
      context.route.query
    )
  },
}
</script>