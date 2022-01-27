<template lang="pug">
  .footer
    .container
      .footer__content
        .footer__left
          h2.footer__title Свяжитесь с нами
          nuxt-link.footer__text(to='/policy') Политика конфиденциальности
        .footer__container
          a.footer__text(v-if="data.contacts.phone" v-for="phone in data.contacts.phone" :key="phone.id" :href='"tel:" + phone') {{phone}}
          a.footer__text(v-if="data.contacts.email" v-for="email in data.contacts.email" :key="email.id" href=`mailto:${email}`) {{email}}
          //- p.footer__text.unlinked Мы в социальных сетях
          //- .footer__socials
          //-   a.footer__social(href='/')
          //-     img(src='/icons/facebook.svg')
          //-   a.footer__social(href='/')
          //-     img(src='/icons/telegram.svg')
          //-   a.footer__social(href='/')
          //-     img(src='/icons/instagram.svg')
</template>

<script>
export default {
  props: ['data']
}
</script>



<style src='./footer.scss' lang="scss">

</style>