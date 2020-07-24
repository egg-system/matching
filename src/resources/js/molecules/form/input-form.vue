<template>
  <form-wrapper
    :label="label"
    :labelFor="id"
    :error="error"
  >
    <input
      v-model="inputValue"
      :id="id"
      :type="type"
      class="input-form"
      :class="{ 'input-form--danger': error }" 
      :name="name"
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
    id: { type: String, required: true },
    type: { type: String, default: '' },
    value: { type: String, required: true },
    autocomplete: { type: String, default: '' },
    autofocus: { type: Boolean, default: false },
    required: { type: Boolean, default: false },
    error: { type: String, default: '' }
  },
  computed: {
    inputValue: {
      get () {
        return this.value
      },
      set (val) {
        this.$emit('input', val)
      }
    }
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
