import Vue from 'vue'
import Vuetify, {
  VApp,
  VMain,
  VContainer
} from 'vuetify/lib'

// bladeから直接呼び出したいコンポーネントは以下で登録する
Vue.use(Vuetify, {
  components: { VApp, VMain, VContainer }
})

export default new Vuetify({
  icons: { iconfont: 'mdi' },
  theme: {
    themes: {
      light: {
        primary: '#3f51b5',
        secondary: '#b0bec5',
        accent: '#8c9eff',
        error: '#b71c1c'
      }
    }
  }
})
