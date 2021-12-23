<template lang="pug">
.page__content.dark 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Акции')
    Promotions(:data='data.actions') 
</template>

<script>
export default {
  data() {
    return {}
  },
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Акции',
        },
      ]

      return breadcrumbs
    },
  },
  // asyncData(context) {
  //   return context.$api.load('actions')
  // },
  async asyncData({ $axios }) {
    const data = await $axios.$get(`http://app.bani-test.fvds.ru/api/actions`)
    return { data }
  },
}
</script>