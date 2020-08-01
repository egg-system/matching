require('./bootstrap')

import Vue from 'vue'

import { components } from './plugins/register-components'
components.forEach(component => {
  Vue.component(component.name, component.object)
})

import store from './plugins/store'
import vuetify from './plugins/vuetify'

const app = new Vue({
  store,
  vuetify,
  el: '#app',
  methods: {
    isEnabled(feature) {
      const isEnableFunction = this.$store.getters['release/isEnabled']
      return isEnableFunction(feature)
    }
  }
})

window.app = app
