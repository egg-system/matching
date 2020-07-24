<template>
  <v-btn
    class="rounded-btn"
    width="73%"
    min-height="50px"
    max-width="600px"
    @click="onClick"
    rounded
  >{{ text }}</v-btn>
</template>

<script>
export default {
  props: {
    text: { type: String, required: true }
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
