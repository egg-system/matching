<template>
  <v-icon>
    {{ icon }}
  </v-icon>
</template>

<script>
export default {
  props: {
    icon: {
      type: String,
      required: true
    }
  }
}
</script>
