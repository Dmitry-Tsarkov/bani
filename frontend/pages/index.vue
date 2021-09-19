<template lang="pug">
  .page__content
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
export default {}
</script>
