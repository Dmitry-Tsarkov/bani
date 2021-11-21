<template lang="pug">
  .page__content    
    MainSlider
    .container
      Section(title='О компании')
        AboutMain
    PortfolioSlider(:data='data.portfolio')
    .container
      Section(title='Преимущества')
        Advantages
      Section(title='Отзывы')
        ReviewsSlider(:data='data.reviews')
    .container-brown
      img.container-brown__smoke(src='/img/smoke.png')
      .container
        Section(title='Вопросы и ответы')
          Faq(:data='data.faq')
    .container
      Section(title='Остались вопросы?')
        ContactsMain
</template>

<script>
export default {
  async asyncData({$axios}) {
    const data = await $axios.$get(`http://app.bani-test.fvds.ru/api/home`)
    return { data }
  }
}
</script>
