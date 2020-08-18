<template>
  <div class="image-icon">
    <v-img :src="iconImage" width="2rem" />
  </div>
</template>

<script>
export default {
  props: {
    image: {
      type: String,
      required: true
    },
    isActive: {
      type: Boolean,
      required: true
    }
  },
  computed: {
    iconImage() {
      const image = this.isActive ? `${this.image}-active` : this.image
      return `${image}.png`
    }
  }
}
</script>
