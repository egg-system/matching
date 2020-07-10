require('./bootstrap');

import Vue from 'vue'
import vuetify from './plugins/vuetify'

import appSlot from "./organisms/app-slot.vue";

const app = new Vue({
    vuetify,
    components: { appSlot },
    el: '#app'
})

window.app = app
