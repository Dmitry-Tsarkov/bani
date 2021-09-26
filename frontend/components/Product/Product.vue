<template lang="pug">
  .product
    .product__container
      .product__slider
        ProductSlider(:data='slider')
      .product__specifications
        .product__specification
          p.product__name Цена комплекта «Базовый»
          p.product__value от 263 000 руб.
        .product__specification
          p.product__name Цена комплекта «Базовый»
          p.product__value от 263 000 руб.
        .product__specification
          p.product__name Цена комплекта «Базовый»
          p.product__value от 263 000 руб.
        .product__specification
          p.product__name Цена комплекта «Базовый»
          p.product__value от 263 000 руб.
        p.product__value.big Характеристики объекта:
        .product__characteristics
          .productt__characteristic
            p.product__name.black Площадь 
            p.product__value.black 9 м²
          .productt__characteristic
            p.product__name.black Площадь 
            p.product__value.black 9 м²
          .productt__characteristic
            p.product__name.black Площадь 
            p.product__value.black 9 м²
          .productt__characteristic
            p.product__name.black Площадь 
            p.product__value.black 9 м²
        button.product__button Рассчитать стоимость
    .product__tabs
      button(type='button' @click='toggleTab(1)', :class='{ "active": tab == 1 }').product__tab «Базовый»
      button(type='button' @click='toggleTab(2)', :class='{ "active": tab == 2 }').product__tab «На пустой участок»
      button(type='button' @click='toggleTab(3)', :class='{ "active": tab == 3 }').product__tab «Расширенный»
      button(type='button' @click='toggleTab(3)', :class='{ "active": tab == 4 }').product__tab Дополнительные услуги
    .product__content(v-if='tab == 1')
      .product__wysiwyg
        h2 Комплект «Базовый» без предоплаты
        p Ниже представлен тот недорогой минимальный комплект для бани, который можно заказать, понимая, что по технологии сруб должен до отделки дать усадку, а для этого потребуется не менее года. После того, как он высохнет, вы сможете насладиться творческим процессом выбора отделочных материалов и оборудования для вашей бани.
        p В комплекте нет ничего лишнего:
        ul
          li Сруб пятистенок с внутренним протесом стен (рубка угла «в лапу»).
          li Диаметр бревна не менее 22 см. Обычно средний диаметр 24–26 см.
      .product__wysiwyg.brown
        p Обратите внимание, что комплект «Базовый» — это сруб бани без фундамента. Цена его выгодно отличается от стоимости «Расширенного» и «На пустой участок», но перед тем, как заказать его, нужно заранее подготовить ленточный, свайный или столбчатый фундамент соответствующих размеров.
        p Там, где указана веранда, к комплекту добавляется каркас веранды, который включает:
        ul
          li Сруб пятистенок с внутренним протесом стен (рубка угла «в лапу»).
          li Диаметр бревна не менее 22 см. Обычно средний диаметр 24–26 см.

</template>

<script>
export default {
  data() {
    return {
      tab: 1,
      slider: {        
        images: ['/img/product.jpg', '/img/product.jpg', '/img/product.jpg'],
        thumbs: ['/img/thumb-1.jpg', '/img/thumb-2.jpg', '/img/thumb-3.jpg']
      }
    }
  },
  methods: {
    toggleTab(id) {
      this.tab = id;
    },
  },
}
</script>

<style src='./product.scss' lang="scss">
</style>