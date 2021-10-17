<template lang="pug">
  .contacts
    .contacts__grid
      .contacts__list
        .contacts__item
          p.contacts__name Название компании:
          p.contacts__value «Срубимбаню»      
        .contacts__item
          p.contacts__name Офис в Москве:	
          p.contacts__value 119027, г. Москва, Киевское шоссе, строение 2, корп. «Г», каб. № 308-Г (БП «Румянцево»)   
        .contacts__item
          p.contacts__name Офис в СПб:	
          p.contacts__value 197348, г. Санкт-Петербург, Коломяжский проспект, д. 10-Д, 3-й этаж
        .contacts__item
          p.contacts__name Телефон:
          .contacts__value +7 (958) 111-02-43 <br> +7 (903) 73-173-5 <br> +7 (812) 987-11-10
        .contacts__item
          p.contacts__name Срубы в регионах:
          p.contacts__value +7 (958) 111-02-43 <br> +7 (903) 73-173-5
        .contacts__item
          p.contacts__name E-mail:	
          p.contacts__value info@srubimbanu.ru
        .contacts__item
          p.contacts__name Skype:
          p.contacts__value srubimbanu
        .contacts__item
          p.contacts__name Viber:
          p.contacts__value +7 (903) 173-173-5
        .contacts__item
          p.contacts__name WhatsApp:	
          p.contacts__value +7 (903) 173-173-5
      .contacts__list
        .contacts__item
          p.contacts__name Режим работы оператора:
          p.contacts__value Телефоны доступны для связи ежедневно с 8:00 до 22:00. Если номер находится вне зоны действия сети - оставьте нам сообщение и мы свяжемся с вами в ближайшее время.    
        .contacts__item
          p.contacts__name Режим работы офисов:
          p.contacts__value ПН - ПТ, с 10:00 до 20:00 по предварительной договоренности, т.к. менеджер может находиться на выезде
        .contacts__item
          p.contacts__name Наименование
          p.contacts__value Общество с ограниченной ответственностью "ПРОГРЕСС 2009"
        .contacts__item
          p.contacts__name ИНН:
          p.contacts__value 6701005784
        .contacts__item
          p.contacts__name КПП:
          p.contacts__value 670101001
        .contacts__item
          p.contacts__name ОГРН:
          p.contacts__value 1096713000273
        .contacts__item
          p.contacts__name ОКПО:
          p.contacts__value 72858987
        .contacts__item
          p.contacts__name Юридический адрес:
          p.contacts__value 216291, Смоленская область, Велижский район, гор. Велиж, улица Куриленко, д. 11-А
    .contacts__map      
      Map      
</template>

<script>
export default {
  props: ['data'],
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

<style src='./contacts.scss' lang="scss">

</style>