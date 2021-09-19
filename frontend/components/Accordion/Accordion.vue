<template lang="pug">
  .accordion
    .accordion__head(@click="toogleDropdown")
      .accordion__header
        .accordion__title(:class='{"active": dropdownOpened}') {{data.question}}
      svg-icon.accordion__icon-shevron(name='chevron' :class='{"active": dropdownOpened}')
    .accordion__body(:class='{"active": dropdownOpened}')
      p.accordion__text(v-show-slide:500:example-easing="dropdownOpened") {{data.answer}}   
</template>

<script>
export default {
  props: ['data'],
  data() {
    return {
      dropdownOpened: false
    }
  },
  methods: {
    toogleDropdown() {
      this.dropdownOpened = !this.dropdownOpened
    }
  },
}
</script>

<style src='./accordion.scss' lang="scss">

</style>