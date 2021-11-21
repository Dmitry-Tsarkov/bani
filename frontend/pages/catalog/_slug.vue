<template lang="pug">
  .page__content    
    .container
      Section(title='Каталог')
        .catalog
          Warning  
          .catalog__grid
            CatalogCard(v-for="item in data.subcategories" :key="item.id" :data='item' page='products')
</template>

<script>
export default {  
  async asyncData({$axios, route}) {
    const data = await $axios.$get(`http://app.bani-test.fvds.ru/api/catalog/${route.params.slug}`, route.query)
    return { data }
  }
}
</script>