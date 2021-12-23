<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(:title='data.action.title')
    PromoBig(:data='data.action.card')
    Wysiwyg(:data='data.action.description', style='margin-top: 56px') 
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
          url: '/promotions',
        },
        {
          title: 'Компенсаторы усадки В ПОДАРОК!',
        },
      ]

      return breadcrumbs
    },
  },
  // asyncData(context) {

  //   return context.$api.load(
  //     `actions/${context.route.params.slug}`
  //   )
  // },
  async asyncData({ $axios, route }) {
    const data = await $axios.$get(
      `https://app.bani-test.fvds.ru/api/actions/${route.params.slug}`,
      route.query
    )
    return { data }
  },
}
</script>