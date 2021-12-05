<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Цены на срубы бань')
    PricePage
  FormFeedback        
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
          url: '/prices'          
        },        
        {
          title: 'Цены на срубы бань',          
        }        
      ]

      return breadcrumbs
    },    
  },
  watchQuery: true,
  // asyncData(context) {
  //   return context.$api.load(
  //     `categories/${context.route.params.slug}`,
  //     context.route.query
  //   )
  // },
}
</script>

<style lang="scss">
  .prices-page {
    &__grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 128px;
    }

    &__item {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    &__image {
      border-radius: 15px;
    }

    &__text {
      font-size: 24px;
      line-height: 31px;
      color: $brown;
    }

    &__wysiwyg {
      margin-top: 40px;
    }
  }
</style>