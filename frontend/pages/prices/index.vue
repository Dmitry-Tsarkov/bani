<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Цены')
    .prices-page
      .prices-page__grid
        nuxt-link.prices-page__item(to='/prices/slug')
          img.prices-page__image(src='/img/prices.jpg')
          .prices-page__text Цены на срубы бань
        nuxt-link.prices-page__item(to='/prices/slug')
          img.prices-page__image(src='/img/prices.jpg')
          .prices-page__text Цены на срубы бань
      .prices-page__wysiwyg
        Wysiwyg(data='<p>Но диаграммы связей являются только методом политического участия и смешаны с не уникальными данными до степени совершенной неузнаваемости, из-за чего возрастает их статус бесполезности. Внезапно, независимые государства могут быть объявлены нарушающими общечеловеческие нормы этики и морали. Являясь всего лишь частью общей картины, некоторые особенности внутренней политики будут призваны к ответу.</p>')
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