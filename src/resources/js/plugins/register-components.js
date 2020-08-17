import { formComponents } from './components/molecules/form-components'
import { landingPageComponents } from './components/landing-page-components'
import { usersRegisterComponents } from './components/users-register-components'

import vueDataComposer from '../functional/vue-data-composer'
import appHeader from '../organisms/app/header'

export const components = [
  {
    name: 'vue-data-composer',
    object: vueDataComposer,
  },
  {
    name: 'app-header',
    object: appHeader,
  },
  {
    name: 'app-footer',
    object: () => import('../organisms/landing-page/footer.vue')
  },
  ...formComponents,
  ...landingPageComponents,
  ...usersRegisterComponents
]
