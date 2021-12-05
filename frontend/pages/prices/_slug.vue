<template lang="pug">
.page__content 
  .container    
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Цены на срубы бань')
    Calculator(:data='data.calculator')
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
          title: 'Цены',
          url: '/prices',
        },
        {
          title: 'Цены на срубы бань',
        }
      ]

      return breadcrumbs
    },
  },  
  async asyncData({$axios, route}) {
    const data = await $axios.$get(`http://app.bani-test.fvds.ru/api/calculator/${route.params.slug}`, route.query)
    return { data }
  }
}
</script>