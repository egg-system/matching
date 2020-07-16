<template>
  <div class="description-wrapper">
    <service-description />
    <side-job-description />
    <feature-descriptions />
  </div>
</template>

<script>
import serviceDescription from '../../atoms/landing-page/descriptions/service-description'
import sideJobDescription from '../../atoms/landing-page/descriptions/side-job-description'
import featureDescriptions from '../../moleclues/landing-page/feature-descriptions'

export default {
  components: {
    serviceDescription,
    sideJobDescription,
    featureDescriptions
  }
}
</script>

<style lang="scss" scoped>
.description-wrapper {
  margin-top: 150px;
}
</style>
