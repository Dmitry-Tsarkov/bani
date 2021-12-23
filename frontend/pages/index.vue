<template lang="pug">
.page__content 
  MainSlider(:data='data.slider')
  .container
    Section(title='О компании')
      AboutMain(:data='data.about')
  PortfolioSlider(:data='data.portfolio')
  .container
    Section(title='Преимущества')
      Advantages(:data='data.advantages')
    Section(title='Отзывы')
      ReviewsSlider(:data='data.reviews')
  .container-brown
    img.container-brown__smoke(src='/img/smoke.png')
    .container
      Section(title='Вопросы и ответы')
        Faq(:data='data.faq')
  .container
    Section(title='Остались вопросы?')
      ContactsMain(:data='data.contacts')
</template>

<script>
export default {
  async asyncData({ $axios }) {
    const data = await $axios.$get(`https://app.bani-test.fvds.ru/api/home`)
    return { data }
  },
}
</script>
