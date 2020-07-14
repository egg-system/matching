<template>
  <div class="selectWrap">
    <select
      :id="id"
      :name="name"
      class="selectForm"
      :class="{ 'selectForm--danger': error }" 
    >
      <option
        v-for="(option, i) in options"
        :value="option.value"
        :key="`select_${i}`"
        :selected="String(option.value) === selected"
      >{{ option.name }}</option>
    </select>
  </div>
</template>

<script>
export default {
  props: {
    name: { type: String, required: true },
    id: { type: String, default: '' },
    options: { type: Array, required: true },
    selected: { type: String, default: '' },
    error: { type: String, default: '' }
  }
}
</script>

<style scoped lang="scss">
.selectWrap {
  width: 100%;
  position: relative;
  display: inline-block;
  &::after {
    content: '';
    width: 10px;
    height: 10px;
    border-bottom: solid 2px #b4b3b3;
    border-right: solid 2px #b4b3b3;
    transform: rotate(-45deg);
    position: absolute;
    top: 50%;
    right: 10px;
    margin-top: -8px;
    pointer-events: none;
  }
}
.selectForm {
  display: block;
  width: 100%;
  border-bottom: solid 1px;
  font-size: 1.2em;
  padding-bottom: 5px;
  &--danger {
    border: solid 2px red;
  }
}
</style>
