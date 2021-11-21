<template lang="pug">
.faq
  .faq__list
    Accordion(v-for="item in data" :key="item.id" :data='item') 
</template>

<script>
export default {
  props: ['data'],  
}
</script>

<style src='./faq.scss' lang="scss">
</style>