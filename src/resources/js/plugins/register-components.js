import { formComponents } from './components/molecules/form-components'
import { landingPageComponents } from './components/landing-page-components'

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
  ...formComponents,
  ...landingPageComponents
]
