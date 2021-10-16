<template lang="pug">
  .accordion-price
    .accordion-price__head(@click="toogleDropdown")
      .accordion-price__header
        .accordion-price__title(:class='{"active": dropdownOpened}') Цены на комплект «Базовый»
      svg-icon.accordion-price__icon-shevron(name='chevron' :class='{"active": dropdownOpened}')
    .accordion-price__body(:class='{"active": dropdownOpened}')
      .accordion-price__wysiwyg(v-show-slide:500:example-easing="dropdownOpened")
        Wysiwyg(data='<p>Но диаграммы связей являются только методом политического участия и смешаны с не уникальными данными до степени совершенной неузнаваемости, из-за чего возрастает их статус бесполезности. Внезапно, независимые государства могут быть объявлены нарушающими общечеловеческие нормы этики и морали. Являясь всего лишь частью общей картины, некоторые особенности внутренней политики будут призваны к ответу.</p>') 
</template>

<script>
export default {  
  data() {
    return {
      dropdownOpened: false
    }
  },
  methods: {
    toogleDropdown() {
      this.dropdownOpened = !this.dropdownOpened
    }
  },
}
</script>

<style src='./accordion-price.scss' lang="scss">

</style>