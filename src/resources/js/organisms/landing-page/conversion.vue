<template>
  <div class="conversion-wrapper center-align-wrapper">
    <main-image />
    <p class="mt-8 mb-4">さあ、今すぐ<br />エントリー。</p>
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
@import 'resources/scss/_variables.scss';

.conversion-wrapper {
  margin-bottom: $sectionMarginSize;

  p {
    font-weight: bold;
    font-family: sans-serif;
    font-size: 3rem;
  }
}
</style>
