<template lang="pug">
  .page__content    
    .container
      Section(title='Каталог')
        Catalog(:data='data')
</template>

<script>
export default {
  asyncData(context) {
    return context.$api.load('catalog')
  },
}
</script>
