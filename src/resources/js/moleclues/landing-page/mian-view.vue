<template>
  <div class="view-wrapper">
    <main-image />
    <h1 class="main-title landing-page-accent-phrase">
      トレーナーのための<br >副業マッチングプラットフォーム
    </h1>
    <main-copy />
  </div>
</template>

<script>
import mainImage from '../../atoms/landing-page/main-image'
import mainCopy from '../../atoms/landing-page/main-copy'

export default {
  components: { mainImage, mainCopy }
}
</script>

<style lang="scss" scoped>
.view-wrapper {
  display: flex;
  flex-flow: column;
  align-items: center;
}

.main-title {
  text-align: center;
  margin-top: 80px;
  margin-bottom: 60px;
}
</style>
