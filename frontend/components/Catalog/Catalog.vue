<template lang="pug">
.catalog
  Warning  
  .catalog__grid
    CatalogCard(v-for="item in data.categories" :key="item.id" :data='item')
</template>

<script>
export default {
  props: ['data'],  
}
</script>

<style src='./catalog.scss' lang="scss">
</style>