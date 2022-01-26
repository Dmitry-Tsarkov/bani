<template lang="pug">
  .contacts
    .contacts__grid
      .contacts__list        
        .contacts__item(v-if="data.company_name")
          p.contacts__name Название компании:
          p.contacts__value {{data.company_name}}      
        .contacts__item(v-if="data.legal_address")
          p.contacts__name Адрес:
          p.contacts__value {{data.legal_address}}              
        .contacts__item(v-if="data.contacts.phone")
          p.contacts__name Телефон:
          .contacts__value(v-for="item in data.contacts.phone" :key="item.id") {{item}} <br>       
        .contacts__item(v-if="data.contacts.email.length")
          p.contacts__name E-mail:	
          p.contacts__value(v-for="item in data.contacts.email" :key="item.id") {{item}} <br>       
        .contacts__item(v-if="data.contacts.skype.length")
          p.contacts__name Skype:
          p.contacts__value(v-for="item in data.contacts.skype" :key="item.id") {{item}} <br> 
        .contacts__item(v-if="data.contacts.viber.length")
          p.contacts__name Viber:
          p.contacts__value(v-for="item in data.contacts.viber" :key="item.id") {{item}} <br> 
        .contacts__item(v-if="data.contacts.whatsapp.length")
          p.contacts__name WhatsApp:	
          p.contacts__value(v-for="item in data.contacts.whatsapp" :key="item.id") {{item}} <br> 
      .contacts__list
        .contacts__item(v-if="data.operator_working_hours")
          p.contacts__name Режим работы оператора:
          p.contacts__value {{data.operator_working_hours}}    
        .contacts__item(v-if="data.office_working_hours")
          p.contacts__name Режим работы офисов:
          p.contacts__value {{data.office_working_hours}}
        .contacts__item(v-if="data.denomination")
          p.contacts__name Наименование
          p.contacts__value {{data.denomination}}
        .contacts__item(v-if="data.tin")
          p.contacts__name ИНН:
          p.contacts__value {{data.tin}}
        .contacts__item(v-if="data.checkpoint")
          p.contacts__name КПП:
          p.contacts__value {{data.checkpoint}}
        .contacts__item(v-if="data.psrn")
          p.contacts__name ОГРН:
          p.contacts__value {{data.psrn}}
        .contacts__item(v-if="data.rcbo")
          p.contacts__name ОКПО:
          p.contacts__value {{data.rcbo}}
    .contacts__map      
      Map(:map='data.map')
</template>

<script>
export default {
  props: ['data'],
  data() {
    return {
      dropdownOpened: false,     
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