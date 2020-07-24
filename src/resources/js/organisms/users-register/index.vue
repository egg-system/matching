<template>
  <div>
    <start-page v-show="stepState === 0" @click="goToNextStep" />
  </div>
</template>

<script>
import startPage from './start-page'

export default {
  data () {
    return {
      stepState: 0
    }
  },
  components: {
    startPage
  },
  methods: {
    goToNextStep () {
      this.stepState++
    }
  }
}
</script>

<style lang="scss">
</style>
