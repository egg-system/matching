<template>
  <div class="step-page-wrapper" ref="stepPageWrapper">
    <div class="symbol-header-wrapper">
      <symbol-header @back="back" />

      <div v-if="headerText" class="symbol-header__text">
        <span v-html="headerText"></span>
        <p v-if="headerSubText" class="symbol-header__text-sub" v-html="headerSubText"></p>
      </div>
    </div>

    <slot />

    <steps-footer :step="step" :progress="progress" />
  </div>
</template>

<script>
import stepsFooter from '../../molecules/users-register/steps-footer'
import symbolHeader from '../../molecules/users-register/symbol-header'

export default {
  components: {
    stepsFooter,
    symbolHeader
  },
  props: {
    headerText: { type: String, default: '' },
    headerSubText: { type: String, default: '' },
    footerText: { type: String, default: '' },
    step: { type: String, default: '1' },
    progress: { type: Number, default: 10 }
  },
  methods: {
    back () {
      this.$emit('back')
    }
  },
  mounted () {
    this.$refs.stepPageWrapper.style.width = `${document.body.clientWidth}px`
  }
}
</script>

<style lang="scss" scoped>
.step-page-wrapper {
  max-width: 1000px;
  .symbol-header__text {
    margin-top: 47px;
    text-align: center;
    span {
      font-weight: bold;
      font-size: 0.9rem;
      line-height: 1.8rem;
    }
    &-sub {
      margin-top: 13px;
      font-size: 0.8rem;
    }
  }
  .steps-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    max-width: 1000px;
  }
}
</style>
