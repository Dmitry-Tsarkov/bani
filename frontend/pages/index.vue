<template lang="pug">
  .page__content
    p {{data}}
    MainSlider
    .container
      Section(title='О компании')
        AboutMain
    PortfolioSlider
    .container
      Section(title='Преимущества')
        Advantages
      Section(title='Отзывы')
        ReviewsSlider
    .container-brown
      img.container-brown__smoke(src='/img/smoke.png')
      .container
        Section(title='Вопросы и ответы')
          Faq
    .container
      Section(title='Остались вопросы?')
        ContactsMain
</template>

<script>
export default {
  asyncData(context) {
    // return context.$api.load('actions')
    return context.$api.load('actions')
  },
}
</script>
