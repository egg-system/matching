<template>
  <div class="first-view-wrapper">
    <main-view />
    <v-row justify="center" class="login-btn-wrapper">
      <login-btn />
    </v-row>
  </div>
</template>

<script>
import mainView from '../../moleclues/landing-page/mian-view'
import loginBtn from '../../atoms/landing-page/login-btn'

export default {
  components: { mainView, loginBtn }  
}
</script>

<style lang="scss" scoped>
.first-view-wrapper {
  margin-top: 50px;
}

.login-btn-wrapper {
  margin-top: 150px;
}
</style>
