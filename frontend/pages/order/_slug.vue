<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Форма заказа')
    FormOrder
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
          title: 'Форма заказа',         
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
}
</script>