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
  // async asyncData({$axios}) {
  //   const data = await $axios.$get(`http://app.bani-test.fvds.ru/api/catalog`)
  //   return { data }
  // }
}
</script>
