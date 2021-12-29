<template lang="pug">
  .warning 
    p.warning__text {{text}} 
</template>

<script>
export default {
  props: ['text']
}
</script>

<style src='./warning.scss' lang="scss">
</style>