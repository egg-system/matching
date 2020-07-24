<template>
  <div>
    <start-page v-show="stepState === 0" @click="moveNextStep" />
    <name-step v-show="stepState === 1" @click="moveNextStep" />
  </div>
</template>

<script>
import nameStep from './name-step'
import startPage from './start-page'

export default {
  data () {
    return {
      stepState: 0
    }
  },
  components: {
    nameStep,
    startPage
  },
  methods: {
    moveNextStep () {
      this.stepState++
    }
  }
}
</script>

<style lang="scss">
</style>
