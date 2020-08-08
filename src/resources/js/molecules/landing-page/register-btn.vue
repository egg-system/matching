<template>
  <main-btn
    :href="href"
    label="無料で始める"
  />
</template>

<script> 
import mainBtn from '../../atoms/main-btn'

export default {
  components: { mainBtn },
  computed: {
    href() {
      if (this.isEnabledRegister) {
        return '/input-email'
      }

      return 'https://forms.gle/TwWSKiC2nxgM4kb99'
    },
    isEnabledRegister() {
      return this.$root.isEnabled('register')
    }
  }
}
</script>
