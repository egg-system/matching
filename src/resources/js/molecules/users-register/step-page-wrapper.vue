<template>
  <div class="step-page-wrapper">
    <div class="symbol-header-wrapper">
      <symbol-header @back="back" />

      <div v-if="headerText" class="symbol-header__text" v-html="headerText">
        <p v-if="headerSubText" class="symbol-header__text-sub">{{ headerSubText }}</p>
      </div>
    </div>

    <slot />

    <p v-if="footerText" class="footer__text">{{ footerText }}</p>

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
  }
}
</script>

<style lang="scss">
.step-page-wrapper {
  .symbol-header__text {
    margin-top: 47px;
    font-weight: bold;
    font-size: 0.9rem;
    text-align: center;
    line-height: 1.8rem;
    &-sub {
      text-align: center;
      margin-top: 13px;
      font-size: 0.8rem;
      font-weight: normal;
    }
  }
  .footer__text {
    position: fixed;
    bottom: 11%;
    left: 50%;
    font-size: 0.8rem;
    transform: translate(-50%, -50%);
  }
  .steps-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background: white;
  }
}
</style>
