<template>
  <div class="user-type-step-wrapper">
    <div class="symbol-header-wrapper">
      <symbol-header @back="back" />
    </div>

    <div class="contents">
      <div class="contents__container">
        <div class="contents__header">
          あなたの今の働き方を教えて下さい
          <p class="contents__header-sub-text">下記を選択してください</p>
        </div>

        <!-- TODO: 画像の枠線 -->
        <!-- TODO: 選択時の動作 -->
        <div class="contents__form">
          <select
            v-model="selectValue"
            name="user_type"
            class="select-form"
            :size="selectOptions.length"
          >
            <option
              v-for="(option, i) in selectOptions"
              :value="option.value"
              :key="`select_${i}`"
              :style="`background-image: url(${option.img})`"
              class="select-form__option"
            >{{ option.label }}</option>
          </select>
        </div>
      </div>
    </div>

    <steps-footer step="1" :progress="20" />
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
  data () {
    return {
      selectValue: '',
      selectOptions: [
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
.user-type-step-wrapper {
  .symbol-header-wrapper {
    margin-top: 20px;
  }
  .contents__container {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    .contents__header {
      margin-top: 70px;
      font-weight: bold;
      &-sub-text {
        text-align: center;
        margin-top: 15px;
        font-size: 0.9rem;
        font-weight: normal;
      }
    }
    .contents__form {
      .select-form {
        &__option {
          background-size: 80px 80px;
          background-position: center;
          padding-top: 50%;
          display: inline-flex;
          margin: 0 20px;
          font-size: 0.8rem;
          font-weight: bold;
        }
      }
    }
  }
  .steps-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background: white;
  }
}
</style>
