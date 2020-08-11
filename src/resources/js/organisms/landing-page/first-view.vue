<template>
  <div class="first-view-wrapper">
    <main-view />
    <login-area />
  </div>
</template>

<script>
import mainView from '../../molecules/landing-page/mian-view'
import loginArea from '../landing-page/login-area'

export default {
  components: { mainView, loginArea }  
}
</script>

<style lang="scss" scoped>
.first-view-wrapper {
  margin-top: 1.5rem;
}
</style>
