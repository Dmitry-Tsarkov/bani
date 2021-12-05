<template lang="pug">
  .page__content    
    .container
      Section(title='Каталог Москва')
        //- Catalog(:data='data.catalog')
        p {{data}}
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
