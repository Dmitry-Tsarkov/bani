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
export default {
  data() {
    return {}
  },
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
  // asyncData(context) {
  //   return context.$api.load('reviews')
  // },
  async asyncData({ $axios }) {
    const data = await $axios.$get(`http://app.bani-test.fvds.ru/api/reviews`)
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