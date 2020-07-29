<template>
  <step-page-wrapper
    headerText="あなたの今の働き方を教えて下さい"
    headerSubText="下記を選択してください"
    step="1"
    :progress="20"
    @back="back"
  >
    <div class="contents__form">
      <div
        v-for="(nowWorkStyle, i) in nowWorkStyles"
        :key="`contents__form-container_${i}`"
        class="contents__form-container"
        :class="{ 'contents__form-container--selected': nowWorkStyle.value === inputNowWorkStyle }"
        @click="onClickNowWorkStyle(nowWorkStyle.value)"
      >
        <img :src="nowWorkStyle.img" :alt="nowWorkStyle.label" class="contents__form-img">
        <p class="contents__form-text">{{ nowWorkStyle.label }}</p>
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

      this.$emit('click')
    }
  }
}
</script>

<style lang="scss" scoped>
.contents__form {
  display: flex;
  text-align: center;
  margin-top: 65px;
  padding: 0 10%;
  &-img {
    max-width: 60%;
    margin: auto;
    border: solid 2px lightgrey;
    padding: 10px;
  }
  &-container--selected .contents__form-img {
    border: solid 2px red;
  }
  &-text {
    font-size: 0.8rem;
    font-weight: bold;
    margin-top: 15px;
  }
}
</style>
