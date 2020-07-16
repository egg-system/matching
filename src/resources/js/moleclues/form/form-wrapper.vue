<template>
  <div class="form-wrapper">
    <label class="form-label" :for="name">{{ label }}</label>
    
    <!-- サブテキストあり -->
    <template v-if="subtext">
      <div class="form-container">
        <div class="form-container__subtext">{{ subtext }}</div>
        <div class="form-container__form">
          <slot />
        </div>
      </div>
    </template>

    <!-- 範囲系 -->
    <template v-else-if="type === 'range'">
      <div class="range-form-container">
        <div class="range-form-container__form">
          <slot name="from" />
        </div>
        <div class="range-form-container__tilda">〜</div>
        <div class="range-form-container__form">
          <slot name="to" />
        </div>
      </div>
    </template>

    <template v-else>
      <slot />
    </template>
    
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
    subtext: { type: String, default: '' },
    type: { type: String, default: '' },
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
.form-container {
  display: flex;
  &__subtext {
    flex-basis: 40%;
  }
  &__form {
    flex-basis: 60%;
  }
}
.range-form-container {
  display: flex;
  &__tilda {
    flex-basis: 20%;
    text-align: center;
    font-size: 1.2rem;
  }
  &__form {
    flex-basis: 40%;
  }
}
.alert-text {
  display: block;
  color: red;
  margin-top: 10px;
}
</style>
