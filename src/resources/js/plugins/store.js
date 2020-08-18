import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import release from '../stores/release'

export default new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',
  modules: {
    release
  }
})
