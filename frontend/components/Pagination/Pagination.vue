<template lang='pug'>
.paginate
  paginate(
    v-model='page',
    :page-range='5',
    :page-count='pageCount',
    :click-handler='togglePage',
    :prev-text='"Предыдущая"',
    :next-text='"Следущая"',
    container-class='pagination',
    page-class='pagination__item',
    page-link-class='pagination__link',
    prev-class='pagination__button prev',
    next-class='pagination__button'
  )
</template>

<script>
export default {
  props: ['data'],
  data() {
    return {
      page: +this.$route.query.page || 1,
      pageCount: 1,
    }
  },
  mounted() {
    let pageSize = +this.$route.query['per-page'] || this.data.defaultPageSize
    this.pageCount = Math.ceil(this.data.totalCount / pageSize)
  },
  watch: {
    $route(to, from) {
      this.page = +to.query.page || 1
    },
  },
  methods: {
    togglePage(page) {      
      this.$router.push({
        query: {
          ...this.$route.query,
          page,
        },
      })
    },
  },
}
</script>

<style lang='scss' src='./pagination.scss'></style>