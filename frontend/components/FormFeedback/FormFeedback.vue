<template lang="pug">
  form.form-feedback(@submit.prevent='send' )
    .container
      .form-feedback__content
        .form-feedback__grid
          .form-feedback__item
            p.form-feedback__title ФИО
            input.form-feedback__input(type='text' placeholder='Иванов Иван Иванович' v-model='form.name')
          .form-feedback__item
            p.form-feedback__title E-mail
            input.form-feedback__input(type='email' placeholder='example@mail.ru' v-model='form.email')
          .form-feedback__item
            p.form-feedback__title Город
            input.form-feedback__input(type='text' v-model='form.city')
        .form-feedback__item
          p.form-feedback__title Комментарий
          textarea.form-feedback__input.textarea(type='text' v-model='form.comment')
        .form-feedback__checkbox
          Checkbox(v-model='form.checkbox')
        button.form-feedback__button Отправить
</template>

<script>
import { required, minLength } from 'vuelidate/lib/validators'
export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        city: '',
        comment: '',
        checkbox: '',
      },
    }
  },
  validations: {
    form: {
      name: {
        required,
        minLength: minLength(3),
      },
      email: {
        required,
        minLength: minLength(3),
      },
      city: {
        required,
        minLength: minLength(2),
      },      
      checkbox: {
        required,
      },
    },
  },
  methods: {
    send() {
      if (this.isLoading) {
        return
      }

      this.$v.$touch()
      if (this.$v.$invalid) {
        return
      }

      this.isLoading = true

      this.$api
        .post('faq/send', this.form)
        .then((data) => {
          
        })
        .catch((data) => {
          this.serverErrors = getErrors(data)
          this.error = getError(data)
        })
        .finally(() => {
          this.isLoading = false
          this.success = true
        })
    },
  },
}
</script>

<style src='./form-feedback.scss' lang="scss">

</style>