<template>
  <div class="name-step-wrapper">
    <v-img src="/images/users-register/finish_background.jpg">
      <div class="name-step">
        <div class="name-step__header">あなたの名前を教えてください</div>

        <div class="name-form">
          <div class="name-form__heading">
            氏名 ※ ジムオーナーが見る画面には、ニックネームが表示されます
          </div>
          <input
            v-model="name"
            type="text"
            class="name-form__input"
            name="name"
            autocomplete="name"
            autofocus
            required
          >
        </div>

        <div class="name-form">
          <div class="name-form__heading">ニックネーム</div>
          <input
            v-model="displayName"
            type="text"
            class="name-form__input"
            name="display_name"
            autocomplete="name"
            autofocus
            required
          >
        </div>

        <main-btn
          class="next-btn"
          label="次へ"
          :disabled="!name || !displayName"
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
      name: '',
      displayName: ''
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
    max-width: 1000px;
  }
}
</style>
