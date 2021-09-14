/* eslint-disable no-undef */
import { createApp } from 'vue'

import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueSweetener2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

import './css/main.css'

axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*'
/* Fetch sample data */
store.dispatch('fetchClients')

/* Default title tag */
const defaultDocumentTitle = 'Pizza Ordering App'

/* Collapse mobile aside menu on route change & set document title from route meta */
router.beforeEach(to => {
  store.dispatch('asideMobileToggle', false)
  store.dispatch('asideLgToggle', false)

  store.dispatch('formScreenToggle', !!to.meta.formScreen)
})

router.afterEach(to => {
  if (to.meta && to.meta.title) {
    document.title = `${to.meta.title} — ${defaultDocumentTitle}`
  } else {
    document.title = defaultDocumentTitle
  }
})

createApp(App).use(store).use(VueAxios, axios, VueSweetener2).use(router).mount('#app')
