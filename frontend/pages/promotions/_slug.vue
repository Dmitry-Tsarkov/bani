<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Компенсаторы усадки В ПОДАРОК!')
    PromoBig(:data='data.action.card')    
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
  asyncData(context) {
    
    return context.$api.load(
      `actions/${context.route.params.slug}`
    )
  },
}
</script>