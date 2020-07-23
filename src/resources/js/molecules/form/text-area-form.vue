<template>
  <form-wrapper
    :label="label"
    :labelFor="labelFor || name"
    :error="error"
  >
    <textarea
      v-model="textareaValue"
      :id="id"
      class="textarea-form"
      :class="{ 'textarea-form--danger': error }" 
      :name="name"
      :placeholder="placeholder"
    ></textarea>
  </form-wrapper>
</template>

<script>
export default {
  props: {
    label: { type: String, required: true },
    labelFor: { type: String, default: '' },
    id: { type: String, default: '' },
    name: { type: String, required: true },
    value: { type: String, required: true },
    placeholder: { type: String, default: '' },
    error: { type: String, default: '' }
  },
  computed: {
    textareaValue () {
      return this.value
    }
  }
}
</script>

<style scoped lang="scss">
.textarea-form {
  display: block;
  width: 100%;
  height: 100px;
  resize: none;
  border: none;
  border-bottom: solid 1px;
  font-size: 1.2rem;
  &--danger {
    border: solid 2px red;
  }
}
</style>
