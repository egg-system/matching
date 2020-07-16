<template>
  <input
    :id="id"
    :type="type"
    class="input-form"
    :class="{ 'input-form--danger': error }" 
    :name="name"
    :value="value"
    :autocomplete="autocomplete"
    :autofocus="autofocus"
    :required="required"
  >
</template>

<script>
export default {
  props: {
    name: { type: String, required: true },
    id: { type: String, default: '' },
    type: { type: String, default: '' },
    value: { type: String, required: true },
    autocomplete: { type: String, default: '' },
    autofocus: { type: Boolean, default: false },
    required: { type: Boolean, default: false },
    error: { type: String, default: '' }
  }
}
</script>

<style scoped lang="scss">
.input-form {
  display: block;
  width: 100%;
  border: none;
  border-bottom: solid 1px;
  font-size: 1.2rem;
  &--danger {
    border: solid 2px red;
  }
}
</style>
