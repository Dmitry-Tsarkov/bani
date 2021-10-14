<template>
  <yandex-map style="width: 543px;" :coords="coords" :zoom="10" @click="onClick">
    <ymap-marker
      :coords="coords"
      marker-id="123"      
      :icon="markerIcon"
      :balloon-template="balloonTemplate"
    />
  </yandex-map>
</template>

<script>
export default {
  props: ['map'],
  data() {
    return {
      // coords: this.map.coords,
      coords: [54.82896654088406, 39.831893822753904],
      markerIcon: {
        layout: 'default#image',
        // imageHref: '/icons/oval.svg',
        imageSize: [64, 64],
        imageOffset: [-32, -64],        
        contentOffset: [0, 15],        
      },
    }
  },
  computed: {
    balloonTemplate() {
      return `
        <h2 class="map__title">444</h2>
        <p>I am here: ${this.coords}</p>
      `
    }
  },
  methods: {
    onClick(e) {
      this.coords = e.get('coords')
    },
  },
  mounted() {
    console.log(1231)
  },
}
</script>