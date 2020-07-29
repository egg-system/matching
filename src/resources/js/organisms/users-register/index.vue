<template>
  <div>
    <start-page v-show="stepState === 0" @click="moveNextStep" />
    <name-step v-show="stepState === 1" @click="moveNextStep" />
    <user-type-step v-show="stepState === 2" @click="moveNextStep" @back="movePrevStep" />
    <occupation-step v-show="stepState === 3" :occupations="occupations" @click="moveNextStep" @back="movePrevStep" />
  </div>
</template>

<script>
import startPage from './start-page'
import nameStep from './name-step'
import userTypeStep from './user-type-step'
import occupationStep from './occupation-step'

export default {
  props: {
    occupations: { type: Array, required: true }
  },
  data () {
    return {
      stepState: 3
    }
  },
  components: {
    startPage,
    nameStep,
    userTypeStep,
    occupationStep
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
