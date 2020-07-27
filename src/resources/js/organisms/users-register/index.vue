<template>
  <div>
    <start-page v-show="stepState === 0" @click="moveNextStep" />
    <name-step v-show="stepState === 1" @click="moveNextStep" />
    <user-type-step v-show="stepState === 2" @click="moveNextStep" @back="movePrevStep" />
  </div>
</template>

<script>
import startPage from './start-page'
import nameStep from './name-step'
import userTypeStep from './user-type-step'

export default {
  data () {
    return {
      stepState: 0
    }
  },
  components: {
    startPage,
    nameStep,
    userTypeStep
  },
  methods: {
    moveNextStep () {
      this.stepState++
    },
    movePrevStep () {
      this.stepState--
    }
  }
}
</script>
