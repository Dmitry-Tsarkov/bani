<template lang="pug">
.regions
  .regions__title Для просмотра доступных для заказа товаров выберите город доставки.
  .regions__row
    .regions__select
      Select(:data='regionsOptions' v-model="value" @change='log' regions='true')
    //- nuxt-link.regions__button(:to='"/regions/" + value') Перейти
</template>

<script>
export default {
  props: ['data'],
  data() {
    return {
      value: null
      // value: this.data[0].title_alias
    }
  },    
  computed: {
    regionsOptions() {
      let array = []
      this.data.forEach(element => {        
      array.push({'label': element.title, 'value': element.title_alias, 'sublabel': element.district})
      });
      return array
    }
  },
  mounted() {
    // this.$nuxt.$on('changeValue', this.value = value)
  },
}
</script>





<style lang="scss" src='./regions.scss'>
</style>