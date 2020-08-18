<template>
  <div class="password-step-wrapper">
    <v-img src="/images/users-register/finish_background.jpg">
      <div class="password-step">
        <div class="password-step__header">
          <a href="javascript:void(0)" @click="back" class="back-link"></a>
          <span>アカウントのパスワードを設定してください</span>
        </div>

        <div class="password-form">
          <div class="password-form__heading">パスワード ※ 6文字以上で設定してください</div>
          <div class="password-form__input">
            <input
              v-model="inputValue"
              :type="isShownPassword ? 'text' : 'password'"
              class="password-form__input"
              name="password"
              autocomplete="password"
              autofocus
              required
            >
            <a href="javascript:void(0)" @click.prevent="toggleIsShownPassword">
              <v-icon size="20">{{ isShownPassword ? 'mdi-eye-off' : 'mdi-eye' }}</v-icon>
            </a>
          </div>
        </div>

        <main-btn
          class="next-btn"
          label="次へ"
          :disabled="!inputValue || inputValue.length < 6"
          @click="moveNext"
        />
      </div>
    </v-img>

    <steps-footer step="1" :progress="10" />
  </div>
</template>

<script>
import mainBtn from '../../atoms/main-btn'
import stepsFooter from '../../molecules/users-register/steps-footer'

export default {
  components: {
    mainBtn,
    stepsFooter
  },
  data () {
    return {
      inputValue: '',
      isShownPassword: false
    }
  },
  methods: {
    moveNext () {
      this.$emit('moveNext')
    },
    back () {
      this.$emit('back')
    },
    toggleIsShownPassword () {
      this.isShownPassword = !this.isShownPassword
    }
  }
}
</script>

<style lang="scss" scoped>
.password-step-wrapper {
  .password-step {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    &__header {
      width: 100%;
      margin-top: 72px;
      .back-link {
        content: "";
        width: 15px;
        height: 15px;
        border-bottom: solid 4px black;
        border-right: solid 4px black;
        transform: rotate(135deg);
        position: absolute;
        margin-top: -44px;
        margin-left: 20px;
        border-radius: 3px;
      }
      span {
        font-weight: bold;
        font-size: 0.9rem;
        display: inline-block;
        width: 100%;
        text-align: center;
      }
    }
    .password-form {
      margin-top: 125px;
      width: 75%;
      &__heading {
        font-size: 0.5rem;
        color: grey;
      }
      &__input {
        display: flex;
        align-items: baseline;
        input {
          width: 100%;
          border-bottom: solid 1px;
          font-size: 1.1rem;
          font-weight: bold;
          padding: 3px 0 7px 0;
          margin-right: -25px;
        }
        a {
          text-decoration: unset;
        }
      }
    }
    .next-btn {
      margin-top: 60px;
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
