<template>
  <main-btn
    class="users-register-main-btn"
    :type="type"
    :label="label"
    :href="href"
    :disabled="disabled"
    @click="$emit('click')"
  ></main-btn>
</template>

<script>
import mainBtn from '../main-btn'

export default {
  components: {
    mainBtn
  },
  props: {
    label: { type: String, required: true },
    href: { type: String, default: '' },
    type: { type: String, default: undefined },
    disabled: { type: Boolean, default: false }
  }
}
</script>

<style lang="scss" scoped>
.users-register-main-btn {
  width: 75% !important;
  height: auto !important;
  max-width: 600px;
  min-height: 50px;
  ::v-deep span.main-btn-phrase {
    font-size: 1.2rem;
  }
}
</style>
