<template lang="pug">
  .form
    .form__item
      p.form__title ФИО
      input.form__input(type='text' placeholder='Иванов Иван Иванович')
    .form__item
      p.form__title E-mail
      input.form__input(type='text' placeholder='example@mail.ru')
    .form__item
      p.form__title Номер телефона
      input.form__input(type='text' placeholder='+7-999-999-99-99')
    .form__item
      p.form__title Комментарий
      textarea.form__input.textarea(type='text' )
    button.form__button Отправить
</template>

<script>
export default {
  
}
</script>

<style src='./form.scss' lang="scss">

</style>