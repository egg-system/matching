require('./bootstrap')

import Vue from 'vue'

import { components } from './plugins/register-components'

components.forEach(component => {
  Vue.component(component.name, component.object)
})

import vuetify from './plugins/vuetify'

// molecules
Vue.component('form-wrapper', require('./components/molecules/form/FormWrapper.vue').default);
Vue.component('input-form', require('./components/molecules/form/InputForm.vue').default);
Vue.component('select-form', require('./components/molecules/form/SelectForm.vue').default);
Vue.component('text-area-form', require('./components/molecules/form/TextAreaForm.vue').default);

const app = new Vue({
  vuetify,
  el: '#app'
})

window.app = app
