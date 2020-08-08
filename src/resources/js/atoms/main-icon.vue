<template>
  <v-icon class="header-icon">
    {{ icon }}
  </v-icon>
</template>

<script>
export default {
  props: {
    icon: {
      type: String,
      required: true
    }
  }  
}
</script>

<style lang="scss" scoped>
.header-icon {
  background: linear-gradient(to right, #FF9966, #FF6666);
  background-clip: text;
  -webkit-text-fill-color: transparent;
}
</style>
