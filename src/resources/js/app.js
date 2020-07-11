require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// molecules
Vue.component('form-wrapper', require('./components/molecules/form/FormWrapper.vue').default);
Vue.component('input-form', require('./components/molecules/form/InputForm.vue').default);
Vue.component('select-form', require('./components/molecules/form/SelectForm.vue').default);
Vue.component('text-area-form', require('./components/molecules/form/TextAreaForm.vue').default);

const app = new Vue({
    el: '#app'
});
