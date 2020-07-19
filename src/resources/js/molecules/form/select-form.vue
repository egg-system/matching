<template>
  <form-wrapper
    :label="label"
    :labelFor="labelFor || name"
    :error="error"
  >
    <div class="select-form-container">
      <div v-if="sublabel" class="select-form-container__sublabel">{{ sublabel }}</div>

      <div
        class="select-form-container__form"
        :class="{ 'select-form-container__form--flex': sublabel }"
      >
        <select
          :id="id"
          :name="name"
          class="select-form"
          :class="{ 'select-form--danger': error }" 
        >
          <option
            v-for="(option, i) in options"
            :value="option.value"
            :key="`select_${i}`"
            :selected="String(option.value) === selected"
          >{{ option.name }}</option>
        </select>
      </div>
    </div>
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
    labelFor: { type: String, default: '' },
    sublabel: { type: String, default: '' },
    name: { type: String, required: true },
    id: { type: String, default: '' },
    options: { type: Array, required: true },
    selected: { type: String, default: '' },
    error: { type: String, default: '' }
  }
}
</script>

<style scoped lang="scss">
.select-form-container {
  display: flex;
  &__sublabel {
    flex-basis: 40%;
  }
  &__form--flex {
    flex-basis: 60%;
  }
  &__form {
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
    .select-form {
      display: block;
      width: 100%;
      border-bottom: solid 1px;
      font-size: 1.2em;
      padding-bottom: 5px;
      &--danger {
        border: solid 2px red;
      }
    }
  }
}
</style>
