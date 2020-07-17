<template>
  <div class="center-align-wrapper">
    <main-image />
    <h1 class="main-title accent-phrase">
      トレーナーのための<br />複業・副業マッチングプラットフォーム
    </h1>
    <main-copy />
  </div>
</template>

<script>
import mainImage from '../../atoms/landing-page/main-image'
import mainCopy from '../../atoms/landing-page/first-view/main-copy'

export default {
  components: { mainImage, mainCopy }
}
</script>

<style lang="scss" scoped>
.main-title {
  font-size: 40px;
  margin-top: 80px;
  margin-bottom: 60px;
}
</style>
