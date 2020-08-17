export const landingPageComponents = [
  {
    name: 'landing-page-header',
    object: () => import('../../organisms/landing-page/header.vue')
  },
  {
    name: 'landing-page-first-view',
    object: () => import('../../organisms/landing-page/first-view.vue')
  },
  {
    name: 'landing-page-descriptions',
    object: () => import('../../organisms/landing-page/descriptions.vue')
  },
  {
    name: 'landing-page-conversion',
    object: () => import('../../organisms/landing-page/conversion.vue')
  },
  {
    name: 'landing-page-questions',
    object: () => import('../../organisms/landing-page/often-questions.vue')
  }
]
