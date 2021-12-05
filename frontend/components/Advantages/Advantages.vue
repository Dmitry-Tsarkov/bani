<template lang='pug'>
.advantages
  p.advantages__text {{data.description}}
  .advantages__list
    .advantages__item
      img.advantages__icon(src='/icons/advantage-1.svg')
      p.advantages__text Многолетний опыт работы 
    .advantages__item
      img.advantages__icon(src='/icons/advantage-2.svg')
      p.advantages__text Нами были успешно выполнены более 1000 проектов
    .advantages__item
      img.advantages__icon(src='/icons/advantage-3.svg')
      p.advantages__text Сборка на месте в срок от 3 до 5 дней
    .advantages__item
      img.advantages__icon(src='/icons/advantage-4.svg')
      p.advantages__text В нашей команде работает 9 русских бригад
</template>

<script>
export default {
  props: ['data'],
  computed: {
    path() {
      return this.$route.fullPath
    },
  }
}
</script>

<style lang='scss' src='./advantages.scss'></style>