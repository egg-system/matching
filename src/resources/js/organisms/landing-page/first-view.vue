<template>
  <div class="first-view-wrapper">
    <main-view />
    <v-row justify="center" class="login-btn-wrapper">
      <login-dialog />
    </v-row>
  </div>
</template>

<script>
import mainView from '../../molecules/landing-page/mian-view'
import loginDialog from '../landing-page/login-dialog'

export default {
  components: { mainView, loginDialog }  
}
</script>

<style lang="scss" scoped>
.first-view-wrapper {
  margin-top: 50px;
}

.login-btn-wrapper {
  margin-top: 130px;
}
</style>
