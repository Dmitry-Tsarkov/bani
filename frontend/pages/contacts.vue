<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Контакты')
    Contacts(:data='data')
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin],  
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Контакты',
        },
      ]

      return breadcrumbs
    },
  },
  async asyncData({ $axios }) {
    const data = await $axios.$get(`https://app.dom-sruba.ru/api/contacts`)
    return { data }
  },
}
</script>