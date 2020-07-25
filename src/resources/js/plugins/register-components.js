import { formComponents } from './components/molecules/form-components'
import { landingPageComponents } from './components/landing-page-components'
import VueDataComposer from '../functional/vue-data-composer'

export const components = [
  {
    name: 'vue-data-composer',
    object: VueDataComposer,
  },
  ...formComponents,
  ...landingPageComponents
]
