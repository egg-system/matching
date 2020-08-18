<template>
  <step-page-wrapper
    headerText="プロフィールを入力してください"
    headerSubText="プロフィールを充実させると<br>マッチングしやすくなります！"
    step="3"
    :progress="80"
    @back="back"
  >

    <careers-form v-model="careerValues" @validate="setHasError" />
    <main-btn
      class="next-btn"
      label="次へ"
      @click="moveNext"
      :disabled="hasError"
    ></main-btn>

    <div class="skip-link">
      <a @click.prevent="skip">スキップ</a>
    </div>

    <!-- Formの発火用に作成 -->
    <input v-show="false" ref="sbmitBtn" type="submit">
    <input type="hidden" name="careers" :value="careerValues">
  </step-page-wrapper>
</template>

<script>
import careersForm from '../users/careers-form/careers-form'
import {
  careerDefaultValue,
  stringifyCareers,
  parseCareers
} from '../users/careers-form/careers-constants'
import stepPageWrapper from '../../molecules/users-register/step-page-wrapper'
import mainBtn from '../../atoms/main-btn'

export default {
  components: {
    stepPageWrapper,
    mainBtn,
    careersForm
  },
  data: () => ({
    careers: null,
    hasError: true
  }),
  computed: {
    careerValues: {
      get() {
        if (!this.careers) {
          return stringifyCareers([{ ...careerDefaultValue }])
        }
        return stringifyCareers(this.careers)
      },
      set(careerValues) {
        this.careers = parseCareers(careerValues)
      }
    }
  },
  methods: {
    setHasError(hasError) {
      this.hasError = hasError
    },
    back() {
      this.$emit('back')
    },
    moveNext() {
      this.$refs.sbmitBtn.click()
    },
    skip() {
      this.careers = null
      this.$refs.sbmitBtn.click()
    }
  }
}
</script>

<style lang="scss" scoped>
.next-btn {
  display: block;
  margin: 32px auto 0 auto;
}
.skip-link {
  text-align: center;
  margin: 20px 0 80px 0;
  font-size: 0.9rem;
  a {
    text-decoration: none;
    color: grey;
  }
}
</style>
