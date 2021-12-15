<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Политика конфиденциальности') 
    Wysiwyg(:data='policy')   
</template>

<script>
export default {
  data() {
    return {     
      policy: '<h2>Политика конфиденциальности</h2>'
    }
  },
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Политика конфиденциальности',          
        }        
      ]

      return breadcrumbs
    },
    
  },
  
  // async asyncData({$axios, context, route}) {
  //   const data = await $axios.$get(`http://app.bani-test.fvds.ru/api/service/${route.params.slug}`, route.query)
  //   return { data }
  // }
  
}
</script>