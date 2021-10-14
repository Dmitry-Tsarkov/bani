import Vue from 'vue'
import YmapPlugin from 'vue-yandex-maps'

const settings = {
  apiKey: '629a5d68-b12d-4684-92d9-54465b70d500',
  lang: 'ru_RU',
  coordorder: 'latlong',
  version: '2.1',
}

Vue.use(YmapPlugin, settings);