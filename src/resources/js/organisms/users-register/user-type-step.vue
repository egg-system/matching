<template>
  <step-page-wrapper
    headerText="あなたの今の働き方を教えて下さい"
    headerSubText="下記を選択してください"
    step="1"
    :progress="20"
    @back="back"
  >
    <div class="form-wrapper">
      <div
        v-for="(nowWorkStyle, i) in nowWorkStyles"
        :key="`now-work-style-form_${i}`"
        class="now-work-style-form"
        :class="{ 'now-work-style-form--selected': nowWorkStyle.value === inputNowWorkStyle }"
        @click="onClickNowWorkStyle(nowWorkStyle.value)"
      >
        <img :src="nowWorkStyle.img" :alt="nowWorkStyle.label" class="now-work-style-form__img">
        <p class="now-work-style-form__text">{{ nowWorkStyle.label }}</p>
      </div>

      <!-- selectフォームのoptionではデザインを実装しにくかったのでhiddenに動的に値を挿入 -->
      <input type="hidden" name="now_work_style" :value="inputNowWorkStyle">
    </div>
  </step-page-wrapper>
</template>

<script>
import stepPageWrapper from '../../molecules/users-register/step-page-wrapper'

export default {
  components: {
    stepPageWrapper
  },
  data () {
    return {
      nowWorkStyles: [
        {
          label: 'ジムに勤務しています',
          value: 'Gym',
          img: '/images/users-register/gym.png'
        },
        {
          label: 'フリーランスです',
          value: 'Trainer',
          img: '/images/users-register/freelance_icon.jpg'
        }
      ],
      inputNowWorkStyle: '' // 選択した働き方
    }
  },
  methods: {
    back () {
      this.$emit('back')
    },
    onClickNowWorkStyle (value) {
      this.inputNowWorkStyle = value

      this.$emit('moveNext')
    }
  }
}
</script>

<style lang="scss" scoped>
.form-wrapper {
  display: flex;
  text-align: center;
  margin-top: 65px;
  padding: 0 10%;
  .now-work-style-form {
    &--selected .now-work-style-form__img {
      border: solid 2px red;
    }
    &__img {
      max-width: 60%;
      margin: auto;
      border: solid 2px lightgrey;
      padding: 10px;
    }
    &__text {
      font-size: 0.8rem;
      font-weight: bold;
      margin-top: 15px;
    }
  }
}
</style>
