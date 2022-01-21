<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Политика конфиденциальности') 
    Wysiwyg(:data='data.page.content') 
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin],  
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: this.data.page.title,
        },
      ]

      return breadcrumbs
    },
  },

  async asyncData({ $axios }) {
    const data = await $axios.$get(`https://app.dom-sruba.ru/api/pages/policy`)
    return { data }
  },  
}
</script>