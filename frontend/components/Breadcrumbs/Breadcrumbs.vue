<template lang='pug'>
.breadcrumbs  
  ul.breadcrumbs__list
    li.breadcrumbs__item
      nuxt-link.breadcrumbs__link(:to='"/"') Главная
    li.breadcrumbs__item(v-for='(item, index) in data', :key='index')
      nuxt-link.breadcrumbs__link(v-if='item.url', :to='item.url') {{ item.title }}
      span.breadcrumbs__link.unactive(v-else) {{ item.title }}
</template>



<script>
export default {
  props: ['data'],
}
</script>

<style lang='scss' src='./breadcrumbs.scss'></style>