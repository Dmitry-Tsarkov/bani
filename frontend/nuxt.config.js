export default {
  server: {
    port: 8004,
    // host: '0.0.0.0',
  },

  target: 'server',

  ssr: true,

  head: {
    title: 'default-nuxt',
    htmlAttrs: {
      lang: 'ru-RU'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }, { rel: 'stylesheet',  href: 'https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&display=swap' }
    ]
    
    
  },

  buildModules: ['nuxt-compress'],
  
  css: ['@/assets/scss/app.scss'],

  styleResources: {
    scss: ['@/assets/scss/variables.scss'],
  },

  plugins: [{ src: '~/plugins/plugins.js', mode: 'client' }, '~plugins/api.js'],

  components: true,

  modules: ['@nuxtjs/axios', '@nuxtjs/style-resources', '@nuxtjs/svg-sprite'],
    
}
