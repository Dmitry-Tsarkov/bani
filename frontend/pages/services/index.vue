<template lang="pug">
.page__content
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Услуги')
    .catalog__grid.no-margin
      CatalogCard(v-for="item in data.serviceCategories" :key="item.id" :data='item' page='services')
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
          title: 'Услуги',
        },        
      ]

      return breadcrumbs
    },
  },
  // asyncData(context) {
  //   return context.$api.load('actions')
  // },
  async asyncData({$axios}) {
    const data = await $axios.$get(`http://app.bani-test.fvds.ru/api/services-catalog`)
    return { data }
  }
}
</script>