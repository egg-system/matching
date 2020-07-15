<template>
  <ul class="fixutures-wrapper">
    <li v-for="(feature, index) in features" :key="index">
      <feature-description :index="index + 1" :feature="feature" />
    </li>
  </ul>
</template>

<script>
import featureDescription from '../../atoms/landing-page/descriptions/feature-description'
import { features } from './features-constants'

export default {
  components: { featureDescription },
  data: () => ({ features })
}
</script>

<style lang="scss" scoped>
.fixutures-wrapper {
  margin: 150px 0;

  li:not(:last-child) {
    border-bottom: 1px solid #000;
  }
}
</style>
