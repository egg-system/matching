<template>
  <v-row justify="center" class="social-icons-wrapper">
    <social-icon
      v-for="socialIcon in socialIcons"
      :key="socialIcon.url"
      :icon="socialIcon.icon"
      :url="socialIcon.url"
      class="social-icon"
    />
  </v-row>
</template>

<script>
import socialIcon from '../../../atoms/landing-page/footer/social-icon'
import { socialIcons } from './social-constants'

export default {
  components: { socialIcon },
  data: () => ({ socialIcons })
}
</script>

<style lang="scss" scoped>
.social-icons-wrapper {
  margin: auto 0;
  .social-icon {
    margin: 0 1rem 1rem;
  }
}
</style>
