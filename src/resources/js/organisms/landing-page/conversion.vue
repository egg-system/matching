<template>
  <div class="conversion-wrapper center-align-wrapper">
    <main-image />
    <p class="mt-16 mb-6">さあ、今すぐ<br />エントリー。</p>
    <login-btn />
  </div>
</template>

<script>
import mainImage from '../../atoms/landing-page/main-image'
import loginBtn from '../../atoms/landing-page/login-btn'

export default {
  components: { mainImage, loginBtn }
}
</script>

<style lang="scss" scoped>
.conversion-wrapper {
  p {
    font-weight: bold;
    font-family: sans-serif;
    font-size: 100px;
  }
}
</style>
