<template lang="pug">
.catalog
  Warning  
  .catalog__grid
    CatalogCard(v-for="item in data" :key="item.id" :data='item' page='catalog')
</template>

<script>
export default {
  props: ['data'],  
}
</script>

<style src='./catalog.scss' lang="scss">
</style>