<template>
  <section class="feature-section center-align-wrapper">
    <span class="feauture">feature {{ index }}</span>
    <v-img :alt="name" :src="imageUrl" width="6rem" class="mb-4" />
    <h3>{{ name }}</h3>
    <p>{{ description }}</p>
  </section>
</template>

<script>
export default {
  props: {
    index: {
      type: Number,
      required: true
    },
    feature: {
      type: Object,
      required: true
    }
  },
  computed: {
    name() {
      return this.feature.name
    },
    imageUrl() {
      return this.feature.image
    },
    description() {
      return this.feature.description
    }
  }
}
</script>

<style lang="scss" scoped>
@import 'resources/scss/_variables.scss';

.feature-section {
  margin: 2.5rem 0 1rem;

  span {
    font-size: $h2FontSize;
  }
}
</style>
