<template>
  <div class="conversion-wrapper center-align-wrapper">
    <main-image />
    <p class="mt-16 mb-6">さあ、今すぐ<br />エントリー。</p>
    <login-dialog />
  </div>
</template>

<script>
import mainImage from '../../atoms/landing-page/main-image'
import loginDialog from '../landing-page/login-dialog'

export default {
  components: { mainImage, loginDialog }
}
</script>

<style lang="scss" scoped>
.conversion-wrapper {
  margin-bottom: 200px;

  p {
    font-weight: bold;
    font-family: sans-serif;
    font-size: 100px;
  }
}
</style>
