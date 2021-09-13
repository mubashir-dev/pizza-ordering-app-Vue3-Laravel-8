/* eslint-disable no-undef */
import { createApp } from 'vue'

import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'
import './css/main.css'
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

createApp(App).use(store).use(VueAxios, axios).use(router).mount('#app')
