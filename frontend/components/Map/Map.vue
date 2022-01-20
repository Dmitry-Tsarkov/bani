<template>
  <yandex-map style="width: 100%;" :coords="coords" :zoom="map.zoom" @click="onClick">
    <ymap-marker
      :coords="coords"
      marker-id="123"      
      :icon="markerIcon"
      
    />    
  </yandex-map>
  
</template>

<script>
export default {
  props: ['map'],
  data() {
    return {
      coords: this.map.coords,      
      markerIcon: {
        layout: 'default#image',
        // imageHref: '/icons/sauna.svg',
        // imageSize: [64, 64],
        // imageOffset: [-32, -64],        
        // contentOffset: [0, 15],        
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
    console.log(this.map);
  },
}
</script>