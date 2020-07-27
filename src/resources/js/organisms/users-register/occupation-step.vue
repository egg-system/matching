<template>
  <step-page-wrapper
    headerText="今の職種を選択してください"
    headerSubText="複数選択可能"
    step="1"
    :progress="30"
    @back="back"
  >
    <div class="contents__form">
      <!-- TODO: 実装 -->
      <!-- <div
        v-for="(nowWorkStyle, i) in nowWorkStyles"
        :key="`contents__form-container_${i}`"
        class="contents__form-container"
        :class="{ 'contents__form-container--selected': nowWorkStyle.value === inputNowWorkStyle }"
        @click="onClickNowWorkStyle(nowWorkStyle.value)"
      >
        <img :src="nowWorkStyle.img" :alt="nowWorkStyle.label" class="contents__form-img">
        <p class="contents__form-text">{{ nowWorkStyle.label }}</p>
      </div>

      <input type="hidden" name="now_work_style" :value="inputNowWorkStyle"> -->
    </div>
  </step-page-wrapper>
</template>

<script>
import stepPageWrapper from '../../molecules/users-register/step-page-wrapper'

export default {
  components: {
    stepPageWrapper
  },
  props: {
    occupations: { type: Array, required: true }
  },
  data () {
    return {
      selectValue: '',
      selectOptions: [
        {
          label: 'フィットネス',
          value: 'Gym',
          img: '/images/users-register/gym.png'
        },
        {
          label: 'フリーランスです',
          value: 'Trainer',
          img: '/images/users-register/freelance_icon.jpg'
        }
      ]
    }
  },
  methods: {
    back () {
      this.$emit('back')
    }
  }
}
</script>

<style lang="scss">
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
