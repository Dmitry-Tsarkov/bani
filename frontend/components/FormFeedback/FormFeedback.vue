<template lang="pug">
  .form-feedback
    .container
      .form-feedback__content
        .form-feedback__grid
          .form-feedback__item
            p.form-feedback__title ФИО
            input.form-feedback__input(type='text' placeholder='Иванов Иван Иванович')
          .form-feedback__item
            p.form-feedback__title E-mail
            input.form-feedback__input(type='email' placeholder='example@mail.ru')
          .form-feedback__item
            p.form-feedback__title Город
            input.form-feedback__input(type='text')
        .form-feedback__item
          p.form-feedback__title Комментарий
          textarea.form-feedback__input.textarea(type='text' )
        .form-feedback__checkbox
          Checkbox
        button.form-feedback__button Отправить
</template>

<script>
export default {
  
}
</script>

<style src='./form-feedback.scss' lang="scss">

</style>