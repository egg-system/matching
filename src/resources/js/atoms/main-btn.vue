<template>
  <v-btn    
    width="18rem"
    height="3rem"
    :href="href"
    :class="outlined ? 'outlined-btn' : 'main-btn'"
    class="rounded-btn"
    color="#FF9966"
    :outlined="outlined"
    :type="type"
    :disabled="disabled"
    rounded
    shaped
    @click="$emit('click')"
  >
    <span class="main-btn-phrase">{{ label }}</span>
  </v-btn>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      requried: true
    },
    href: {
      type: String,
      default: ''
    },
    outlined: {
      type: Boolean,
      default: false
    },
    type: {
      type: String,
      default: undefined
    },
    disabled: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style lang="scss" scoped>
@import 'resources/scss/_variables.scss';

@mixin mainBtnPhrase {
  letter-spacing: 0;
  font-size: $mainBtnFontSize;
  font-weight: bold;
}

.rounded-btn {
  border-radius: 1.5rem;
}

.main-btn {
  color: white;
  background: linear-gradient(to left, $mainBtnLightColor, $mainBtnColor);
  span.main-btn-phrase {
    @include mainBtnPhrase;
  }
}

.outlined-btn {
  color: $mainBtnColor;
  border-width: 0.2rem;
  span.main-btn-phrase {
    @include mainBtnPhrase;
  }
}
</style>
