import Vue from 'vue'
import Vuex from 'vuex'
import VShowSlide from 'v-show-slide'
import Paginate from "vuejs-paginate";

Vue.component("paginate", Paginate);
Vue.use(Vuex)
Vue.use(VShowSlide, {
  customEasing: {
    exampleEasing: 'ease'
  }
})
