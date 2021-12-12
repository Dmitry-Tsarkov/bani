<template lang="pug">
  .select(v-click-outside='close')
    input.select__price(type='number' :value='price')
    .select__head(@click='toggle' :class='{"focused": opened}')
      p.select__text(:class='{"grey": !selected}') {{selectedItem}}
      svg-icon.select__icon(name='chevron-down')
    .select__body(:class='{"active": opened}')
      .select__list
        .select__item(v-for="(item, index) in data" :key="index" :class='{"selected": activeIndex == index}' @click='selectItem(item.value, item.price, index)' )
          p.select__text {{item.value}}
    nuxt-link.select__button(v-if="regions" :to='"/regions/" + price') Перейти
</template>

<script>
import ClickOutside from 'vue-click-outside'
export default {
  props: ['data', 'regions'],
  data() {
    return {
      opened: false,
      selected: '',
      activeIndex: 0,
      price: '',
    }
  },
  computed: {
    selectedItem() {
      return this.selected ?? this.data[0].value
    }
  },
  methods: {
    toggle() {
      this.opened = !this.opened
    },
    selectItem(value, price, index) {
      this.selected = value
      this.opened = false
      this.activeIndex = index
      this.price = price
      setTimeout(() => {
        this.$nuxt.$emit('updatePrice')
      }, 100);       
         
    },
    close() {
      this.opened = false
    }
  },
  directives: {
    ClickOutside,
  },
  mounted() {
    setTimeout(() => {
      this.selected = this.data[0].value,
      this.price = this.data[0].price
      this.$nuxt.$emit('updatePrice')
    }, 100)
  },
}
</script>

<style lang="scss" src='../Select/select.scss'>
</style>