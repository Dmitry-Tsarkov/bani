<template lang="pug">
  .review
    p.review__text {{review.description}}
    p.review__name {{review.name}}
    p.review__location {{review.city}}
    p.review__date {{review.created_at}}
</template>

<script>
export default {
  props: ['review'],  
}
</script>

<style src='./review.scss' lang="scss">

</style>