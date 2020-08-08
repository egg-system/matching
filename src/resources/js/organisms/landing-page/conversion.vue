<template>
  <div class="conversion-wrapper center-align-wrapper">
    <main-image />
    <p class="mt-16 mb-6">さあ、今すぐ<br />エントリー。</p>
    <register-btn />
  </div>
</template>

<script>
import mainImage from '../../atoms/landing-page/main-image'
import registerBtn from '../../molecules/landing-page/register-btn'

export default {
  components: { mainImage, registerBtn }
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
