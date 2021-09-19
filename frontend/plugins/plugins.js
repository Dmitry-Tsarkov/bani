import Vue from 'vue'
import Vuex from 'vuex'
import VShowSlide from 'v-show-slide'

Vue.use(Vuex)
Vue.use(VShowSlide, {
  customEasing: {
    exampleEasing: 'ease'
  }
})
