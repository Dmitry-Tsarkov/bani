<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Регионы')
    Wysiwyg(:data='wysiwyg')
    Regions(:data='data.regions')
  FormFeedback
</template>

<script>
export default {
  data() {
    return {
      wysiwyg:
        'Качество лесоматериала считается одним из главных факторов добротности бревенчатых строений, поэтому мы предлагаем купить срубы из Псковской области, где лес из хвойных и лиственных пород деревьев характеризуется высоким качеством и износостойкостью. Имея небольшую влажность и высокую плотность, бревна дают минимальную усадку и отлично сохраняют тепло. Мы поставляем готовые конструкции в разобранном виде в населеные пункты Московской и Ленинградской областей, а также Орел, Тулу, Рязань, Ярославль, Калугу, Тверь, Брянск, Псков, Владимир, Курск, Смоленск и населенные пункты прилежащих областей. Все наши заказчики получают приятный бонус — первые 600 км доставки не оплачиваются.',
    }
  },
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Регионы',
        },
      ]

      return breadcrumbs
    },
  },
  // asyncData(context) {
  //   return context.$api.load('reviews')
  // },
  async asyncData({ $axios }) {
    const data = await $axios.$get(`https://app.bani-test.fvds.ru/api/regions`)
    return { data }
  },
}
</script>

