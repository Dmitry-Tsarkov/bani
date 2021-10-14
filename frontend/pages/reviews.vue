<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Отзывы')
  FormFeedback
  .container
    .reviews__list
      Review 
      Review 
      Review 
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