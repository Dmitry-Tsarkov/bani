<template lang="pug">
.page__content.dark 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Акции')
    Promotions     
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
          title: 'Акции',
        },        
      ]

      return breadcrumbs
    },
  },
}
</script>