<template lang="pug">
label.radio(ref='label') <span class='radio__text'>{{text}}</span>
  input(type="radio" :value='value'  checked="checked" :name="name" @change='toggle')
  span.radio__checkmark
</template>

<script>
export default {
  props: ['value', 'text', 'name'],
  methods: {
    toggle(e) {
      this.$emit('change', this.$refs.label)
      this.$emit('input', e.target.value)
    },
  },
}
</script>





<style lang="scss" src='./radio.scss'>
</style>