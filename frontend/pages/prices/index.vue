<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Цены')
    .prices-page
      .prices-page__grid
        nuxt-link.prices-page__item(
          :to='"/prices/" + item.id',
          v-for='item in data.calculators',
          :key='item.id'
        )
          img.prices-page__image(:src='item.image')
          .prices-page__text {{ item.title }}
      .prices-page__wysiwyg
        Wysiwyg(:data='data.description')
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin],  
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Цены',
        },
      ]

      return breadcrumbs
    },
  },
  watchQuery: true,
  async asyncData({ $axios }) {
    const data = await $axios.$get(`https://app.dom-sruba.ru/api/calculators`)
    return { data }
  },
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