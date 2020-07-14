<template>
  <section class="feature-section center-align-wrapper">
    <span class="feauture">feature {{ index }}</span>
    <v-img :alt="name" :src="imageUrl" width="350px" class="mb-10" />
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
.feature-section {
  padding-bottom: 50px;
  margin: 50px 0;

  span {
    font-size: 60px;
  }
}
</style>
