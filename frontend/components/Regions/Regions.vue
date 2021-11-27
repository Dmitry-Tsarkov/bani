<template lang="pug">
.regions
  .regions__title Для просмотра доступных для заказа товаров выберите город доставки. 
  .regions__row
    .regions__select
      Select(:data='options')
    nuxt-link.regions__button(to='/regions/slug') Перейти
</template>

<script>
export default {
  data() {
    return {
      options: [
        {
          label: 'Тула',
          value: 'slug'
        },
        {
          label: 'Москва',
          value: 'slug'
        }
      ]
    }
  },
}
</script>





<style lang="scss" src='./regions.scss'>
</style>