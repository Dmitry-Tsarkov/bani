<template lang="pug">
  .footer
    .container
      .footer__content
        .footer__left
          h2.footer__title Свяжитесь с нами
          nuxt-link.footer__text(to='/policy') Политика конфиденциальности
        .footer__container
          a.footer__text(v-for="phone in data.contacts.phone" :key="phone.id" :href='"tel:" + phone') {{phone}}
          a.footer__text(href='mailto:poznanie@mail.ru') poznanie@mail.ru
          p.footer__text.unlinked Мы в социальных сетях
          .footer__socials
            a.footer__social(href='/')
              img(src='/icons/facebook.svg')
            a.footer__social(href='/')
              img(src='/icons/telegram.svg')
            a.footer__social(href='/')
              img(src='/icons/instagram.svg')
</template>

<script>
export default {
  props: ['data']
}
</script>



<style src='./footer.scss' lang="scss">

</style>