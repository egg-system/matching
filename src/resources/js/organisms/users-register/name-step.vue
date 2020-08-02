<template>
  <div class="name-step-wrapper">
    <v-img src="/images/users-register/finish_background.jpg">
      <div class="name-step">
        <div class="name-step__header">あなたの名前を教えてください</div>

        <div class="name-form">
          <div class="name-form__heading">氏名</div>
          <input
            v-model="inputValue"
            type="text"
            class="name-form__input"
            name="name"
            autocomplete="name"
            autofocus
            required
          >
        </div>

        <rounded-btn class="next-btn" text="次へ" :disabled="!inputValue" @click="moveNext" />
      </div>
    </v-img>

    <steps-footer step="1" :progress="10" />
  </div>
</template>

<script>
import roundedBtn from '../../atoms/users-register/rounded-btn'
import stepsFooter from '../../molecules/users-register/steps-footer'

export default {
  components: {
    roundedBtn,
    stepsFooter
  },
  data () {
    return {
      inputValue: ''
    }
  },
  methods: {
    moveNext () {
      this.$emit('moveNext')
    }
  }
}
</script>

<style lang="scss" scoped>
.name-step-wrapper {
  .name-step {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    &__header {
      margin-top: 72px;
      font-weight: bold;
      font-size: 0.9rem;
    }
    .name-form {
      margin-top: 135px;
      width: 75%;
      &__heading {
        font-size: 0.5rem;
        color: grey;
      }
      &__input {
        width: 100%;
        border-bottom: solid 1px;
        font-size: 1.1rem;
        font-weight: bold;
        padding: 3px 0 7px 0;
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
    background: white;
  }
}
</style>
