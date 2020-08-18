require('./bootstrap')

import Vue from 'vue'

import { components } from './plugins/register-components'
components.forEach(component => {
  Vue.component(component.name, component.object)
})

import store from './plugins/store'
import vuetify from './plugins/vuetify'

const csrfToken = document.getElementsByName('csrf-token')[0].content
const app = new Vue({
  store,
  vuetify,
  el: '#app',
  data: () => ({ token: csrfToken }),
  methods: {
    isEnabled(feature) {
      const isEnableFunction = this.$store.getters['release/isEnabled']
      return isEnableFunction(feature)
    }
  }
})

window.app = app
