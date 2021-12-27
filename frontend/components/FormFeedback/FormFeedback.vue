<template lang="pug">
  form.form-feedback(@submit.prevent='send' v-if="!success")
    .container
      .form-feedback__content
        .form-feedback__grid
          .form-feedback__item
            p.form-feedback__title ФИО
            input.form-feedback__input(type='text' placeholder='Иванов Иван Иванович' v-model='form.name' :class='{ error: errors.name }')
            span.error(v-if='errors.name') {{ errors.name }}
          .form-feedback__item
            p.form-feedback__title E-mail
            input.form-feedback__input(type='email' placeholder='example@mail.ru' v-model='form.email' :class='{ error: errors.email }')
            span.error(v-if='errors.email') {{ errors.email }}
          .form-feedback__item
            p.form-feedback__title Город
            input.form-feedback__input(type='text' v-model='form.city' :class='{ error: errors.city }')
            span.error(v-if='errors.city') {{ errors.city }}
        .form-feedback__item
          p.form-feedback__title Комментарий
          textarea.form-feedback__input.textarea(type='text' v-model='form.description' :class='{ error: errors.description }')
          span.error(v-if='errors.description') {{ errors.description }}
        .form-feedback__checkbox
          Checkbox(v-model='form.checkbox' label='Я даю свое согласите на обработку персональных данных')
          span.error(v-if='errors.checkbox') {{ errors.checkbox }}
        button.form-feedback__button Отправить
  .form-feedback(v-else)
    .container
      .form-feedback__success
        p.form-feedback__title.success Отзыв успешно оставлен!
</template>

<script>
import { required, minLength } from 'vuelidate/lib/validators'
import { getError, getErrors } from '@/helpers/errors'
export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        city: '',
        description: '',
        checkbox: '',
      },
      success: false,
      serverErrors: {},
      error: '',
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
      description: {
        required,
        minLength: minLength(2),
      },      
      checkbox: {
        required,
      },
    },
  },
  computed: {
    errors() {
      let errors = {
        name: this.serverErrors['name'],
        email: this.serverErrors['email'],
        city: this.serverErrors['city'],
        description: this.serverErrors['description'],
        checkbox: '',
      }

      if (this.$v.form.name.$dirty) {
        if (!this.$v.form.name.required) {
          errors.name = 'Укажите имя'
        }
        if (!this.$v.form.name.minLength) {
          errors.name = 'Минимум 3 символа'
        }
      }

      if (this.$v.form.email.$dirty) {
        if (!this.$v.form.email.required) {
          errors.email = 'Укажите email'
        }        
      }

      if (this.$v.form.city.$dirty) {
        if (!this.$v.form.city.required) {
          errors.city = 'Укажите город'
        }
        if (!this.$v.form.city.minLength) {
          errors.city = 'Минимум 3 символа'
        }
      }      

      if (this.$v.form.description.$dirty) {
        if (!this.$v.form.description.required) {
          errors.description = 'Оставтье комментарий'
        }
        if (!this.$v.form.description.minLength) {
          errors.description = 'Минимум 3 символа'
        }
      }      

      if (this.$v.form.checkbox.$dirty) {
        if (!this.$v.form.checkbox.required) {
          errors.checkbox = 'Примите условия'
        }
      }

      return errors
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

      this.$axios
        .post('https://app.dom-sruba.ru/api/reviews/send', this.form)
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