import Vue from 'vue'
import App from './App.vue'
import router from './router' // 6/8 edit

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router,  // 6/8 edit
}).$mount('#app')
