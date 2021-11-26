<template lang="pug">
.page__content 
  .container    
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Цены на срубы бань')
    Calculator
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
          title: 'Цены',
          url: '/prices',
        },
        {
          title: 'Цены на срубы бань',
        }
      ]

      return breadcrumbs
    },
  },  
}
</script>