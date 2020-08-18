<template>
  <ol class="feature-wrapper">
    <template v-for="(feature, index) in features">
      <content-line v-if="index !== 0" :key="index" />
      <li :key="feature.name">
        <feature-description :index="index + 1" :feature="feature" />
      </li>
    </template>
  </ol>
</template>

<script>
import contentLine from '../../atoms/landing-page/content-line'
import featureDescription from './descriptions/feature-description'
import { features } from './features-constants'

export default {
  components: { featureDescription, contentLine },
  data: () => ({ features })
}
</script>

<style lang="scss" scoped>
.feature-wrapper {
  margin: 4rem 0;
  padding: 0;
}
</style>
