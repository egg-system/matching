require('./bootstrap')

import Vue from 'vue'

import { globalComponents } from './plugins/register-components'

globalComponents.forEach(component => {
  Vue.component(component.name, component.object)
})

import vuetify from './plugins/vuetify'

const app = new Vue({
  vuetify,
  el: '#app'
})

window.app = app
