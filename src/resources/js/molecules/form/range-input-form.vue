<template>
  <form-wrapper
    :label="label"
    :labelFor="fromId || toId"
    :error="fromError || toError"
  >
    <div class="range-form-container">
      <div class="range-form-container__form">
        <input
          v-model="inputFromValue"
          :id="fromId"
          :type="fromType"
          class="input-form"
          :class="{ 'input-form--danger': fromError }" 
          :name="fromName"
          :autocomplete="fromAutocomplete"
          :autofocus="fromAutofocus"
          :required="fromRequired"
        >
      </div>
      <div class="range-form-container__tilda">〜</div>
      <div class="range-form-container__form">
        <input
          v-model="inputToValue"
          :id="toId"
          :type="toType"
          class="input-form"
          :class="{ 'input-form--danger': toError }" 
          :name="toName"
          :autocomplete="toAutocomplete"
          :autofocus="toAutofocus"
          :required="toRequired"
        >
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
    fromId: { type: String, default: '' },
    fromName: { type: String, required: true },
    fromType: { type: String, default: '' },
    fromValue: { type: String, required: true },
    fromAutocomplete: { type: String, default: '' },
    fromAutofocus: { type: Boolean, default: false },
    fromRequired: { type: Boolean, default: false },
    fromError: { type: String, default: '' },
    toId: { type: String, default: '' },
    toName: { type: String, required: true },
    toType: { type: String, default: '' },
    toValue: { type: String, required: true },
    toAutocomplete: { type: String, default: '' },
    toAutofocus: { type: Boolean, default: false },
    toRequired: { type: Boolean, default: false },
    toError: { type: String, default: '' }
  },
  computed: {
    inputFromValue: {
      get () {
        return this.fromValue
      },
      set (val) {
        this.$emit('input', val)
      }
    },
    inputToValue: {
      get () {
        return this.toValue
      },
      set (val) {
        this.$emit('input', val)
      }
    }
  }
}
</script>

<style scoped lang="scss">
.range-form-container {
  display: flex;
  &__tilda {
    flex-basis: 20%;
    text-align: center;
    font-size: 1.2rem;
  }
  &__form {
    flex-basis: 40%;
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
  }
}
</style>
