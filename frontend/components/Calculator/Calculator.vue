<template lang='pug'>
.calculator
  .calculator__head
    Wysiwyg(:data='data.description')
  .calculator__body 
    .calculator__item(v-for='(item, i) in data.characteristics', :key='i')
      p.calculator__title {{ item.title }}
      .calculator__options(v-if='item.type == 2') 
        RadioOptions(:data='item.values', :item='item') 
      .calculator__options(v-if='item.type == 1') 
        SelectPrice(:data='item.values') 
  .calculator__total 
    p.calculator__title Приблизительная стоимость бани, согласно выбранных вами параметров, составляет:
    h2.calculator__price {{ price }} руб.
</template>



<script>
export default {
  props: ['data'],
  data() {
    return {
      selectedArray: [],
      price: null,
      array: [
        {
          title: 'Комплект',
          order: 1,
          radios: [
            {
              title: 'Базовый',
              name: 'Комплект',
              value: 500,
            },
            {
              title: 'На пустой участок',
              name: 'Комплект',
              value: 500,
            },
            {
              title: 'Расширенный',
              name: 'Комплект',
              value: 500,
            },
          ],
        },
        {
          title: 'Количество этажей',
          order: 2,
          radios: [
            {
              title: 'Одноэтажный',
              name: 'Количество этажей',
              value: 1,
            },
            {
              title: 'Двухэтажный',
              name: 'Количество этажей',
              value: 2,
            },
          ],
        },
        {
          title: 'Количество этажей',
          order: 3,
          options: [
            {
              label: '3х3',
              value: 1,
            },
            {
              label: '3х4',
              value: 2,
            },
            {
              label: '3х3',
              value: 1,
            },
            {
              label: '3х4',
              value: 2,
            },
          ],
        },
        {
          title: 'Количество этажей',
          order: 2,
          radios: [
            {
              title: 'Одноэтажный',
              name: 'Количество этажей',
              value: 1,
            },
            {
              title: 'Двухэтажный',
              name: 'Количество этажей',
              value: 2,
            },
          ],
        },
        {
          title: 'Количество этажей',
          order: 3,
          options: [
            {
              label: '3х3',
              value: 1,
            },
            {
              label: '3х4',
              value: 2,
            },
            {
              label: '3х3',
              value: 1,
            },
            {
              label: '3х4',
              value: 2,
            },
          ],
        },
        {
          title: 'Количество этажей',
          order: 2,
          radios: [
            {
              title: 'Одноэтажный',
              name: 'Количество этажей',
              value: 1,
            },
            {
              title: 'Двухэтажный',
              name: 'Количество этажей',
              value: 2,
            },
          ],
        },
      ],
    }
  },
  computed: {
    radioOptions() {
      let array = []
      this.data.characteristics.forEach((element) => {
        if (element.type == 2) {
          array.push({ label: element, value: element })
        }
      })
      return array
    },
    selectOptions() {
      let array = []
      this.data.characteristics.forEach((element) => {
        if (element.type == 1) {
          array.push({ label: element.value, value: element.type })
        }
      })
      return array
    },
    totalPrice() {
      // let arrayRadio = document.querySelectorAll('.select__price')
      // let arraySelect = document.querySelectorAll('.radio-options__price')
      // for (let i = 0; i < arrayRadio.length; i++) {
      //   const element = arrayRadio[i];
      // }
    },
  },
  methods: {
    update() {
      let arrayRadio = document.querySelectorAll('.select__price')
      let arraySelect = document.querySelectorAll('.radio-options__price')

      let array = []
      for (let j = 0; j < arrayRadio.length; j++) {
        array.push(Number(arrayRadio[j].value))        
      }      
      for (let z = 0; z < arraySelect.length; z++) {
        array.push(Number(arraySelect[z].value))        
      }    
      console.log(array);  
      let s = 0
      for (let i = 0; i < array.length; i++) {
        s += array[i]
      }

      this.price = s
      console.log(s);
    },
    addFilter(e) {
      this.$emit('change', this.$refs.label)
      this.$emit('input', e.target.checked)
    },
    setPrice(option, value, index) {
      if (this.selectedArray.length) {
        // for (let i = 0; i < selectedArray.length; i++) {
        //   if (this.selectedArray.includes(option)) {
        //   this.selectedArray.splice(option, 1)
        //   // items[index].classList.remove('selected')
        // } else {
        //   // items[index].classList.add('selected')
        //   this.selectedArray.push(value)
        // }
        // }
      } else {
        // items[index].classList.add('selected')
        this.selectedArray.push({ '`${option}`': value })
      }

      this.price = value
    },
  },
  mounted() {
    this.$nuxt.$on('updatePrice', this.update)
    this.update()
    let arrayRadio = document.querySelectorAll('.select__price')
    let arraySelect = document.querySelectorAll('.radio-options__price')
    for (let i = 0; i < arrayRadio.length; i++) {
      const element = arrayRadio[i]
      console.log(element.innerHTML)
    }
  },
}
</script>

<style lang='scss' src='./calculator.scss'></style>