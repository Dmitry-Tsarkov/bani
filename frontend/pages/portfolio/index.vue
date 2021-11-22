<template lang="pug">
.page__content 
  .container
    Breadcrumbs(:data='breadcrumbs')
    Headline(title='Наши работы')
    Warning
    .catalog__grid
      PortfolioCard(v-for="item in data.reveiws" :key="item.id" :data='item')
    .product-card__pagination(v-if='hasPagination')
      Pagination(:data='data.pagination')
</template>

<script>
export default {
  data() {
    return {
      portfolio: [
        {
          image: '/img/portfolio-card.jpg',
          title: 'Баня 3*3 м с выносом',
          price: "263 000",
          text: 'Принимая во внимание показатели успешности, консультация с широким активом способствует повышению качества экспериментов, поражающих по своей масштабности и грандиозности.',
        },        
        {
          image: '/img/portfolio-card.jpg',
          title: 'Баня 3*3 м с выносом',
          price: "263 000",
          text: 'Принимая во внимание показатели успешности, консультация с широким активом способствует повышению качества экспериментов, поражающих по своей масштабности и грандиозности.',
        },        
        {
          image: '/img/portfolio-card.jpg',
          title: 'Баня 3*3 м с выносом',
          price: "263 000",
          text: 'Принимая во внимание показатели успешности, консультация с широким активом способствует повышению качества экспериментов, поражающих по своей масштабности и грандиозности.',
        },        
        {
          image: '/img/portfolio-card.jpg',
          title: 'Баня 3*3 м с выносом',
          price: "263 000",
          text: 'Принимая во внимание показатели успешности, консультация с широким активом способствует повышению качества экспериментов, поражающих по своей масштабности и грандиозности.',
        },        
        {
          image: '/img/portfolio-card.jpg',
          title: 'Баня 3*3 м с выносом',
          price: "263 000",
          text: 'Принимая во внимание показатели успешности, консультация с широким активом способствует повышению качества экспериментов, поражающих по своей масштабности и грандиозности.',
        },        
        {
          image: '/img/portfolio-card.jpg',
          title: 'Баня 3*3 м с выносом',
          price: "263 000",
          text: 'Принимая во внимание показатели успешности, консультация с широким активом способствует повышению качества экспериментов, поражающих по своей масштабности и грандиозности.',
        },        
        {
          image: '/img/portfolio-card.jpg',
          title: 'Баня 3*3 м с выносом',
          price: "263 000",
          text: 'Принимая во внимание показатели успешности, консультация с широким активом способствует повышению качества экспериментов, поражающих по своей масштабности и грандиозности.',
        },        
        {
          image: '/img/portfolio-card.jpg',
          title: 'Баня 3*3 м с выносом',
          price: "263 000",
          text: 'Принимая во внимание показатели успешности, консультация с широким активом способствует повышению качества экспериментов, поражающих по своей масштабности и грандиозности.',
        },        
      ],
    }
  },
  computed: {
    breadcrumbs() {
      let breadcrumbs = [
        {
          title: 'Наши работы',
          url: '/portfolio',
        },        
      ]

      return breadcrumbs
    },
    hasPagination() {
      return (
        this.data.pagination.totalCount > this.data.pagination.defaultPageSize
      )
    },
  },
  async asyncData({$axios}) {
    const data = await $axios.$get(`http://app.bani-test.fvds.ru/api/portfolios`)
    return { data }
  }
}
</script>