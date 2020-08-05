<template>
  <div>
    <start-page v-show="stepState === 0" @moveNext="moveNextStep" />
    <name-step v-show="stepState === 1" @moveNext="moveNextStep" />
    <user-type-step v-show="stepState === 2" @moveNext="moveNextStep" @back="movePrevStep" />
    <occupation-step v-show="stepState === 3" :isShown="stepState === 3" :occupations="occupations" @moveNext="moveNextStep" @back="movePrevStep" />
    <area-step v-show="stepState === 4" :isShown="stepState === 4" :areas="areas" @moveNext="moveNextStep" @back="movePrevStep" />
    <work-style-step v-show="stepState === 5" :isShown="stepState === 5" :areas="areas" @moveNext="moveNextStep" @back="movePrevStep" />
    <career-step v-show="stepState === 6" @moveNext="moveNextStep" @back="movePrevStep" />
    <thanks-page v-show="stepState === 7" @entry="entry" />
  </div>
</template>

<script>
import startPage from './start-page'
import nameStep from './name-step'
import userTypeStep from './user-type-step'
import occupationStep from './occupation-step'
import areaStep from './area-step'
import workStyleStep from './work-style-step'
import careerStep from './career-step'
import thanksPage from './thanks-page'

export default {
  props: {
    occupations: { type: Array, required: true },
    areas: { type: Array, required: true }
  },
  data () {
    return {
      stepState: 0
    }
  },
  components: {
    startPage,
    nameStep,
    userTypeStep,
    occupationStep,
    areaStep,
    workStyleStep,
    careerStep,
    thanksPage
  },
  methods: {
    moveNextStep () {
      this.stepState++
    },
    movePrevStep () {
      this.stepState--
    },
    entry () {
      // TODO: 遷移先を確認する
    }
  }
}
</script>
