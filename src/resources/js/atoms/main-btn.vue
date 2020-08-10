<template>
  <v-btn
    :type="type"
    class="main-btn" 
    width="700px"
    height="130px"
    :href="href"
    :disabled="disabled"
    rounded
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
    },
    type: {
      type: String,
      default: undefined
    },
    disabled: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style lang="scss" scoped>
.main-btn {
  color: white;
  background: linear-gradient(to right, #FF9966, #FF6666);
}

span.main-btn-phrase {
  letter-spacing: 0px;
  font-size: 45px;
  font-weight: bold;
}
</style>
