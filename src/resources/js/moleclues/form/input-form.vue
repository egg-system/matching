<template>
  <form-wrapper
    :label="label"
    :name="name"
    :error="error"
  >
    <input
      :id="id"
      :type="type"
      class="input-form"
      :class="{ 'input-form--danger': error }" 
      :name="formName || name"
      :value="value"
      :autocomplete="autocomplete"
      :autofocus="autofocus"
      :required="required"
    >
  </form-wrapper>
</template>

<script>
import FormWrapper from './form-wrapper'

export default {
  components: {
    FormWrapper
  },
  props: {
    label: { type: String, required: true },
    name: { type: String, required: true },
    formName: { type: String, default: '' },
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
