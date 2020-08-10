<template>
  <v-btn    
    width="18rem"
    height="3rem"
    :href="href"
    :class="outlined ? 'outlined-btn' : 'main-btn'"
    class="rounded-btn"
    color="#FF9966"
    :outlined="outlined"
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
    }
  }
}
</script>

<style lang="scss" scoped>
@import 'resources/scss/_variables.scss';

@mixin mainBtnPhrase($color) {
  color: $color;
  letter-spacing: 0px;
  font-size: $mainBtnFontSize;
  font-weight: bold;
}

.rounded-btn {
  border-radius: 75px;
}

.main-btn {
  background: linear-gradient(to left, $mainBtnLightColor, $mainBtnColor);
  span.main-btn-phrase {
    @include mainBtnPhrase(white)
  }
}

.outlined-btn {
  color: $mainBtnColor;
  border-width: 4px;
  span.main-btn-phrase {
    @include mainBtnPhrase($mainBtnColor)
  }
}
</style>
