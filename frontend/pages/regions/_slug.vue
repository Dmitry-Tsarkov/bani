<template lang="pug">
  .page__content    
    .container
      Section(:title='data.region.city')        
        Wysiwyg(:data='data.region.content')
</template>

<script>
export default {
  // asyncData(context) {
  //   return context.$api.load('catalog')
  // },
  async asyncData({$axios, route}) {
    const data = await $axios.$get(`http://app.bani-test.fvds.ru/api/regions/${route.params.slug}`, route.query)
    return { data }
  }
}
</script>
