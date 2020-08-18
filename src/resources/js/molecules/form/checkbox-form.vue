<template>
  <div class="form-wrapper">
    <input
      type="checkbox"
      v-model="inputChecked"
      :id="id"
      class="checkbox-form"
      :name="name"
      :value="value"
    >
    <label class="form-label" :for="id">{{ label }}</label>
  </div>
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
    checked: { type: String, default: '0' },
    value: { type: String, default: '1' }
  },
  computed: {
    inputChecked: {
      get () {
        return this.checked === '1'
      },
      set (val) {
        this.$emit('change', val)
      }
    }
  }
}
</script>

<style scoped lang="scss">
$black: rgba(0, 0, 0, 0.87);

.checkbox-form {
  display: none;
  &+label {
    display: none;
    cursor: pointer;
    display: inline-block;
    position: relative;
    padding-left: 30px;
    padding-right: 10px;
    &::before {
      content: "";
      position: absolute;
      display: block;
      box-sizing: border-box;
      width: 20px;
      height: 20px;
      margin-top: -10px;
      margin-right: 3px;
      left: 0;
      top: 50%;
      border: 1px solid;
      border-color: $black;
      border-radius: 25%;
    }
  }
  &:checked+label::before {
    background-color: $black;
  }
  &:checked+label::after {
    content: "";
    position: absolute;
    display: block;
    box-sizing: border-box;
    width: 11px;
    height: 5px;
    margin-top: -3px;
    top: 50%;
    left: 5px;
    transform: rotate(-45deg);
    border-bottom: 2px solid;
    border-left: 2px solid;
    border-color: #FFF;
  }
}
</style>
