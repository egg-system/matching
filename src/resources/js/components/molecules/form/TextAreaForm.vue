<template>
  <textarea
    :id="id"
    class="textareaForm"
    :class="{ 'textareaForm--danger': error }" 
    :name="name"
    :value="value"
    :placeholder="placeholder"
  ></textarea>
</template>

<script>
export default {
  props: {
    id: { type: String, default: '' },
    name: { type: String, required: true },
    value: { type: String, required: true },
    placeholder: { type: String, default: '' },
    error: { type: String, default: '' }
  }
}
</script>

<style scoped>
.textareaForm {
  display: block;
  width: 100%;
  height: 100px;
  resize: none;
  border: none;
  border-bottom: solid 1px;
  font-size: 1.2rem;
}
.textareaForm--danger {
  border: solid 2px red;
}
</style>
