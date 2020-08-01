<template>
  <main-btn
    :href="href"
    :label="label"
    @click="openDialog"
  />
</template>

<script> 
import mainBtn from '../../atoms/main-btn'

export default {
  components: { mainBtn },
  props: {
    value: {
      type: Boolean,
      required: true
    }
  },
  computed: {
    label() {
      if (this.isEnabledLogin) {
        return `無料で始める / ログイン`
      }

      return '無料で始める'
    },
    href() {
      if (this.isEnabledLogin) {
        return ''
      }

      return 'https://forms.gle/TwWSKiC2nxgM4kb99'
    },
    isEnabledLogin() {
      return this.$root.isEnabled('login')
    }
  },
  methods: {
    openDialog() {
      if (!this.isEnabledLogin) {
        return
      }

      this.$emit('input', true)
    }
  }
}
</script>
