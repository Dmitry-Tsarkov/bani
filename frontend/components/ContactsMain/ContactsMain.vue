<template lang="pug">
  .contacts-main
    p.contacts-main__text Свяжитесь с нами любым удобным способом, указанным ниже или оставьте свои контактные данные, и наш менеджер свяжется с вами в течение 15 минут для уточнения информации.     
    .contacts-main__content
      .contacts-main__conatcts
        .contacts-main__list
          .contacts-main__list-item
            p.contacts-main__text.black Телефоны:	
            p.contacts-main__text.black(v-if="data.phone" v-for="item in data.phone" :key="item.id") {{item}}            
          .contacts-main__list-item(v-if="data.email.length")
            p.contacts-main__text.black E-mail:	
            p.contacts-main__text.black(v-for="item in data.email" :key="item.id") {{item}}
          .contacts-main__list-item(v-if="data.skype.length")
            p.contacts-main__text.black Skype:
            p.contacts-main__text.black(v-for="item in data.skype" :key="item.id") {{item}}
          .contacts-main__list-item(v-if="data.viber.length")
            p.contacts-main__text.black Viber:
            p.contacts-main__text.black(v-for="item in data.viber" :key="item.id") {{item}}
          .contacts-main__list-item(v-if="data.whatsapp.length")
            p.contacts-main__text.black Whatsapp:
            p.contacts-main__text.black(v-for="item in data.whatsapp" :key="item.id") {{item}}
        .contacts-main__map
          Map(:map='map')
      .contacts-main__form
        Form
</template>

<script>
export default {
  props: ['data', 'map'],
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