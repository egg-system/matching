<template>
  <div class="form-wrapper">
    <label class="form-label" :for="name">{{ label }}</label>
    
    <slot />
    
    <span v-if="error" class="alert-text" role="alert">
      <strong>{{ error }}</strong>
    </span>
  </div>
</template>

<script>
export default {
  props: {
    label: { type: String, required: true },
    name: { type: String, required: true },
    error: { type: String, default: '' }
  }
}
</script>

<style scoped lang="scss">
.form-wrapper {
  margin-bottom: 50px;
}
.form-label {
  display: block;
  font-weight: bold;
  font-size: 1rem;
  margin-bottom: 30px;
}
.alert-text {
  display: block;
  color: red;
  margin-top: 10px;
}
</style>
