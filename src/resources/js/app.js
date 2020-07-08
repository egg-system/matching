require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// molecules
Vue.component('text-area-form', require('./components/molecules/form/TextAreaForm.vue').default);

const app = new Vue({
    el: '#app'
});
