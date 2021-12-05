<template lang="pug">
.radio-options
  input.radio-options__price(type='number' :value="price")
  .calculator__option(v-for='(radio, index) in data', :key='index')
    Radio(
      :text='radio.value',
      :value='radio.price',
      :name='item.title',
      @change='setPrice(item.title, radio.price, index)'
    ) 
</template>

<script>
export default {
  props: ['data', 'item'],
  data() {
    return {
      selectedArray: [],
      price: this.data[0].price,
    }
  },
   methods: {
    addFilter(e) {
      this.$emit('change', this.$refs.label)
      this.$emit('input', e.target.checked)
    },
    setPrice(option, value, index) {
      setTimeout(() => {
        this.$nuxt.$emit('updatePrice')
      }, 100);

      this.price = value
    },
  },
}
</script>

<style lang="scss" src='./radio-options.scss'>
  
</style>