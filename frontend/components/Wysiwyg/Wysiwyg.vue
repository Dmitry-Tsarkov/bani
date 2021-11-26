<template lang="pug">
.wysiwyg(v-html="data")
  p {{data}}
</template>

<script>
export default {
  props: ['data']
}
</script>

<style src='./wysiwyg.scss' lang="scss">

</style>