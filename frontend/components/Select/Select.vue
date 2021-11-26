<template lang="pug">
  .select(v-click-outside='close')
    .select__head(@click='toggle' :class='{"focused": opened}')
      p.select__text(:class='{"grey": !selected}') {{selectedItem}}
      svg-icon.select__icon(name='chevron-down')
    .select__body(:class='{"active": opened}')
      .select__list
        .select__item(v-for="(item, index) in data" :key="index" :class='{"selected": activeIndex == index}' @click='selectItem(item.label, item.value, index)')
          p.select__text {{item.label}}
</template>

<script>
import ClickOutside from 'vue-click-outside'
export default {
  props: ['data'],
  data() {
    return {
      opened: false,
      selected: this.data[0].label,
      activeIndex: 0,
      value: null,
    }
  },
  computed: {
    selectedItem() {
      return this.selected ?? this.data[0].label
    }
  },
  methods: {
    toggle() {
      this.opened = !this.opened
    },
    selectItem(label, value, index) {
      this.selected = label
      this.opened = false
      this.activeIndex = index
      this.value = value      
    },
    close() {
      this.opened = false
    }
  },
  directives: {
    ClickOutside,
  },
}
</script>

<style lang="scss" src='./select.scss'>
</style>