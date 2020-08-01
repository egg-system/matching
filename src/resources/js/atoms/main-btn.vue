<template>
  <v-btn
    class="main-btn" 
    width="700px"
    height="130px"
    :href="href"
    @click="$emit('click')"
  >
    <span class="main-btn-phrase">{{ label }}</span>
  </v-btn>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      requried: true
    },
    href: {
      type: String,
      default: ''
    }
  }
}
</script>

<style lang="scss" scoped>
.main-btn {
  background: linear-gradient(to right, #FF9966, #FF6666);
  border-radius: 10px;
}

span.main-btn-phrase {
  color: white;
  letter-spacing: 0px;
  font-size: 45px;
  font-weight: bold;
}
</style>
