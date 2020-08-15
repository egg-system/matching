<template>
  <li class="step-item" :class="{ 'step-item--current': current }">
    <span>{{ number }}</span><br>
    {{ text }}
  </li>
</template>

<script>
export default {
  props: {
    number: { type: String, required: true },
    text: { type: String, required: true },
    current: { type: Boolean, default: false }
  }
}
</script>

<style lang="scss">
.step-item {
  text-align: center;
  font-size: 0.5rem;
  & span {
    background: black;
    color: white;
    font-weight: bold;
    display: inline-flex;
    justify-content: center;
    height: 24px;
    margin-bottom: 5px;
    line-height: 24px;
    width: 24px;
    border-radius: 50%;
    font-size: 0.8rem;
  }
  &:not(.step-item--current) {
    opacity: 0.3;
  }
}
</style>
