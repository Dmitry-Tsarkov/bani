<template lang='pug'>
section.section
  h2.section__title(v-if="title") {{ title }}      
  .section__body
    slot 
</template>

<script>
export default {
  props: ['title'],
}

</script>

<style lang='scss' src='./section.scss'></style>
