import Vue from 'vue'
import App from './App.vue'
import router from './router' // 6/8 edit

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import '@mdi/font/css/materialdesignicons.css'

Vue.use(Vuetify)

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router,  // 6/8 edit
  vuetify: new Vuetify(), // 7/5add
}).$mount('#app')
