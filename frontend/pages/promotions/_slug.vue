<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Компенсаторы усадки В ПОДАРОК!')
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
}
</script>