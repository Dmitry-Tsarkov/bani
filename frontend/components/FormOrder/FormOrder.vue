<template lang="pug">
  .form-order
    .container(v-if="!success")
      .form-order__content
        .form-order__top-input
          .form-order__item
            p.form-order__title Наименование товара
            input.form-order__input(type='text' placeholder='Баня 3*3 с выносом')        
        .form-order__grid
          .form-order__item
            p.form-order__title ФИО
            input.form-order__input(type='text' placeholder='Иванов Иван Иванович')
          .form-order__item
            p.form-order__title E-mail
            input.form-order__input(type='email' placeholder='example@mail.ru')
          .form-order__item
            p.form-order__title Телефон
            input.form-order__input(type='phone' placeholder='+7 (999) 999 -99-99')        
        .form-order__advanced
          p.form-order__title Дополнительные параметры
          .form-order__list
            Radio(text='Сруб из осины' name='111')
            Radio(text='Дополнительный венец (вырубка + 20 см)' name='111')
            Radio(text='Веранда 2 м (по короткой стороне)' name='111')
            Radio(text='Веранда 2 м (по длинной стороне)' name='222')
            Radio(text='Двухскатная, мансардная крыша с коньком 3,5-4,0 м	' name='222')
            Radio(text='Ломаная крыша с коньком высотой 3,5-4,0 метра, высота потолков на мансарде 2,2-2,5 метра' name='222')
        .form-order__advanced
          p.form-order__title Комментарий
          textarea.form-order__input.textarea(type='text' )
        .form-order__checkbox
          Checkbox
        button.form-order__button(@click='send') Отправить
    .form-order__content(v-if="success")
      p.form-order__text Наш менеджер свяжется с вами в ближайшее время для согласования заказа.
      nuxt-link.form-order__button.return(to='/catalog') Вернуться в каталог 
</template>

<script>
export default {
  data() {
    return {
      success: false
    }
  },
  methods: {
    send() {
      this.success = true
    }
  },
}
</script>

<style src='./form-order.scss' lang="scss">

</style>