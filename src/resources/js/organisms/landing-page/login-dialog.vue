<template>
  <div>
    <login-btn v-model="isShown" />
    <!-- TODO: ログインフォームのカンプが出たら、追加する -->
    <v-dialog v-model="isShown" />
  </div>
</template>

<script>
import loginBtn from '../../molecules/landing-page/login-btn'

export default {
  components: { loginBtn },
  data: () => ({ isShown: false })
}
</script>
