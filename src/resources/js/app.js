require('./bootstrap');

import Vue from 'vue'
import vuetify from './plugins/vuetify'

import appSlot from "./organisms/app-slot.vue";

// molecules
Vue.component('form-wrapper', require('./components/molecules/form/FormWrapper.vue').default);
Vue.component('input-form', require('./components/molecules/form/InputForm.vue').default);
Vue.component('select-form', require('./components/molecules/form/SelectForm.vue').default);
Vue.component('text-area-form', require('./components/molecules/form/TextAreaForm.vue').default);

const app = new Vue({
  vuetify,
  components: { appSlot },
  el: '#app'
})

window.app = app
