<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Контакты')
    Contacts(:data='data')
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