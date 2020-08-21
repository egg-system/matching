<template>
  <v-row justify="center" class="login-area-wrapper">
    <div>
      <register-btn />
    </div>
    <template v-if="isEnabledLogin">
      <p>すでにアカウントをお持ちの方はこちら</p>
      <div>
        <login-btn />
      </div>
    </template>
  </v-row>
</template>

<script>
import loginBtn from '../../molecules/landing-page/login-btn'
import registerBtn from '../../molecules/landing-page/register-btn'

export default {
  components: { registerBtn, loginBtn },
  computed: {
    isEnabledLogin() {
      return this.$root.isEnabled('login')
    }
  }
}
</script>

<style lang="scss" scoped>
@import 'resources/scss/_variables.scss';

.login-area-wrapper {
  margin-top: $sectionMarginSize;
  margin-left: 0;
  margin-right: 0;

  p {
    margin: 2rem 0 1rem;
    font-size: 0.8rem;
  }
}
</style>
