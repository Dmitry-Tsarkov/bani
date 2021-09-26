<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Баня 3*3 м с выносом')
    Product     
</template>

<script>
export default {
  data() {
    return {
      
    }
  },
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Каталог',
          url: '/catalog',
        },
        {
          title: 'Проекты бань',
          url: '/catalog/slug',
        },
        {
          title: 'Баня 3*3 м с выносом'
        },
      ]

      return breadcrumbs
    },
  },
}
</script>