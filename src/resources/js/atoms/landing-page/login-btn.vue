<template>
  <v-btn
    width="700px"
    height="130px"
    class="login-btn"
    href="https://forms.gle/TwWSKiC2nxgM4kb99"
  >
    <span class="login-btn-phrase">
      無料で始める<template v-if="false"> / ログイン</template>
    </span>
  </v-btn>
</template>

<style lang="scss" scoped>
@import '../../../scss/variables';

.login-btn {
  background: $main-btn-bg;
  border-radius: 10px;
}

span.login-btn-phrase {
  color: white;
  letter-spacing: 0px;
  font-size: 45px;
  font-weight: bold;
}
</style>
