<template lang="pug">
  form.form(@submit.prevent='send' v-if="!success")
    .form__item
      p.form__title ФИО
      input.form__input(type='text' placeholder='Иванов Иван Иванович' v-model='form.name' :class='{ error: errors.name }')
      span.error(v-if='errors.name') {{ errors.name }}
    .form__item
      p.form__title E-mail
      input.form__input(type='mail' placeholder='example@mail.ru' v-model='form.email' :class='{ error: errors.email }')
      span.error(v-if='errors.email') {{ errors.email }}
    .form__item
      p.form__title Номер телефона
      input.form__input(type='number' placeholder='+7-999-999-99-99' v-model='form.phone' :class='{ error: errors.phone }')
      span.error(v-if='errors.phone') {{ errors.phone }}
    .form__item
      p.form__title Комментарий
      textarea.form__input.textarea(type='text' v-model='form.description' :class='{ error: errors.description }')
      span.error(v-if='errors.description') {{ errors.description }}
    button.form__button Отправить
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
        phone: '',
        description: ''
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
      },
      phone: {
        required,
      },      
      description: {
        required,
      },
    },
  },
  computed: {
    errors() {
      let errors = {
        name: this.serverErrors['name'],
        email: this.serverErrors['email'],
        phone: this.serverErrors['phone'],
        description: this.serverErrors['description']
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

      if (this.$v.form.phone.$dirty) {
        if (!this.$v.form.phone.required) {
          errors.phone = 'Укажите телефон'
        }
      }      

      if (this.$v.form.description.$dirty) {
        if (!this.$v.form.description.required) {
          errors.description = 'Оставтье ваш вопрос'
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
        .post('https://app.dom-sruba.ru/api/question/send', this.form)
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

<style src='./form.scss' lang="scss">

</style>