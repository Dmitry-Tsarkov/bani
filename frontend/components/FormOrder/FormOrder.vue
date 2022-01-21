<template lang="pug">
.form-order
  .container(v-if='!success')
    .form-order__content
      .form-order__top-input
        .form-order__item
          p.form-order__title Наименование товара
          input.form-order__input(
            type='text',
            :value='data.product.title',
            disabled
          ) 
      .form-order__grid
        .form-order__item
          p.form-order__title ФИО
          input.form-order__input(
            type='text',
            placeholder='Иванов Иван Иванович',
            v-model='form.name',
            :class='{ error: errors.name }'
          )
          span.error(v-if='errors.name') {{ errors.name }}
        .form-order__item
          p.form-order__title E-mail
          input.form-order__input(
            type='email',
            placeholder='example@mail.ru',
            v-model='form.email',
            :class='{ error: errors.email }'
          )
          span.error(v-if='errors.email') {{ errors.email }}
        .form-order__item
          p.form-order__title Телефон
          input.form-order__input(
            type='number',
            placeholder='+7 (999) 999 -99-99',
            v-model='form.phone',
            :class='{ error: errors.phone }'
          ) 
          span.error(v-if='errors.phone') {{ errors.phone }}
      //- .form-order__advanced
      //-   p.form-order__title Дополнительные параметры
      //-   .form-order__list
      //-     Checkbox(v-for="item in data.additional_params" :key="item.id" :label='item.title' class='js-order-checkbox')           
      .form-order__advanced
        p.form-order__title Комментарий
        textarea.form-order__input.textarea(
          type='text',
          v-model='form.comment'
        )
      .form-order__checkbox
        Checkbox(
          label='Я даю свое согласите на обработку персональных данных',
          v-model='form.checkbox'
        )
        span.error(v-if='errors.checkbox') {{ errors.checkbox }}
      button.form-order__button(@click='send') Отправить
  .form-order__content(v-if='success')
    p {{ additional_params }}
    p.form-order__text Наш менеджер свяжется с вами в ближайшее время для согласования заказа.
    nuxt-link.form-order__button.return(to='/catalog') Вернуться в каталог
</template>

<script>
import { required, minLength, maxLength, email } from 'vuelidate/lib/validators'
import { getError, getErrors } from '@/helpers/errors'
export default {
  props: ['data'],
  data() {
    return {
      form: {
        product_id: this.data.product.id,
        name: '',
        email: '',
        phone: '',
        comment: '',
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
        email,
      },
      phone: {
        required,
        minLength: minLength(11),
        maxLength: maxLength(11),
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
        phone: this.serverErrors['phone'],
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
        if (!this.$v.form.email.email) {
          errors.email = 'Укажите корректный email'
        }
      }

      if (this.$v.form.phone.$dirty) {
        if (!this.$v.form.phone.required) {
          errors.phone = 'Укажите телефон'
        }
        if (!this.$v.form.phone.minLength) {
          errors.phone = 'Укажите телефон (минимум 11 символов)'
        }
        if (!this.$v.form.phone.maxLength) {
          errors.phone = 'Максимум 11 символов'
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
      this.$v.$touch()
      if (this.$v.$invalid) {
        return
      }
      // let array = document.querySelectorAll('.js-order-checkbox')
      // array.forEach(element => {
      //   if (element.childNodes[0].checked) {
      //     this.form.additional_params.push(element.childNodes[1].innerHTML)
      //     console.log(this.form.additional_params);
      //   }

      // });
      this.$axios
        .post('https://app.dom-sruba.ru/api/order/send-product', this.form)
        .then((data) => {})
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

<style src='./form-order.scss' lang="scss">
</style>