<template lang="pug">
.page__content 
  MainSlider(:data='data.slider')
  .container
    Section(title='О компании')
      AboutMain(:data='data.about')
  PortfolioSlider(:data='data.portfolio' v-if="data.portfolio.length")
  .container
    Section(title='Преимущества')
      Advantages(:data='data.advantages')
    Section(title='Отзывы' v-if="data.reviews.length")
      ReviewsSlider(:data='data.reviews')
  .container-brown(v-if="data.faq.length")
    img.container-brown__smoke(src='/img/smoke.png')
    .container
      Section(title='Вопросы и ответы' class='brown')
        Faq(:data='data.faq')
  .container
    Section(title='Остались вопросы?')
      ContactsMain(:data='data.contacts' :map='data.map')
</template>

<script>
import pageMixin from '@/helpers/pageMixin'
export default {
  mixins: [pageMixin],
  async asyncData({ $axios }) {
    const data = await $axios.$get(`https://app.dom-sruba.ru/api/home`)
    return { data }
  },
}
</script>
