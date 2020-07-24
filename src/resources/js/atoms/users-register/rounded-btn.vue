<template>
  <v-btn
    :type="type"
    class="rounded-btn"
    width="75%"
    min-height="50px"
    max-width="600px"
    @click="onClick"
    rounded
  >{{ text }}</v-btn>
</template>

<script>
export default {
  props: {
    text: { type: String, required: true },
    type: { type: String, default: undefined }
  },
  methods: {
    onClick () {
      this.$emit('click')
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../../scss/variables';

.rounded-btn {
  background: $main-btn-bg;
  color: white;
  font-weight: bold;
  font-size: 1.2rem;
  @media screen and (min-width: 768px) {
    font-size: 2rem;
  }
}
</style>
