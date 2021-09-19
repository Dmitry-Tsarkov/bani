<template lang="pug">
  .contacts-main
    p.contacts-main__text Свяжитесь с нами любым удобным способом, указанным ниже или оставьте свои контактные данные, и наш менеджер свяжется с вами в течение 15 минут для уточнения информации.  
    .contacts-main__content
      .contacts-main__conatcts
        .contacts-main__list
          p.contacts-main__text.black +7 (999) 999-99-99
          p.contacts-main__text.black E-mail:	info@srubimbanu.ru
          p.contacts-main__text.black Skype:	srubimbanu
          p.contacts-main__text.black Viber:	+7 (903) 173-173-5
          p.contacts-main__text.black WhatsApp:	+7 (903) 173-173-5
        Map
      .contacts-main__form
        Form
</template>

<script>
export default {
  props: ['data'],
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

<style src='./contacts-main.scss' lang="scss">

</style>