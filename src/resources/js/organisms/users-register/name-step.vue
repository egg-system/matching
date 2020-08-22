<template>
  <div class="name-step-wrapper">
    <v-img src="/images/users-register/finish_background.jpg">
      <div class="name-step">
        <div class="name-step__header">あなたの名前を教えてください</div>

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
          <span>ジムへの表示名として使用されます。</span>
        </div>

        <div class="name-form">
          <div class="name-form__heading">
            氏名
          </div>
          <input
            v-model="name"
            type="text"
            class="name-form__input"
            name="name"
            autocomplete="name"
            required
          >
          <span>本名は本人確認のために使用します。当サービス内では表示されません。</span>
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
      margin-top: 5rem;
      width: 75%;
      &__heading {
        font-size: 1rem;
        color: grey;
      }
      &__input {
        width: 100%;
        border-bottom: solid 1px;
        font-size: 1.1rem;
        font-weight: bold;
        padding: 3px 0 7px 0;
      }
      span {
        margin-top: 1rem;
        display: block;
        font-size: 0.8rem;
      }
    }
    .next-btn {
      margin-top: 60px;
    }
  }
}
</style>
