require('./bootstrap')

import Vue from 'vue'

import { components } from './plugins/register-components'

components.forEach(component => {
  Vue.component(component.name, component.object)
})

// form
Vue.component('form-wrapper', require('./moleclues/form/form-wrapper.vue').default);
Vue.component('input-form', require('./moleclues/form/input-form.vue').default);
Vue.component('select-form', require('./moleclues/form/select-form.vue').default);
Vue.component('text-area-form', require('./moleclues/form/text-area-form.vue').default);

import vuetify from './plugins/vuetify'

const app = new Vue({
  vuetify,
  el: '#app'
})

window.app = app
