<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Отзывы')
  FormFeedback
  .container
    .reviews__list
      Review(
        v-for='review in data.reviews',
        :key='review.id',
        :review='review'
      )
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin],  
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Отзывы',
        },
      ]

      return breadcrumbs
    },
  },
  async asyncData({ $axios }) {
    const data = await $axios.$get(`https://app.dom-sruba.ru/api/reviews`)
    return { data }
  },
}
</script>

<style lang="scss">
.reviews {
  &__list {
    display: flex;
    flex-direction: column;
    gap: 32px;
    padding-top: 56px;
  }
}
</style>