<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(:title='data.action.title')
    PromoBig(:data='data.action.card')
    Wysiwyg(:data='data.action.description', style='margin-top: 56px') 
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin],
  
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Акции',
          url: '/promotions',
        },
        {
          title: this.data.action.title,
        },
      ]

      return breadcrumbs
    },
  },  
  async asyncData({ $axios, route }) {
    const data = await $axios.$get(
      `https://app.dom-sruba.ru/api/actions/${route.params.slug}`,
      route.query
    )
    return { data }
  },
}
</script>